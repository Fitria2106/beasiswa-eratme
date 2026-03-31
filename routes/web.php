<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// --- SEMUA ROUTE DI BAWAH INI WAJIB LOGIN (AUTH) ---
Route::middleware(['auth'])->group(function () {

    // 1. KHUSUS ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::post('/admin/report/{id}/status', [DashboardController::class, 'updateStatus'])->name('admin.report.status');
        Route::get('/admin/cetaklaporan', [DashboardController::class, 'cetak_PDF'])->name('admin.cetak');
    });

    // 2. KHUSUS MAHASISWA
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
        
        // --- PROSES CRUD LAPORAN ---
        // Create (Tampil Form & Simpan)
        Route::get('/upload', function () { return view('mahasiswa.upload'); })->name('mahasiswa.upload');
        Route::post('/upload', [ReportController::class, 'store'])->name('mahasiswa.store');

        // Read & Update (Edit Form & Update Data)
        Route::get('/report/{id}/edit', [ReportController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/report/{id}', [ReportController::class, 'update'])->name('mahasiswa.update');

        // Delete
        Route::delete('/report/{id}', [ReportController::class, 'destroy'])->name('mahasiswa.destroy');
    });

    // 3. PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route penengah dashboard
Route::get('/dashboard', function () {
    return auth()->user()->role === 'admin' 
        ? redirect()->route('admin.dashboard') 
        : redirect()->route('mahasiswa.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';