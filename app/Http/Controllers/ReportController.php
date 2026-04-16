<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class ReportController extends Controller
{
    // 1. Simpan Laporan Baru
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

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Laporan Berhasil Dikirim!');
    }

    // 2. Form Edit
    public function edit($id)
    {
        $report = Report::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('mahasiswa.edit', compact('report'));
    }

    // 3. Update Laporan
    public function update(Request $request, $id)
    {
        $report = Report::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nama_item' => 'required|string|max:255',
            'harga'     => 'required|numeric',
        ]);

        $report->nama_item = $request->nama_item;
        $report->harga = $request->harga;
        
        if ($request->hasFile('foto_nota')) {
            if ($report->foto_nota) { Storage::disk('public')->delete($report->foto_nota); }
            $report->foto_nota = $request->file('foto_nota')->store('notas', 'public');
        }

        if ($request->hasFile('foto_barang')) {
            if ($report->foto_barang) { Storage::disk('public')->delete($report->foto_barang); }
            $report->foto_barang = $request->file('foto_barang')->store('barangs', 'public');
        }

        $report->save(); 
        return redirect()->route('mahasiswa.dashboard')->with('success', 'Laporan diperbarui!');
    }

    // 4. Hapus Laporan
    public function destroyAdmin($id)
    {
        $report = Report::findOrFail($id);
        if ($report->foto_nota) { Storage::disk('public')->delete($report->foto_nota); }
        if ($report->foto_barang) { Storage::disk('public')->delete($report->foto_barang); }
        $report->delete();
        return redirect()->back()->with('success', 'Laporan dihapus.');
    }
} // TUTUP CLASS (PASTIKAN HANYA ADA SATU DI AKHIR FILE)
