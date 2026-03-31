<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class ReportController extends Controller
{
    /**
     * Menyimpan laporan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_laporan' => 'required',
            'semester'      => 'required|integer|between:4,8',
            'nama_item'     => 'required',
            'ringkasan_buku'=> 'nullable|string', 
            'keterangan'    => 'nullable|string', 
            'harga'         => 'required|numeric',
            'foto_nota'     => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'foto_barang'   => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $pathNota = $request->file('foto_nota')->store('notas', 'public');
        $pathBarang = $request->file('foto_barang')->store('barangs', 'public');

        Report::create([
            'user_id'       => Auth::id(),
            'jenis_laporan' => $request->jenis_laporan,
            'semester'      => $request->semester,
            'nama_item'     => $request->nama_item,
            'ringkasan_buku'=> $request->ringkasan_buku, 
            'keterangan'    => $request->keterangan,
            'harga'         => $request->harga,
            'foto_nota'     => $pathNota,
            'foto_barang'   => $pathBarang,
            'status'        => 'pending',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Laporan Beasiswa Berhasil Dikirim!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $report = Report::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($report->status === 'disetujui') {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Laporan yang sudah disetujui tidak dapat diubah.');
        }

        return view('mahasiswa.edit', compact('report'));
    }

    /**
     * Memperbarui laporan (Update)
     */
    public function update(Request $request, $id)
    {
        $report = Report::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // 1. Validasi dulu semua data yang masuk
        $request->validate([
            'semester'      => 'required|integer|between:4,8',
            'nama_item'     => 'required|string|max:255',
            'ringkasan_buku'=> 'nullable|string',
            'keterangan'    => 'nullable|string',
            'harga'         => 'required|numeric',
            'foto_nota'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_barang'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Isi data ke objek model
        $report->semester       = $request->semester;
        $report->nama_item       = $request->nama_item;
        $report->ringkasan_buku = $request->ringkasan_buku; // Masukkan ke sini
        $report->keterangan     = $request->keterangan;     // Masukkan ke sini
        $report->harga          = $request->harga;
        $report->status         = 'pending'; // Reset status jadi pending jika diedit
        $report->alasan_penolakan = null;

        // 3. Proses upload file jika ada file baru
        if ($request->hasFile('foto_nota')) {
            if ($report->foto_nota) { Storage::disk('public')->delete($report->foto_nota); }
            $report->foto_nota = $request->file('foto_nota')->store('notas', 'public');
        }

        if ($request->hasFile('foto_barang')) {
            if ($report->foto_barang) { Storage::disk('public')->delete($report->foto_barang); }
            $report->foto_barang = $request->file('foto_barang')->store('barangs', 'public');
        }

        // 4. Simpan perubahan
        $report->save();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan (Destroy)
     */
    public function destroy($id)
    {
        $report = Report::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($report->status === 'disetujui') {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Laporan yang sudah disetujui tidak dapat dihapus.');
        }

        if ($report->foto_nota) { Storage::disk('public')->delete($report->foto_nota); }
        if ($report->foto_barang) { Storage::disk('public')->delete($report->foto_barang); }

        $report->delete();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Laporan berhasil dihapus.');
    }
}