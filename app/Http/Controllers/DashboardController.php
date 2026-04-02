<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * 1. Dashboard untuk Admin
     * Menampilkan semua laporan dan ringkasan dana
     */
    public function admin()
    {
        $all_reports = Report::with('user')->latest()->get();
        $totalPengeluaran = Report::sum('harga');
        $totalBuku = Report::where('jenis_laporan', 'buku')->sum('harga');
        $totalATK = Report::where('jenis_laporan', 'barang_penunjang')->sum('harga');
        $jumlahLaporan = $all_reports->count();

        return view('admin.dashboard', compact(
            'all_reports', 'totalPengeluaran', 'totalBuku', 'totalATK', 'jumlahLaporan'
        ));
    }

    /**
     * 2. Dashboard untuk Mahasiswa
     * Menampilkan laporan milik mahasiswa yang sedang login saja
     */
    public function mahasiswa()
    {
        // Mengambil semua laporan milik user yang login, diurutkan dari yang terbaru
        $reports = Report::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Mengirim variabel $reports ke view dashboard
        return view('mahasiswa.dashboard', compact('reports'));
    }

    /**
     * 3. Fungsi Cetak PDF untuk Admin
     */
    public function cetak_pdf() 
    {
        // Mengelompokkan data berdasarkan user_id untuk laporan yang rapi
        $grouped_reports = Report::with('user')->get()->groupBy('user_id');

        $pdf = Pdf::loadView('admin.cetak_pdf', compact('grouped_reports'));
        
        return $pdf->stream('laporan-beasiswa.pdf');
    }

    /**
     * 4. Update Status Laporan (Setuju/Tolak) oleh Admin
     */
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->status = $request->status;
        
        if ($request->status == 'ditolak') {
            $report->alasan_penolakan = $request->keterangan_admin;
        } else {
            $report->alasan_penolakan = null;
        }
        
        $report->save();
        return redirect()->back()->with('success', 'Status laporan diperbarui!');
    }
}