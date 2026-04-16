<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// --- SEMUA ROUTE DI BAWAH INI WAJIB LOGIN ---
Route::middleware(['auth'])->group(function () {

    // 1. KHUSUS ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::post('/admin/report/{id}/status', [DashboardController::class, 'updateStatus'])->name('admin.report.status');
        Route::get('/admin/cetaklaporan', [DashboardController::class, 'cetak_pdf'])->name('admin.cetak_pdf');
        // Route hapus laporan (pindahkan ke sini agar aman)
        Route::delete('/admin/reports/{id}', [ReportController::class, 'destroyAdmin'])->name('admin.report.destroy');
    });

    // 2. KHUSUS MAHASISWA
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
        
        // Route Upload (Tampilan Form)
        Route::get('/upload', [ReportController::class, 'create'])->name('mahasiswa.upload');
        
        // Route Simpan Data (Inilah yang tadi error "Route Not Found")
        Route::post('/upload', [ReportController::class, 'store'])->name('mahasiswa.store');
        
        Route::get('/mahasiswa/edit/{id}', [ReportController::class, 'edit'])->name('mahasiswa.edit');
        Route::patch('/mahasiswa/update/{id}', [ReportController::class, 'update'])->name('mahasiswa.update');
    });

    // 3. PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. ROUTE PENENGAH (REDIRECTOR)
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'mahasiswa') {
        return redirect()->route('mahasiswa.dashboard');
    }
    return redirect('/')->with('error', 'Role tidak dikenali.');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';