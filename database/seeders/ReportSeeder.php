<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        Report::create([
            'user_id' => 2, // ID milik Fitria
            'jenis_laporan' => 'barang_penunjang',
            'semester' => 4,
            'nama_item' => 'Kertas A4 & Tinta Printer',
            'keterangan' => 'Untuk keperluan cetak tugas laporan mingguan.',
            'harga' => 150000,
            'foto_nota' => 'notas/dummy-nota.jpg',
            'foto_barang' => 'barangs/dummy-barang.jpg',
            'status' => 'disetujui',
        ]);

        Report::create([
            'user_id' => 2,
            'jenis_laporan' => 'buku',
            'semester' => 4,
            'nama_item' => 'Buku Pemrograman Laravel',
            'ringkasan_buku' => 'Buku ini membahas dasar-dasar MVC di Laravel.',
            'harga' => 85000,
            'foto_nota' => 'notas/dummy-nota2.jpg',
            'foto_barang' => 'barangs/dummy-buku.jpg',
            'status' => 'pending',
        ]);
    }
}