<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LandingController,
    LoginController,
    AdminController,
    CandidateController,
    DashboardController,
    VotersController, // Pastikan ini untuk Admin
    VoterController,  // Pastikan ini untuk interface Pemilih
    CandidateRegistrationController
};

// ================= PUBLIC ROUTES =================
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/daftar-kandidat', [CandidateRegistrationController::class, 'index'])->name('register.kandidat');
Route::post('/daftar-kandidat', [CandidateRegistrationController::class, 'store'])->name('register.kandidat.store');

// ================= AUTH ROUTES =================
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

// ================= PROTECTED ROUTES (Admin & User) =================
Route::middleware(['auth'])->group(function () {

    // --- Khusus Admin & Check Role ---
    Route::middleware(['check.user.role'])->group(function () {
        
        // 1. Dashboard
        Route::prefix('dashboard')->name('dashboard.')->controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/generate-pdf', 'generatePDF')->name('generate-pdf');
            Route::post('/send-report-emails', 'sendReportEmails')->name('send-report-emails');
        });

        // 2. Voters Management (Manajemen Pemilih)
        // Gunakan satu group prefix untuk semua aksi voters
        Route::prefix('voters')->name('voters.')->group(function () {
            // Route aksi khusus (Diletakkan SEBELUM resource)
            Route::post('/mass-delete', [VotersController::class, 'massDelete'])->name('massDelete');
            Route::get('/export/excel', [VotersController::class, 'exportExcel'])->name('export.excel');
            Route::get('/export/pdf', [VotersController::class, 'exportPdf'])->name('export.pdf');
            Route::post('/import/excel', [VotersController::class, 'importExcel'])->name('import.excel');
            
            // CRUD Standar manual untuk menghindari bentrok dengan Route::resource
            Route::get('/', [VotersController::class, 'index'])->name('index');
            Route::post('/', [VotersController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [VotersController::class, 'edit'])->name('edit');
            Route::put('/{id}', [VotersController::class, 'update'])->name('update');
            Route::delete('/{id}', [VotersController::class, 'destroy'])->name('destroy');
        });

        // 3. Candidate & Admin Management
        Route::resource('candidate', CandidateController::class)->except(['create', 'show']);
        Route::resource('admin', AdminController::class)->except(['create', 'show']);
        Route::delete('/admin/kandidat/{id}', [CandidateController::class, 'destroy'])->name('kandidat.destroy');

        // 4. Verifikasi Kandidat
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/verifikasi-kandidat', [CandidateRegistrationController::class, 'adminIndex'])->name('verifikasi');
            Route::patch('/verifikasi-kandidat/{id}/update', [CandidateRegistrationController::class, 'updateStatus'])->name('verifikasi.update');
        });
    });

    // --- Interface Pemilih (HAPUS mass-delete dari sini karena ini sisi pemilih/user) ---
    Route::prefix('voter')->name('voter.')->controller(VoterController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/result', 'result')->name('result');
    });
});