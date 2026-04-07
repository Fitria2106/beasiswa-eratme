<?php

namespace App\Http\Controllers;

use App\Models\Report; // Pastikan Model Report sudah di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // --- FUNGSI UNTUK MAHASISWA (YANG TADI ERROR) ---
    public function mahasiswa()
    {
        // Mengambil laporan khusus milik mahasiswa yang sedang login
        $reports = Report::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Mengirim data laporan ke view dashboard mahasiswa
        return view('mahasiswa.dashboard', compact('reports'));
    }

    // --- FUNGSI UNTUK ADMIN ---
    public function admin()
    {
        // Mengambil semua laporan dan dikelompokkan berdasarkan user (untuk grouping)
        $allReports = Report::with('user')->orderBy('created_at', 'desc')->get();
        
        return view('admin.dashboard', compact('allReports'));
    }
}