<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Internships;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    private $officeLat = -1.607712;
    private $officeLng = 103.591788;
    private $maxRadiusMeters = 100;

    public function index(Request $request)
    {
        $internId = auth()->user()->internship->id;
        $today = Carbon::today('Asia/Jakarta');

        $todayAttendance = Attendances::where('internship_id', $internId)
            ->whereDate('date', $today)
            ->first();

        $hasCheckedIn = $todayAttendance && $todayAttendance->check_in !== null;
        $hasCheckedOut = $todayAttendance && $todayAttendance->check_out !== null;
        $isIzinSakitAlfaToday = $todayAttendance && in_array($todayAttendance->status, ['izin', 'sakit', 'alfa']);

        $totalHadir = Attendances::where('internship_id', $internId)
            ->where('status', 'hadir')
            ->count();
        $totalIzinSakit = Attendances::where('internship_id', $internId)
            ->whereIn('status', ['izin', 'sakit'])
            ->count();
        $totalDaysRecorded = Attendances::where('internship_id', $internId)
            ->count();

        $tingkatKehadiran = $totalDaysRecorded > 0
            ? round(($totalHadir / $totalDaysRecorded) * 100)
            : 0;

        $statPresensi = [
            'totalHadir' => $totalHadir,
            'totalIzinSakit' => $totalIzinSakit,
            'tingkatKehadiran' => $tingkatKehadiran . '%',
        ];

        $presensi = Attendances::where('internship_id', $internId)
            ->orderBy('date', 'desc')
            ->paginate(10);

        if($request->ajax()){
            return view('intern-dashboard.partials.list-presensi', compact('presensi'))->render();
        }

        return view('intern-dashboard.presensi', compact(
            'todayAttendance',
            'hasCheckedIn',
            'isIzinSakitAlfaToday',
            'hasCheckedOut',
            'statPresensi',
            'presensi'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:masuk,pulang',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $internId = auth()->user()->internship->id;

        $now = Carbon::now('Asia/Jakarta');
        $today = Carbon::today('Asia/Jakarta');

        $existing = Attendances::where('internship_id', $internId)
            ->whereDate('date', $today)
            ->first();

        // VALIDASI, Jika sudah tercatat izin/sakit hari ini, tidak boleh absen masuk/pulang
        if ($existing && in_array($existing->status, ['izin', 'sakit'])) {
            return redirect()->back()->with('error', 'Anda telah mengajukan izin/sakit hari ini. Tidak dapat melakukan presensi.');
        }

        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $this->officeLat,
            $this->officeLng
        );

        $isValidRadius = $distance <= $this->maxRadiusMeters;

        if ($request->type === 'masuk') {
            $existing = Attendances::where('internship_id', $internId)
                ->whereDate('date', $today)
                ->first();

            if ($existing && $existing->check_in) {
                return redirect()->back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
            }

            Attendances::create([
                'internship_id' => $internId,
                'date' => $today->toDateString(),
                'check_in' => $now->toTimeString(),
                'latitude_in' => $request->latitude,
                'longitude_in' => $request->longitude,
                'distance_in' => $distance,
                'status' => 'hadir',
                'is_valid' => $isValidRadius,
            ]);

            return redirect()->back()->with('success', 'Berhasil melakukan Absen Masuk.');
        }

        if ($request->type === 'pulang') {
            $checkoutLimit = Carbon::today('Asia/Jakarta')->setTime(16, 30, 0);
            if ($now->lt($checkoutLimit)) {
                return redirect()->back()->with('error', 'Absen pulang baru dibuka pukul 16:30 WIB.');
            }

            $attendance = Attendances::where('internship_id', $internId)
                ->whereDate('date', $today)
                ->first();

            if (!$attendance || !$attendance->check_in) {
                return redirect()->back()->with('error', 'Anda belum melakukan absen masuk hari ini.');
            }

            if ($attendance->check_out) {
                return redirect()->back()->with('error', 'Anda sudah melakukan absen pulang hari ini.');
            }

            $attendance->update([
                'check_out' => $now->toTimeString(),
                'latitude_out' => $request->latitude,
                'longitude_out' => $request->longitude,
                'distance_out' => $distance,
            ]);

            return redirect()->back()->with('success', 'Berhasil melakukan Absen Pulang.');
        }

        return redirect()->back()->with('error', 'Aksi presensi tidak valid.');
    }

    public function storeIzin(Request $request)
    {
        $request->validate([
            'kategori_izin' => 'required|in:sakit,izin_kampus',
            'alasan' => 'required|string',
            'surat_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        $internship = Internships::where('user_id', $user->id)->first() ?? $user->internship;
        $internId = $internship ? $internship->id : 1;

        $today = Carbon::today('Asia/Jakarta');
        $existing = Attendances::where('internship_id', $internId)
            ->whereDate('date', $today)
            ->first();


        if ($existing) {
            if ($existing->check_in || $existing->status === 'hadir') {
                return redirect()->back()->with('error', 'Pengajuan ditolak! Anda sudah melakukan Absen Masuk hari ini.');
            }

            if (in_array($existing->status, ['izin', 'sakit'])) {
                return redirect()->back()->with('error', 'Anda sudah mengajukan izin/sakit untuk hari ini.');
            }
        }

        $suratPath = null;
        if ($request->hasFile('surat_izin')) {
            $suratPath = $request->file('surat_izin')->store('surat_izin', 's3');
        }

        $status = $request->kategori_izin === 'sakit' ? 'sakit' : 'izin';

        Attendances::Create(
            [
                'internship_id' => $internId,
                'date' => $today->toDateString(),
                'status' => $status,
                'notes' => $request->alasan,
                'surat_izin' => $suratPath,
                'is_valid' => true,
            ]
        );

        return redirect()->back()->with('success', 'Pengajuan izin/sakit berhasil dikirim.');
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Menggunakan rumus Haversine untuk menghitung jarak antara dua titik koordinat dalam meter
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c);
    }
}
