<?php
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Report;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// --- SEMUA ROUTE DI BAWAH INI WAJIB LOGIN ---
Route::middleware(['auth'])->group(function () {

    // 1. KHUSUS ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
       // Ganti dari Route::post menjadi Route::patch
        Route::patch('/admin/report/{id}/status', [DashboardController::class, 'updateStatus'])->name('admin.report.status');
        Route::get('/admin/cetaklaporan', [DashboardController::class, 'cetak_pdf'])->name('admin.cetak_pdf');
        // Route hapus laporan (pindahkan ke sini agar aman)
        Route::delete('/admin/reports/{id}', [ReportController::class, 'destroyAdmin'])->name('admin.report.destroy');
        
        // Contoh route cetak per user
        Route::get('/admin/cetak-pdf/{user_id}', [DashboardController::class, 'cetak_user_pdf']);

        // Route Reset Password Mahasiswa
        Route::post('/admin/mahasiswa/{id}/reset-password', [DashboardController::class, 'resetPassword'])->name('admin.mahasiswa.reset_password');

        // Route untuk menampilkan halaman form tambah mahasiswa
        Route::get('/admin/mahasiswa/create', [DashboardController::class, 'createMahasiswa'])->name('admin.mahasiswa.create');

        // Route untuk menyimpan data mahasiswa baru ke database
        Route::post('/admin/mahasiswa/store', [DashboardController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');
        });

    // 2. KHUSUS MAHASISWA
   // 2. KHUSUS MAHASISWA
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
        Route::get('/upload', [ReportController::class, 'create'])->name('mahasiswa.upload');
        Route::post('/upload', [ReportController::class, 'store'])->name('mahasiswa.store');
        Route::get('/mahasiswa/edit/{id}', [ReportController::class, 'edit'])->name('mahasiswa.edit');
        Route::match(['put', 'patch'], '/mahasiswa/update/{id}', [ReportController::class, 'update'])->name('mahasiswa.update');
        Route::get('/upload-review', [ReportController::class, 'showReviewUploadForm'])->name('mahasiswa.upload_review_form');
        Route::post('/upload-review', [ReportController::class, 'storeReview'])->name('mahasiswa.store_review');
        Route::post('/report/update-review/{id}', [DashboardController::class, 'updateReview'])->name('report.update_review');
        Route::get('/search-campus', [CampusController::class, 'search']);
        
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