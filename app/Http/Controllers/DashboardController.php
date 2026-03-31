<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    // 1. Fungsi untuk Dashboard Admin
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

    // 2. Fungsi untuk Dashboard Mahasiswa (YANG TADI HILANG)
    public function mahasiswa()
    {
        // Mengambil laporan milik mahasiswa yang sedang login saja
        $reports = Report::where('user_id', auth()->id())->latest()->get();
        return view('mahasiswa.dashboard', compact('reports'));
    }

    // 3. Fungsi Cetak PDF (Versi Efisien Berkelompok)
    public function cetak_pdf() 
    {
        // Mengelompokkan data berdasarkan user_id
        $grouped_reports = Report::with('user')->get()->groupBy('user_id');

        // Panggil dengan Pdf:: (P besar, d dan f kecil)
        $pdf = Pdf::loadView('admin.cetak_pdf', compact('grouped_reports'));
        
        return $pdf->stream('laporan-beasiswa.pdf');
    }

    // 4. Fungsi Update Status
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