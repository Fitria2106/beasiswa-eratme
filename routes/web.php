<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

// --- SEMUA ROUTE DI BAWAH INI WAJIB LOGIN (AUTH) ---
Route::middleware(['auth'])->group(function () {

    // 1. KHUSUS ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::post('/admin/report/{id}/status', [DashboardController::class, 'updateStatus'])->name('admin.report.status');
        Route::get('/admin/cetaklaporan', [DashboardController::class, 'cetak_pdf'])->name('admin.cetak_pdf');
    });

    // 2. KHUSUS MAHASISWA
    Route::middleware(['role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
    
    // Menampilkan halaman form (Pastikan file ada di resources/views/upload.blade.php)
    Route::get('/upload', function () { 
        return view('mahasiswa.upload'); 
    })->name('mahasiswa.upload');

    Route::get('/mahasiswa/edit/{id}', [ReportController::class, 'edit'])->name('mahasiswa.edit');
    
    // Memproses update data
    Route::put('/mahasiswa/update/{id}', [ReportController::class, 'update'])->name('mahasiswa.update');

    // Proses simpan menggunakan ReportController
    Route::post('/upload', [ReportController::class, 'store'])->name('mahasiswa.store');

    });

    // 3. PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

}); // <--- PENUTUP MIDDLEWARE AUTH (Hanya satu di sini)

// 4. ROUTE PENENGAH (Harus di luar grup auth agar tidak konflik)
Route::get('/dashboard', function () {
    $user = auth()->user();

    // Cek apakah user benar-benar punya role
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'mahasiswa') {
        return redirect()->route('mahasiswa.dashboard');
    }

    // Jika role tidak dikenal, lempar ke halaman awal atau logout
    return redirect('/')->with('error', 'Role tidak dikenali.');
})->middleware(['auth'])->name('dashboard');


// Route hapus laporan khusus admin
// Tambahkan barsis ini
Route::delete('/admin/reports/{id}', [ReportController::class, 'destroyAdmin'])->name('admin.report.destroy');


require __DIR__.'/auth.php';