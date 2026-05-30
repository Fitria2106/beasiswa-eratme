<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Cari user mahasiswa pertama (misal: user id 2)
        $user = User::where('role', 'mahasiswa')->first();

        if (!$user) {
            echo "Tidak ada user mahasiswa ditemukan.\n";
            return;
        }

        // Buat 5 Laporan Buku Dummy (Status: Disetujui)
        for ($i = 1; $i <= 5; $i++) {
            Report::create([
                'user_id'       => $user->id,
                'jenis_laporan' => 'buku',
                'semester'      => 4,
                'nama_item'     => 'Buku Dummy Referensi ke-' . $i,
                'ringkasan_buku'=> 'Ini adalah ringkasan buku dummy untuk keperluan pengujian sistem.',
                'harga'         => 160000, // 5 x 160.000 = 800.000 (Memenuhi syarat > 750.000)
                'foto_nota'     => 'dummy_nota.jpg', // Data dummy
                'foto_barang'   => 'dummy_barang.jpg', // Data dummy
                'status'        => 'disetujui',
                'video_link'    => null,
                'hashtag_proof' => null,
            ]);
        }

        echo "Berhasil membuat 5 laporan buku dummy untuk mahasiswa: " . $user->name . "\n";
    }
}
