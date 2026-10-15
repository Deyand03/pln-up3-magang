<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfilInternController extends Controller
{
    public function index()
    {
        $appId = auth()->user()->internship->application_id;
        $application = Applications::where('id', $appId)->first();

        $mentorId = auth()->user()->internship->mentor_id;
        $dataMentor = User::where('id', $mentorId)->first();

        return view('intern-dashboard.profile', compact('application', 'dataMentor'));
    }

    public function editBiodata(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'email' => 'email',
            'phone' => 'string'
        ]);

        try {
            $user->update([
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            return redirect()->back()->with('success', 'Berhasil Memperbarui Data');

        } catch (\Throwable $th) {
            Log::info('Terjadi Kesalahan editBiodata: '.$th);

            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }

    }

    public function editFoto(Request $request)
    {
        $request->validate([
            'foto_profil' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $user = auth()->user();
        try {
            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');

                if ($user->foto_profil) {
                    Storage::disk('s3')->delete($user->foto_profil);
                }
                $filename = 'foto_profil'.$user->id.'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs('foto_profil', $filename, 's3');

                $user->foto_profil = $path;
                $user->save();

                return redirect()->back()->with('success', 'Berhasil Memperbarui Foto Profil');
            }

            return redirect()->back()->with('error', 'Gagal Memperbarui Foto Profil, Terjadi Kesalahan!');
        } catch (\Throwable $th) {
            report($th);

            return redirect()->back()->with('error', 'Gagal Memperbarui Foto Profil, Terjadi Kesalahan!');
        }
    }
}
