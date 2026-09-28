<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Cek Keberadaan Token Pendaftaran
        $regis_token = Applications::where('registration_token', $request->token)->first();

        if (!$regis_token) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Token pendaftaran tidak valid.');
        }

        // 2. Cek Status Pengajuan & Kuota Token
        if ($regis_token->status !== 'approved') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Pengajuan magang terkait token ini belum disetujui.');
        }

        if ($regis_token->token_used >= $regis_token->token_quota) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kuota pembuatan akun untuk token pendaftaran ini sudah habis.');
        }

        // 3. Validasi Seluruh Field Input dari Form Registrasi
        $request->validate([
            'token'     => ['required', 'string'],
            'nama'      => ['required', 'string', 'max:255'],
            'nim_nisn'  => ['required', 'string', 'max:50', 'unique:'.User::class, 'nim_nisn'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'no_hp'     => ['required', 'string', 'max:20'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Custom Error Messages dalam Bahasa Indonesia
            'nama.required'     => 'Nama lengkap wajib diisi.',
            'nim_nisn.required' => 'NIM/NISN wajib diisi.',
            'nim_nisn.unique'   => 'NIM/NISN ini sudah terdaftar di sistem.',
            'email.required'    => 'Alamat e-mail wajib diisi.',
            'email.unique'      => 'E-mail ini sudah digunakan oleh akun lain.',
            'no_hp.required'    => 'Nomor telepon wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        // 4. Simpan Data User Baru ke Database
        $user = User::create([
            'name'           => $request->nama,
            'nim_nisn'       => $request->nim_nisn,
            'email'          => $request->email,
            'no_hp'          => $request->no_hp,
            'password'       => Hash::make($request->password),
            'application_id' => $regis_token->id, // Menghubungkan user dengan pengajuan magangnya
        ]);

        // 5. Tambahkan Jumlah Kuota Token yang Terpakai
        $regis_token->increment('token_used');

        // 6. Triggers Event Registered & Auto Login
        event(new Registered($user));

        Auth::login($user);

        // 7. Redirect ke Dashboard / Halaman Utama
        return redirect()->route('dashboard-intern')->with('success', 'Selamat! Akun magang Anda berhasil terdaftar.');
    }
}
