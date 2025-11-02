
<?php
use App\Http\Controllers\InterviewManagementController;
use App\Http\Controllers\TrHrPelamarInterviewFinanceController;
use App\Http\Controllers\TrHrPelamarInterviewHrdController;
use App\Http\Controllers\TrHrPelamarInterviewMgtController;
use App\Http\Controllers\TrHrPelamarInterviewSpvController;
Route::get('/manajemen-interview', [InterviewManagementController::class, 'index'])->name('manajemen-interview.index');
Route::resource('interview_finance', TrHrPelamarInterviewFinanceController::class);
Route::resource('interview_hrd', TrHrPelamarInterviewHrdController::class);
Route::resource('interview_mgt', TrHrPelamarInterviewMgtController::class);
Route::resource('interview_spv', TrHrPelamarInterviewSpvController::class);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MsDivisionController;
use App\Http\Controllers\MsCompanyController;
use App\Http\Controllers\MsBankController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\KandidatController;

Route::resource('ms-division', MsDivisionController::class);
Route::resource('ms-company', MsCompanyController::class);
Route::resource('ms-bank', MsBankController::class);

// Pelamar Routes - Protected by auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/pelamar', [PelamarController::class, 'index'])->name('pelamar.index');
    Route::get('/pelamar/create', [PelamarController::class, 'create'])->name('pelamar.create');
    Route::post('/pelamar', [PelamarController::class, 'store'])->name('pelamar.store');
    Route::get('/pelamar/{id}', [PelamarController::class, 'show'])->name('pelamar.show');
    Route::get('/pelamar/{id}/edit', [PelamarController::class, 'edit'])->name('pelamar.edit');
    Route::put('/pelamar/{id}', [PelamarController::class, 'update'])->name('pelamar.update');
    Route::delete('/pelamar/{id}', [PelamarController::class, 'destroy'])->name('pelamar.destroy');
    
    // AJAX check for duplicate pelamar id
    Route::post('/pelamar/checkid', [PelamarController::class, 'checkId'])->name('pelamar.checkid');
    
    // Routes untuk pengalaman kerja
    Route::post('/pelamar/{id}/pengalaman', [PelamarController::class, 'storePengalaman'])->name('pelamar.pengalaman.store');
    Route::delete('/pelamar/pengalaman/{id}', [PelamarController::class, 'destroyPengalaman'])->name('pelamar.pengalaman.destroy');
    
    // Aksi pelamar
    Route::post('/pelamar/{id}/jadikan-kandidat', [PelamarController::class, 'jadikanKandidat'])->name('pelamar.jadikanKandidat');
    Route::get('/pelamar/{id}/interview', [PelamarController::class, 'interview'])->name('pelamar.interview');
    Route::post('/pelamar/{id}/tolak', [PelamarController::class, 'tolak'])->name('pelamar.tolak');
    Route::get('/pelamar/{id}/diskusi', [PelamarController::class, 'diskusi'])->name('pelamar.diskusi');
    Route::post('/pelamar/{id}/confirm-jadwal-interview', [PelamarController::class, 'confirmJadwalInterview'])->name('pelamar.confirmJadwalInterview');
    Route::get('/pelamar/{id}/reschedule', [PelamarController::class, 'reschedule'])->name('pelamar.reschedule');
    Route::get('/pelamar/{id}/background-check', [PelamarController::class, 'backgroundCheck'])->name('pelamar.backgroundCheck');
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingUserController;

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::view('profile', 'profile')
    ->name('profile');

use App\Http\Controllers\InterviewController;
Route::get('/interview', [InterviewController::class, 'index'])->name('interview');
Route::get('/interview/create', [InterviewController::class, 'create'])->name('interview.create');
Route::resource('interview_bod', App\Http\Controllers\TrHrPelamarInterviewBodController::class);
Route::resource('interview_admin', App\Http\Controllers\TrHrPelamarInterviewAdminController::class);
Route::view('/karyawan', 'under-development')->name('karyawan');
Route::view('/driver', 'under-development')->name('driver');
Route::view('/kenek', 'under-development')->name('kenek');
Route::view('/pkwtt', 'under-development')->name('pkwtt');
Route::view('/assesment', 'under-development')->name('assesment');
Route::view('/payroll', 'under-development')->name('payroll');
Route::view('/berita-acara', 'under-development')->name('berita-acara');
Route::view('/master', 'master.index')->name('master');

// Setting User Routes - Only Admin can access
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/setting-user', [SettingUserController::class, 'index'])->name('setting-user.index');
    Route::post('/setting-user', [SettingUserController::class, 'store'])->name('setting-user.store');
    Route::put('/setting-user/{id}', [SettingUserController::class, 'update'])->name('setting-user.update');
    Route::delete('/setting-user/{id}', [SettingUserController::class, 'destroy'])->name('setting-user.destroy');
    Route::patch('/setting-user/{id}/toggle-status', [SettingUserController::class, 'toggleStatus'])->name('setting-user.toggle-status');
});

require __DIR__.'/auth.php';
require __DIR__.'/logout.php';
require __DIR__.'/auth_custom.php';


// Tambahkan route kandidat
Route::get('/kandidat', [\App\Http\Controllers\KandidatController::class, 'index'])->name('kandidat.index');
Route::get('/kandidat/{id}/edit', [\App\Http\Controllers\KandidatController::class, 'edit'])->name('kandidat.edit');


