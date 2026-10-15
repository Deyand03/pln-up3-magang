<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceTimExport;
use App\Models\Applications;
use App\Models\Internships;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class HrdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingVerifikasi = Applications::where('status', 'pending')->count();
        $pesertaAktif = Internships::where('status', 'active')->count();
        $totalInstansi = Applications::where('status', 'approved')->distinct('institusi')->count('institusi');

        $selesaiBulanIni = Internships::where('status', 'completed')
            ->whereMonth('updated_at', Carbon::now()->month)
            ->whereYear('updated_at', Carbon::now()->year)
            ->count();

        $tahunIni = Carbon::now()->year;

        $trenBulanan = Internships::join('applications', 'internships.application_id', '=', 'applications.id')
            ->select(
                DB::raw('MONTH(applications.start_date) as bulan'),
                DB::raw('COUNT(internships.id) as total')
            )
            ->whereYear('applications.start_date', $tahunIni)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $chartBulan = [];
        $chartDataTren = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartBulan[] = Carbon::create()->month($i)->translatedFormat('M');
            $chartDataTren[] = $trenBulanan[$i] ?? 0;
        }

        $distribusiInstansi = Internships::join('applications', 'internships.application_id', '=', 'applications.id')
            ->select('applications.institusi', DB::raw('COUNT(internships.id) as total'))
            ->groupBy('applications.institusi')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $chartLabelInstansi = $distribusiInstansi->pluck('institusi')->toArray();
        $chartDataInstansi = $distribusiInstansi->pluck('total')->toArray();

        $timMagang = Applications::with(['internship.user'])
            ->where('status', 'approved')
            ->orderBy('start_date', 'desc')
            ->get();

        $mentors = User::where('role', 'mentor')->get();
        return view('hrd.index', compact(
            'pendingVerifikasi',
            'pesertaAktif',
            'totalInstansi',
            'selesaiBulanIni',
            'chartBulan',
            'chartDataTren',
            'chartLabelInstansi',
            'chartDataInstansi',
            'tahunIni',
            'timMagang',
            'mentors'
        ));
    }

    public function tinjauPendaftar(Request $request)
    {
        $applications = Applications::whereIn('status', ['pending', 'revision', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        if ($request->ajax()) {
            return view('hrd.partials.pendaftar-list', compact('applications'))->render();
        }

        return view('hrd.pendaftaran', compact('applications'));
    }

    public function showPendaftar(string $id)
    {
        $application = Applications::findOrFail($id);
        return view('hrd.detail-pendaftar', compact('application'));
    }
    public function updateStatusPendaftaran(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,revision',
            'notes' => 'nullable|string'
        ]);

        $application = Applications::findOrFail($id);
        $application->status = $request->status;
        $application->notes = $request->notes;

        if ($request->status === 'approved') {
            do {
                $registrationToken = date('Ymd') . strtoupper(Str::random(8)) . '-' . $application->id;
            } while (Applications::where('registration_token', $registrationToken)->exists());

            $application->registration_token = $registrationToken;
            $application->token_quota = $application->total_interns;
            $application->token_used = 0;
        }

        $application->save();

        $pesan = $request->status === 'approved' ? 'Pendaftaran disetujui! Token berhasil dibuat.' :
            ($request->status === 'revision' ? 'Catatan revisi telah dikirim ke pendaftar.' : 'Pendaftaran ditolak.');

        return redirect()->route('dashboard-hrd.pendaftar')->with('success', $pesan);
    }

    public function uploadSuratSelesai(Request $request, $id)
    {
        $request->validate([
            'surat_selesai' => 'required|file|mimes:pdf|max:2048'
        ]);

        $peserta = Applications::findOrFail($id);
        try {
            if ($request->hasFile('surat_selesai')) {
                if ($peserta->surat_selesai && Storage::disk('s3')->exists($peserta->surat_selesai)) {
                    Storage::disk('s3')->delete($peserta->surat_selesai);
                }

                $pathFile = $request->file('surat_selesai')->store('surat_selesai', 's3');
                $peserta->surat_selesai = $pathFile;
                $peserta->save();
            }

            return redirect()->back()->with('success', 'Berhasil Upload Surat Selesai');

        } catch (\Throwable $th) {
            Log::info('Terjadi Kesalahan: ' . $th);
            return redirect()->back()->with('error', 'Gagal upload surat, Terjadi Kesalahan');
        }
    }

    public function hapusSuratSelesai(string $id)
    {
        $application = Applications::findOrFail($id);

        try {
            if ($application->surat_selesai && Storage::disk('s3')->exists($application->surat_selesai)) {
                Storage::disk('s3')->delete($application->surat_selesai);
            }
            $application->surat_selesai = null;
            $application->save();

            return redirect()->back()->with('success', 'Berhasil Menghapus Surat Selesai: ' . $application->name);
        } catch (\Throwable $th) {
            Log::info('Terjadi Kesalahan: ' . $th);
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }

    public function updateDivisi(Request $request, string $id)
    {
        $request->validate([
            'internships' => 'required|array',
            'internships.*.mentor_id' => 'nullable|exists:users,id',
        ]);

        foreach ($request->internships as $internId => $data) {
            if (!empty($data['mentor_id'])) {
                $mentor = User::find($data['mentor_id']);

                Internships::where('id', $internId)
                    ->where('application_id', $id)
                    ->update([
                        'mentor_id' => $mentor->id,
                        'department' => $mentor->name
                    ]);
            }
        }

        return redirect()->back()->with('success', 'Penempatan divisi dan mentor berhasil diperbarui!');
    }

    public function updateStatusPeserta(Request $request, $id)
    {
        $request->validate([
            'internship' => 'required|array',
            'internship.*.status' => 'required|in:pending,active,completed,terminated',
        ]);
        try {
            foreach ($request->internship as $internId => $data) {
                Internships::where('id', $internId)
                    ->where('application_id', $id)
                    ->update([
                        'status' => $data['status']
                    ]);
            }

            return redirect()->back()->with('success', 'Status individu peserta berhasil diperbarui!');
        } catch (\Throwable $th) {
            Log::info("Terjadi Kesalahan: " . $th);
            return redirect()->back()->with('error', 'Gagal Memperbarui Status, Terjadi Kesalahan!');
        }
    }

    public function unduhRekapAbsen($timId) {
        $tim = Applications::findOrFail($timId);
        $namaFile = 'rekap-absen-' . Str::slug($tim->institusi) . '-' . date('Ymd') . '.xlsx';

        return Excel::download(new AttendanceTimExport($timId), $namaFile);
    }
}
