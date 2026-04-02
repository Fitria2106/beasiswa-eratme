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
     */
    public function admin() 
    {
        $user = Auth::user();

        // Pastikan pengecekan role sudah benar (huruf kecil semua)
        if ($user->role === 'admin') {
            // Ambil SEMUA laporan dan sertakan data user-nya (Eager Loading)
            $allReports = Report::with('user')->orderBy('created_at', 'desc')->get();

            // CEK DI SINI: Kirim variabel $allReports ke view
            return view('admin.dashboard', compact('allReports'));
        }

        return redirect()->route('mahasiswa.dashboard');
    }

    /**
     * 2. Dashboard untuk Mahasiswa
     */
    public function mahasiswa()
    {
        // 1. Ambil data user yang sedang login
        $user = Auth::user();

        // 2. Ambil laporan milik mahasiswa ini saja
        $reports = Report::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
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