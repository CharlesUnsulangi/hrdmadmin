

<?php
// Payroll Non Bulanan
use App\Http\Controllers\PayrollNonMonthlyController;
Route::get('/payroll/nonmonthly/{code_h}/edit', [PayrollNonMonthlyController::class, 'edit'])->name('payroll.nonmonthly.edit');
Route::put('/payroll/nonmonthly/{code_h}', [PayrollNonMonthlyController::class, 'update'])->name('payroll.nonmonthly.update');

// Payroll Bulanan Detail
use App\Http\Controllers\PayrollMonthlyDetailController;
Route::get('/payroll/monthly/{code_h}/detail', [PayrollMonthlyDetailController::class, 'show'])->name('payroll.monthly.detail');

// Payroll Bulanan Draft
use App\Http\Controllers\PayrollMonthlyDraftController;
Route::get('/payroll/monthly-h/create', [PayrollMonthlyDraftController::class, 'create'])->name('payroll.monthly.h.create');
Route::post('/payroll/monthly-h/store', [PayrollMonthlyDraftController::class, 'store'])->name('payroll.monthly.h.store');

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// === SEMUA CONTROLLER DI ATAS ===
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollDraftDetailController;
use App\Http\Controllers\EmployeeController;
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
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\AdminItController;

//Payroll
Route::get('/payroll/draft-detail', [PayrollDraftDetailController::class, 'index'])->name('payroll.draft.detail.index');
Route::get('/payroll/draft-detail/create', [PayrollDraftDetailController::class, 'create'])->name('payroll.draft.detail.create');
Route::post('/payroll/draft-detail/store', [PayrollDraftDetailController::class, 'store'])->name('payroll.draft.detail.store');
Route::post('/admin-it/ajax-execute/{id}', [AdminItController::class, 'ajaxExecute'])->name('admin-it.ajax-execute');
//SP
Route::get('/admin-it', [AdminItController::class, 'index'])->name('admin-it');
Route::post('/admin-it/execute/{id}', [AdminItController::class, 'execute'])->name('admin-it.execute');
Route::post('/employee/{id}/resign', [EmployeeController::class, 'updateResign'])->name('employee.updateResign');
Route::get('/payroll/draft', [PayrollController::class, 'createDraft'])->name('payroll.draft');
Route::post('/payroll/draft', [PayrollController::class, 'storeDraft'])->name('payroll.draft.store');

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
// Route untuk menyimpan interview (POST)
Route::post('/interview', [App\Http\Controllers\InterviewController::class, 'store'])->name('interview.store');
// === MASTER BA KEJADIAN ===
use App\Http\Controllers\MsHrBaKejadianController;
Route::resource('ms-hr-ba-kejadian', MsHrBaKejadianController::class);

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
    Route::get('/pelamar/open', [PelamarController::class, 'open'])->name('pelamar.open');
    Route::get('/pelamar/create', [PelamarController::class, 'create'])->name('pelamar.create');
    Route::post('/pelamar', [PelamarController::class, 'store'])->name('pelamar.store');
    // Kirim WA Link
    Route::get('/pelamar/{id}/kirim-wa-link', [PelamarController::class, 'kirimWaLink'])->name('pelamar.kirimWaLink');

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

        // Kirim WhatsApp
        Route::post('/pelamar/{id}/kirim-wa', [PelamarController::class, 'kirimWa'])->name('pelamar.kirimWa');
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
Route::view('/driver', 'under-development')->name('driver');
Route::view('/kenek', 'under-development')->name('kenek');
Route::view('/assesment', 'under-development')->name('assesment');
// use App\Http\Controllers\PayrollController; // Dihapus duplikat
Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll');
Route::view('/berita-acara', 'under-development')->name('berita-acara');
Route::view('/master', 'master.index')->name('master');


Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::post('/employee/{id}/create-pkwtt', [EmployeeController::class, 'createPkwtt'])->name('employee.create-pkwtt');


// Berita Acara Routes - Protected by auth middleware
Route::middleware(['auth'])->group(function () {
// Index accessible by all authenticated users
Route::get('/berita-acara', [BeritaAcaraController::class, 'index'])->name('berita-acara.index');

// Create/Store accessible by all authenticated users (Operator & Admin)
Route::get('/berita-acara/create', [BeritaAcaraController::class, 'create'])->name('berita-acara.create');
Route::post('/berita-acara', [BeritaAcaraController::class, 'store'])->name('berita-acara.store');

// View accessible by all authenticated users
Route::get('/berita-acara/{id}', [BeritaAcaraController::class, 'show'])->name('berita-acara.show');

// Add details for 2-step process
Route::get('/berita-acara/{id}/add-details', [BeritaAcaraController::class, 'addDetails'])->name('berita-acara.add-details');
Route::post('/berita-acara/{id}/store-details', [BeritaAcaraController::class, 'storeDetails'])->name('berita-acara.store-details');

// Edit/Update/Delete only accessible by Admin/HR
Route::middleware(['admin'])->group(function () {
    Route::get('/berita-acara/{id}/edit', [BeritaAcaraController::class, 'edit'])->name('berita-acara.edit');
    Route::put('/berita-acara/{id}', [BeritaAcaraController::class, 'update'])->name('berita-acara.update');
    Route::delete('/berita-acara/{id}', [BeritaAcaraController::class, 'destroy'])->name('berita-acara.destroy');
});
});

// === AUTH ===
require __DIR__.'/auth.php';
require __DIR__.'/logout.php';
require __DIR__.'/auth_custom.php';


