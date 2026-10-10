<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\Attendances;
use App\Models\Logbooks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $periode = '-';
        $hariTersisa = 0;

        $internId = auth()->user()->internship->id;
        $appId = auth()->user()->internship->application_id;
        $mentorId = auth()->user()->internship->mentor_id;
        $dataMentor = User::where('id', $mentorId)->first();

        $jumlahKehadiran = Attendances::where([
            'internship_id' => $internId,
            'status' => 'hadir'
        ])->count();

        $jumlahLogbook = Logbooks::where('internship_id', $internId)->count();
        $dataLogbook = Logbooks::where('internship_id', $internId)->paginate(5);
        $dataPeriode = Applications::select('id', 'start_date', 'end_date', 'surat_selesai')->where('id', $appId)->first();

        if($request->ajax()){
            return view('intern-dashboard.partials.list-logbook-dashboard', compact('dataLogbook'))->render();
        }

        if ($dataPeriode) {
            Carbon::setLocale('id');

            $mulai = Carbon::parse($dataPeriode->start_date);
            $selesai = Carbon::parse($dataPeriode->end_date);
            $hariIni = Carbon::now();

            if ($mulai->year === $selesai->year) {
                if ($mulai->month === $selesai->month) {
                    $periode = $mulai->isoFormat('D') . ' - ' . $selesai->isoFormat('D MMMM YYYY');
                } else {
                    $periode = $mulai->isoFormat('D MMMM') . ' - ' . $selesai->isoFormat('D MMMM YYYY');
                }
            } else {
                $periode = $mulai->isoFormat('D MMMM YYYY') . ' - ' . $selesai->isoFormat('D MMMM YYYY');
            }
            if ($hariIni->gt($selesai)) {
                $hariTersisa = 0;
            } else {
                $hariTersisa = $hariIni->diffInWeekdays($selesai, false);
                $hariTersisa = $hariTersisa < 0 ? 0 : $hariTersisa;
            }
        }
        $suratSelesai = $dataPeriode->surat_selesai ?? null;

        return view('intern-dashboard.index', compact('jumlahKehadiran', 'jumlahLogbook', 'periode', 'hariTersisa', 'dataLogbook', 'dataMentor', 'suratSelesai'));
    }
    public function downloadSuratSelesai()
    {
        $appId = auth()->user()->internship->application_id;
        $application = Applications::findOrFail($appId);

        if (!$application->surat_selesai || !Storage::disk('s3')->exists($application->surat_selesai)) {
            return back()->with('error', 'Surat Selesai Magang belum diunggah oleh admin.');
        }

        $namaFile = 'Surat-Selesai-Magang-' . auth()->user()->name . '.pdf';

        return Storage::disk('s3')->download($application->surat_selesai, $namaFile);
    }
    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
