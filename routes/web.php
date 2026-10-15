<?php

use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\CheckstatusController;
use App\Http\Controllers\FormpengajuanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HrdController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProfilInternController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/check-status', [CheckstatusController::class, 'create'])->name('check-status');
Route::get('/check-status/cek', [CheckstatusController::class, 'checkStatus'])->name('check-status.check');
Route::patch('/check-status/cek/update/{id}', [CheckstatusController::class, 'updateDokumen'])->name('check-status.update-dokumen');

Route::middleware('guest')->group(function () {
    Route::get('/form-pengajuan', [FormpengajuanController::class, 'create'])->name('form-pengajuan');
    Route::post('/form-pengajuan', [FormpengajuanController::class, 'store'])->name('form-pengajuan.store');
});

Route::middleware(['auth', 'role:intern'])->group(function () {
    Route::get('/dashboard-intern', [InternController::class, 'index'])->name('dashboard-intern');
    Route::get('/dashboard-intern/download-surat-selesai', [InternController::class, 'downloadSuratSelesai'])
        ->name('intern.download-surat-selesai');

    Route::get('/profile-intern', [ProfilInternController::class, 'index'])->name('profile-intern');
    Route::patch('/profile-intern/edit', [ProfilInternController::class, 'editBiodata'])->name('profile-intern.editBio');
    Route::patch('/profile-intern/edit-foto', [ProfilInternController::class, 'editFoto'])->name('profile-intern.editFoto');

    Route::get('/presensi-intern', [AttendancesController::class, 'index'])->name('presensi-intern');
    Route::post('/presensi-intern', [AttendancesController::class, 'store'])->name('presensi-intern.store');
    Route::post('/presensi-intern/izin', [AttendancesController::class, 'storeIzin'])->name('presensi-intern.izin');

    Route::get('/logbook-intern', [LogbookController::class, 'index'])->name('logbook-intern');
    Route::post('/logbook-intern', [LogbookController::class, 'store'])->name('logbook-intern.store');
    Route::patch('/logbook-intern/update/{id}', [LogbookController::class, 'update'])->name('logbook-intern.update');
});

Route::middleware(['auth', 'role:mentor'])->group(function () {
    Route::get('/dashboard-mentor', [MentorController::class, 'index'])->name('dashboard-mentor');
    Route::get('/dashboard-mentor/internship/{id}', [MentorController::class, 'showInternshipDetails'])->name('mentor.internship.details');
    Route::patch('/dashboard-mentor/internship/toggle-status-logbook/{id}', [MentorController::class, 'toggleLogbookStatus'])->name('mentor.internship.toggleStatus');

    Route::get('/dashboard-mentor/profile', [MentorController::class, 'profile'])->name('profile-mentor');
});

Route::middleware(['auth', 'role:hrd'])->group(function () {
    Route::get('/dashboard-hrd', [HrdController::class, 'index'])->name('dashboard-hrd');
    Route::patch('/dashboard-hrd/surat-selesai/{id}', [HrdController::class, 'uploadSuratSelesai'])->name('dashboard-hrd.upload-surat-selesai');
    Route::delete('/dashboard-hrd/surat-selesai/{id}', [HrdController::class, 'hapusSuratSelesai'])->name('dashboard-hrd.hapus-surat-selesai');

    Route::patch('/dashboard-hrd/update-divisi/{id}', [HrdController::class, 'updateDivisi'])->name('dashboard-hrd.update-divisi');
    Route::patch('/dashboard-hrd/update-status-peserta/{id}', [HrdController::class, 'updateStatusPeserta'])->name('dashboard-hrd.update-status-peserta');

    Route::get('/dashboard-hrd/pendaftar', [HrdController::class, 'tinjauPendaftar'])->name('dashboard-hrd.pendaftar');
    Route::get('/dashboard-hrd/pendaftar/{id}', [HrdController::class, 'showPendaftar'])->name('dashboard-hrd.pendaftar.detail');
    Route::patch('/dashboard-hrd/pendaftar/{id}', [HrdController::class, 'updateStatusPendaftaran'])->name('dashboard-hrd.pendaftar.detail.update');
});

require __DIR__ . '/auth.php';
