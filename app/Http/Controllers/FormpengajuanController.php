<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FormpengajuanController extends Controller
{
    public function create()
    {
        return view('form-pengajuan.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'nim_nisn' => 'required|string|max:50',
            'institution' => 'required|string|max:255',
            'total_interns' => 'required|integer|min:1|max:10',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'recommendation_letter' => 'required|file|mimes:pdf|max:2048',
            'proposal' => 'nullable|file|mimes:pdf|max:2048',
        ], [
            'recommendation_letter.required' => 'Surat rekomendasi dari kampus/sekolah wajib diunggah!',
            'recommendation_letter.mimes' => 'Format file surat rekomendasi harus PDF!',
            'recommendation_letter.max' => 'Ukuran file surat rekomendasi maksimal 2 MB!',
            'proposal.mimes' => 'Format file proposal harus PDF!',
            'proposal.max' => 'Ukuran file proposal maksimal 2 MB!',
            'end_date.after' => 'Tanggal selesai harus lebih lambat dari tanggal mulai!',
        ]);

        try {
            $recLetterPath = $request->file('recommendation_letter')->store('proposals', 's3');

            $proposalPath = null;
            if ($request->hasFile('proposal')) {
                $proposalPath = $request->file('proposal')->store('proposals', 's3');
            }

            // Generate Nomor Registrasi Unik
            do {
                $registrationNumber = 'PLN-MG-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            } while (Applications::where('registration_number', $registrationNumber)->exists());

            $application = Applications::create([
                'registration_number' => $registrationNumber,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'nim_nisn' => $validated['nim_nisn'],
                'institution' => $validated['institution'],
                'total_interns' => $validated['total_interns'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'recommendation_letter' => $recLetterPath,
                'proposal' => $proposalPath,
                'status' => 'pending',
            ]);
            session(['registration_number' => $application->registration_number]);

            return redirect()->route('check-status')->with([
                'success' => 'Pengajuan magang berhasil dikirim!. Simpan nomor pendaftaran Anda untuk mengecek status.',
            ]);

        } catch (\Throwable $e) {
            report($e);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengirim pengajuan. Silahkan coba lagi.');
        }
    }
}
