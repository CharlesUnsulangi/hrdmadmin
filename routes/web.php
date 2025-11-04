
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// === SEMUA CONTROLLER DI ATAS ===
use App\Http\Controllers\MsHrPelamarTypeController;
use App\Http\Controllers\InterviewMainController;
use App\Http\Controllers\PkwttController;
use App\Http\Controllers\InterviewManagementController;
use App\Http\Controllers\TrHrPelamarInterviewFinanceController;
use App\Http\Controllers\TrHrPelamarInterviewHrdController;
use App\Http\Controllers\TrHrPelamarInterviewMgtController;
use App\Http\Controllers\TrHrPelamarInterviewSpvController;
use App\Http\Controllers\MsDivisionController;
use App\Http\Controllers\MsCompanyController;
use App\Http\Controllers\MsBankController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingUserController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\TrHrPelamarInterviewBodController;
use App\Http\Controllers\TrHrPelamarInterviewAdminController;

// === ROOT REDIRECT ===
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// === DASHBOARD ===
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');
});

// === MASTER DATA ===
Route::resource('ms_hr_pelamar_type', MsHrPelamarTypeController::class);
Route::resource('ms_hr_pelamar_status', \App\Http\Controllers\MsHrPelamarStatusController::class);
Route::resource('ms-division', MsDivisionController::class);
Route::resource('ms-company', MsCompanyController::class);
Route::resource('ms-bank', MsBankController::class);

// === INTERVIEW ===
Route::get('/interview', [InterviewController::class, 'index'])->name('interview');
Route::get('/interview/create', [InterviewController::class, 'create'])->name('interview.create');
Route::get('/manajemen-interview', [InterviewManagementController::class, 'index'])->name('manajemen-interview.index');
Route::resource('interview_main', InterviewMainController::class);
Route::resource('interview_finance', TrHrPelamarInterviewFinanceController::class);
Route::resource('interview_hrd', TrHrPelamarInterviewHrdController::class);
Route::resource('interview_mgt', TrHrPelamarInterviewMgtController::class);
Route::resource('interview_spv', TrHrPelamarInterviewSpvController::class);
Route::resource('interview_bod', TrHrPelamarInterviewBodController::class);
Route::resource('interview_admin', TrHrPelamarInterviewAdminController::class);

// === PKWTT ===
Route::resource('pkwtt', PkwttController::class)->except(['show']);
Route::post('/pkwtt/{id}/promote', [PkwttController::class, 'promote'])->name('pkwtt.promote');

// === KANDIDAT ===
Route::get('/kandidat', [KandidatController::class, 'index'])->name('kandidat.index');
Route::get('/kandidat/{id}/edit', [KandidatController::class, 'edit'])->name('kandidat.edit');
Route::put('/kandidat/{id}', [KandidatController::class, 'update'])->name('kandidat.update');
Route::post('/kandidat/{id}/buat-pkwtt', [KandidatController::class, 'buatPkwtt'])->name('kandidat.buat-pkwtt');

// === PELAMAR (auth) ===
Route::middleware('auth')->group(function () {
    Route::resource('pelamar', PelamarController::class);
    Route::get('/pelamar', [PelamarController::class, 'index'])->name('pelamar.index');
    Route::get('/pelamar/create', [PelamarController::class, 'create'])->name('pelamar.create');
    Route::post('/pelamar', [PelamarController::class, 'store'])->name('pelamar.store');

    // AJAX & Custom
    Route::post('/pelamar/checkid', [PelamarController::class, 'checkId'])->name('pelamar.checkid');
    Route::post('/pelamar/{id}/pengalaman', [PelamarController::class, 'storePengalaman'])->name('pelamar.pengalaman.store');
    Route::delete('/pelamar/pengalaman/{id}', [PelamarController::class, 'destroyPengalaman'])->name('pelamar.pengalaman.destroy');
    Route::post('/pelamar/{id}/jadikan-kandidat', [PelamarController::class, 'jadikanKandidat'])->name('pelamar.jadikanKandidat');
    Route::get('/pelamar/{id}/interview', [PelamarController::class, 'interview'])->name('pelamar.interview');
    Route::post('/pelamar/{id}/tolak', [PelamarController::class, 'tolak'])->name('pelamar.tolak');
    Route::get('/pelamar/{id}/diskusi', [PelamarController::class, 'diskusi'])->name('pelamar.diskusi');
    Route::post('/pelamar/{id}/confirm-jadwal-interview', [PelamarController::class, 'confirmJadwalInterview'])->name('pelamar.confirmJadwalInterview');
    Route::get('/pelamar/{id}/reschedule', [PelamarController::class, 'reschedule'])->name('pelamar.reschedule');
    Route::get('/pelamar/{id}/background-check', [PelamarController::class, 'backgroundCheck'])->name('pelamar.backgroundCheck');
});

// === SETTING USER (admin only) ===
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/setting-user', [SettingUserController::class, 'index'])->name('setting-user.index');
    Route::post('/setting-user', [SettingUserController::class, 'store'])->name('setting-user.store');
    Route::put('/setting-user/{id}', [SettingUserController::class, 'update'])->name('setting-user.update');
    Route::delete('/setting-user/{id}', [SettingUserController::class, 'destroy'])->name('setting-user.destroy');
    Route::patch('/setting-user/{id}/toggle-status', [SettingUserController::class, 'toggleStatus'])->name('setting-user.toggle-status');
});

// === UNDER DEVELOPMENT ===
use App\Http\Controllers\KaryawanController;
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::view('/driver', 'under-development')->name('driver');
Route::view('/kenek', 'under-development')->name('kenek');
Route::view('/assesment', 'under-development')->name('assesment');
Route::view('/payroll', 'under-development')->name('payroll');
Route::view('/berita-acara', 'under-development')->name('berita-acara');
Route::view('/master', 'master.index')->name('master');

// === AUTH ===
require __DIR__.'/auth.php';
require __DIR__.'/logout.php';
require __DIR__.'/auth_custom.php';


