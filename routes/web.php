

<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

use App\Http\Controllers\PelamarController;
// Redirect /pelamar ke halaman index pelamar
Route::get('/pelamar', [PelamarController::class, 'index'])->name('pelamar.index');

use App\Http\Controllers\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->name('profile');

require __DIR__.'/auth.php';
require __DIR__.'/logout.php';


