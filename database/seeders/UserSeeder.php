<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Eramet',
            'email' => 'admin@eramet.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'nim' => 'ADMIN001',
            'jurusan' => '-',
        ]);

        // 2. Buat Akun Mahasiswa (Fitria)
        User::create([
            'name' => 'Fitria Yosefina',
            'email' => 'fitria@student.com',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
            'nim' => '1234567890',
            'jurusan' => 'S1 Informatika',
        ]);

        // 3. Buat Akun Mahasiswa Tambahan
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@student.com',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
            'nim' => '0987654321',
            'jurusan' => 'S1 Sistem Informasi',
        ]);
    }
}