<?php

namespace App\Http\Controllers;

use App\Models\Report; // Pastikan Model Report sudah di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;


class DashboardController extends Controller
{
    // --- FUNGSI UNTUK MAHASISWA (YANG TADI ERROR) ---
    public function mahasiswa()
    {
        // Mengambil laporan khusus milik mahasiswa yang sedang login
        $reports = \App\Models\Report::where('user_id', auth()->id())->get();

        // Mengirim data laporan ke view dashboard mahasiswa
        return view('mahasiswa.dashboard', compact('reports'));
    }

    // --- FUNGSI UNTUK ADMIN ---
    // app\Http\Controllers\DashboardController.php

public function admin()
{
    // 1. Mengambil data reports untuk tabel
    $allReports = \App\Models\Report::with('user')->orderBy('created_at', 'desc')->get();

    // 2. Menghitung statistik untuk kotak info
    $totalMahasiswa = User::where('role', 'mahasiswa')->count();
    $totalItem = $allReports->count();
    
    // 3. Tambahkan totalMahasiswa dan totalItem ke dalam compact
    return view('admin.dashboard', compact('allReports', 'totalMahasiswa', 'totalItem'));
}

    // Tambahkan fungsi ini di dalam DashboardController kamu
    
 public function cetak_pdf()
{
    // 1. Ambil data dari database dan simpan di variabel $allReports
    $allReports = \App\Models\Report::with('user')
        ->where('status', 'disetujui')
        ->get();

    // 2. Kirim variabel $allReports ke dalam view menggunakan compact()
    // PASTIKAN tulisan di dalam compact sama persis dengan nama variabel di atas (tanpa $)
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan_pdf', compact('allReports'));

    // 3. Download file
    return $pdf->download('laporan-keuangan-eratme.pdf');
}
   public function updateStatus(Request $request, $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        
        // Validasi agar hanya menerima status tertentu
        $request->validate([
            'status' => 'required|in:disetujui,ditolak,pending'
        ]);
    
        $report->update([
            'status' => $request->status
        ]);
    
        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui!');
    }
}
