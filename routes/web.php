<?php

use App\Http\Controllers\CheckstatusController;
use App\Http\Controllers\FormpengajuanController;
use App\Http\Controllers\InternController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/form-pengajuan', [FormpengajuanController::class, 'create'])->name('form-pengajuan');
Route::post('/form-pengajuan', [FormpengajuanController::class, 'store'])->name('form-pengajuan.store');
Route::get('/check-status', [CheckstatusController::class, 'create'])->name('check-status');
Route::get('/check-status/cek', [CheckstatusController::class, 'checkStatus'])->name('check-status.check');

Route::middleware(['auth', 'role:intern'])->group(function () {
    Route::get('/dashboard-intern', [InternController::class, 'index'])->name('dashboard-intern');
    Route::get('/profile-intern', [InternController::class, 'profile'])->name('profile-intern');
});

require __DIR__.'/auth.php';
