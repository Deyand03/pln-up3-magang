<?php

use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\CheckstatusController;
use App\Http\Controllers\FormpengajuanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\ProfilInternController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::middleware('guest')->group(function(){
    Route::get('/form-pengajuan', [FormpengajuanController::class, 'create'])->name('form-pengajuan');
    Route::post('/form-pengajuan', [FormpengajuanController::class, 'store'])->name('form-pengajuan.store');
    Route::get('/check-status', [CheckstatusController::class, 'create'])->name('check-status');
    Route::get('/check-status/cek', [CheckstatusController::class, 'checkStatus'])->name('check-status.check');
});

Route::middleware(['auth', 'role:intern'])->group(function () {
    Route::get('/dashboard-intern', [InternController::class, 'index'])->name('dashboard-intern');
    Route::get('/dashboard-intern/download-surat-selesai', [InternController::class, 'downloadSuratSelesai'])
        ->name('intern.download-surat-selesai');

    Route::get('/profile-intern', [ProfilInternController::class, 'index'])->name('profile-intern');
    Route::patch('/profile-intern/edit', [ProfilInternController::class, 'editBiodata'])->name('profile-intern.editBio');

    Route::get('/presensi-intern', [AttendancesController::class, 'index'])->name('presensi-intern');
    Route::post('/presensi-intern', [AttendancesController::class, 'store'])->name('presensi-intern.store');
    Route::post('/presensi-intern/izin', [AttendancesController::class, 'storeIzin'])->name('presensi-intern.izin');

    Route::get('/logbook-intern', [LogbookController::class, 'index'])->name('logbook-intern');
    Route::post('/logbook-intern', [LogbookController::class, 'store'])->name('logbook-intern.store');
    Route::patch('/logbook-intern/update/{id}', [LogbookController::class, 'update'])->name('logbook-intern.update');
});

require __DIR__.'/auth.php';
