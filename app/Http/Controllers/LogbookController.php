<?php

namespace App\Http\Controllers;

use App\Models\Logbooks;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $internId = auth()->user()->internship->id;

        $dataLogbook = Logbooks::where('internship_id', $internId)
            ->orderBy('date', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('intern-dashboard.partials.list-logbook', compact('dataLogbook'))->render();
        }

        $totalLogbook = Logbooks::where('internship_id', $internId)->count();
        $totalLogbookPending = Logbooks::where('internship_id', $internId)
            ->where('status', 'pending')
            ->count();

        return view('intern-dashboard.logbook', compact('dataLogbook', 'totalLogbook', 'totalLogbookPending'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $internId = auth()->user()->internship->id;

        $request->validate([
            'date'               => 'required|date',
            'jam_mulai'          => 'required',
            'jam_selesai'        => 'required',
            'nama_kegiatan'      => 'required|string',
            'deskripsi_kegiatan' => 'required|string'
        ]);
        try {
            Logbooks::create([
                'internship_id' => $internId,
                'date' => $request->date,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'nama_kegiatan' => $request->nama_kegiatan,
                'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            ]);

            return redirect()->back()->with('success', 'Berhasil Menambahkan Logbook');

        } catch (\Throwable $th) {
            report($th);

            return redirect()->back()->with('error', 'Gagal menambahkan logbook. Silakan coba lagi.');
        }
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
        $request->validate([
            'date'               => 'required|date|before_or_equal:today',
            'jam_mulai'          => 'required',
            'jam_selesai'        => 'required|after:jam_mulai',
            'nama_kegiatan'      => 'required|string',
            'deskripsi_kegiatan' => 'required|string'
        ]);

        $internId = auth()->user()->internship->id;
        $logbook = Logbooks::where('id', $id)
            ->where('internship_id', $internId)
            ->firstOrFail();

        try {
            $logbook->update([
                'date' => $request->date,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'nama_kegiatan' => $request->nama_kegiatan,
                'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            ]);

            return redirect()->back()->with('success', 'Berhasil Memperbarui Data Logbook');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal Memperbarui Logbook, Terjadi Kesalahan!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
