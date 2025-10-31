<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

use App\Http\Controllers\PelamarController;
// Redirect /pelamar ke halaman index pelamar
Route::get('/pelamar', [PelamarController::class, 'index'])->name('pelamar.index');
Route::get('/pelamar/create', [PelamarController::class, 'create'])->name('pelamar.create');
Route::get('/pelamar/{id}/edit', [PelamarController::class, 'edit'])->name('pelamar.edit');
Route::put('/pelamar/{id}', [PelamarController::class, 'update'])->name('pelamar.update');

use App\Http\Controllers\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::view('profile', 'profile')
    ->name('profile');

Route::view('/interview', 'under-development')->name('interview');
Route::view('/karyawan', 'under-development')->name('karyawan');
Route::view('/driver', 'under-development')->name('driver');
Route::view('/kenek', 'under-development')->name('kenek');
Route::view('/pkwtt', 'under-development')->name('pkwtt');
Route::view('/assesment', 'under-development')->name('assesment');
Route::view('/payroll', 'under-development')->name('payroll');
Route::view('/berita-acara', 'under-development')->name('berita-acara');
Route::view('/master', 'under-development')->name('master');
Route::view('/setting-user', 'under-development')->name('setting-user');

require __DIR__.'/auth.php';
require __DIR__.'/logout.php';
require __DIR__.'/auth_custom.php';


