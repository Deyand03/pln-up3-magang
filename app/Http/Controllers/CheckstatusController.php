<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CheckstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function create()
    {
        return view('check-status.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function checkStatus(Request $request)
    {
        $application = null;

        if ($request->has('registration_number') && $request->filled('registration_number')) {
            $application = Applications::where('registration_number', trim($request->registration_number))->first();

            if (!$application) {
                return redirect()->back()->with('notFound', 'Nomor pengajuan tidak ditemukan. Pastikan format yang diinputkan benar!');
            }
        }
        return view('check-status.index', compact('application'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateDokumen(Request $request, $id)
    {
        $request->validate(
            [
                'recommendation_letter' => 'nullable|file|mimes:pdf|max:2048',
                'proposal' => 'nullable|file|mimes:pdf|max:2048'
            ],
            [
                'recommendation_letter.required' => 'Surat rekomendasi dari kampus/sekolah wajib diunggah!',
                'recommendation_letter.mimes' => 'Format file surat rekomendasi harus PDF!',
                'recommendation_letter.max' => 'Ukuran file surat rekomendasi maksimal 2 MB!',
                'proposal.mimes' => 'Format file proposal harus PDF!',
                'proposal.max' => 'Ukuran file proposal maksimal 2 MB!',
            ]
        );

        try {
            $application = Applications::findOrFail($id);

            if ($request->hasFile('recommendation_letter')) {
                if ($application->recommendation_letter && Storage::disk('s3')->exists($application->recommendation_letter)) {
                    Storage::disk('s3')->delete($application->recommendation_letter);
                }
                $recLetterPath = $request->file('recommendation_letter')->store('proposals', 's3');
                $application->recommendation_letter = $recLetterPath;
            }

            if ($request->hasFile('proposal')) {
                if ($application->proposal && Storage::disk('s3')->exists($application->proposal)) {
                    Storage::disk('s3')->delete($application->proposal);
                }
                $proposalPath = $request->file('proposal')->store('proposals', 's3');
                $application->proposal = $proposalPath;
            }
            $application->save();

            return redirect()->back()->with('success', 'Berkas Berhasil Diperbarui');
        } catch (\Throwable $th) {
            Log::info($th);
            return redirect()->back()->with('error', 'Terjadi Kesalahan!: ' . $th);
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
