<?php

namespace App\Http\Controllers;

use App\Models\Report; // Pastikan Model Report sudah di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function admin()
    {
        // Mengambil semua laporan dan dikelompokkan berdasarkan user (untuk grouping)
        $allReports = Report::with('user')->orderBy('created_at', 'desc')->get();
    
        // Menghitung total transaksi (jumlah baris di tabel reports)
        $totalTransaksi = $allReports->count();
    
    return view('admin.dashboard', compact('allReports', 'totalTransaksi'));

    }

    // Tambahkan fungsi ini di dalam DashboardController kamu
    
        public function cetak_pdf()
    {
        // 1. Mengambil data laporan beserta data user (mahasiswa)
        $reports = Report::with('user')->get();
        
        // 2. Kelompokkan berdasarkan User ID
        $grouped_reports = $reports->groupBy('user_id');

        // 3. Load view dan aktifkan akses gambar (logo) dari URL luar
        $pdf = Pdf::loadView('admin.cetak_pdf', compact('grouped_reports'))
                  ->setOption(['isRemoteEnabled' => true]); // Cara cepat aktifkan logo
        
        // 4. Atur ukuran kertas
        $pdf->setPaper('a4', 'portrait');
        
        // 5. Tampilkan di browser
        return $pdf->stream('Laporan-Beasiswa-Eratme.pdf');
    }
   public function updateStatus(Request $request, $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        $report->status = $request->status; // Mengambil value 'disetujui' dari input hidden
        $report->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}
