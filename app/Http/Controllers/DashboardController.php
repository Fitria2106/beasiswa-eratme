<?php

namespace App\Http\Controllers;

use App\Models\Report; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // --- FUNGSI UNTUK MAHASISWA ---
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
        // 1. Mengambil data reports untuk tabel
        $allReports = \App\Models\Report::with('user')->orderBy('created_at', 'desc')->get();

        // 2. Menghitung statistik untuk kotak info
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalItem = $allReports->count();
        
        // 3. Tambahkan totalMahasiswa dan totalItem ke dalam compact
        return view('admin.dashboard', compact('allReports', 'totalMahasiswa', 'totalItem'));
    }

    // --- FUNGSI CETAK PDF ADMIN ---
    public function cetak_pdf()
    {
        // 1. Ambil data dari database dan simpan di variabel $allReports
        $allReports = \App\Models\Report::with('user')
            ->where('status', 'disetujui')
            ->get();

        // 2. Kirim variabel $allReports ke dalam view menggunakan compact()
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan_pdf', compact('allReports'));

        // 3. Download file
        return $pdf->download('laporan-keuangan-eratme.pdf');
    }

    // --- FUNGSI UPDATE STATUS OLEH ADMIN ---
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

    // --- FUNGSI UPDATE REVIEW OLEH MAHASISWA (FITUR BARU) ---
    public function updateReview(Request $request, $id)
    {
        // 1. Validasi: Pastikan input video adalah URL dan bukti tag adalah gambar
        $request->validate([
            'video_link' => 'required|url',
            'hashtag_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'video_link.url' => 'Format link video tidak valid.',
            'hashtag_proof.image' => 'Bukti tag harus berupa gambar.',
            'hashtag_proof.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'hashtag_proof.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        // 2. Cari data laporan milik mahasiswa yang sedang login
        $report = \App\Models\Report::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        // 3. Upload gambar bukti tag ke storage
        $dataToUpdate = [
            'video_link' => $request->video_link,
        ];
        
        if ($request->hasFile('hashtag_proof')) {
            // (Opsional) Hapus file lama jika ada dan bukan URL
            if ($report->hashtag_proof && !\Illuminate\Support\Str::startsWith($report->hashtag_proof, ['http://', 'https://'])) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($report->hashtag_proof);
            }
            $dataToUpdate['hashtag_proof'] = $request->file('hashtag_proof')->store('proofs', 'public');
        }

        // 4. Simpan ke database
        $report->update($dataToUpdate);

        // 5. Kembali ke dashboard dengan notifikasi sukses
        return redirect()->back()->with('success', 'Review buku dan bukti tag berhasil diperbarui!');
    }

    // --- FUNGSI RESET PASSWORD MAHASISWA OLEH ADMIN ---
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make('eramet2026')
        ]);

        return redirect()->back()->with('success', 'Password mahasiswa berhasil di-reset menjadi "eramet2026"!');
    }

        // 1. Fungsi menampilkan halaman form
    public function createMahasiswa()
    {
        return view('admin.mahasiswa.create');
    }
    // 2. Fungsi memproses dan menyimpan ke database
    public function storeMahasiswa(Request $request)
    {
        // Validasi data yang diinput admin
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nim' => 'required|string|max:50|unique:users',
            'jurusan' => 'required|string|max:100',
            'password' => 'required|string|min:8', // Minimal 8 karakter
        ]);
        // Simpan akun baru ke tabel users
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'role' => 'mahasiswa', // Otomatis jadikan mahasiswa
            'password' => Hash::make($request->password), // Enkripsi password
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'Akun Mahasiswa berhasil ditambahkan!');
    }
}