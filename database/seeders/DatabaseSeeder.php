<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    \App\Models\User::create([
        'name' => 'KbfAdmin',
        'email' => 'admin@eratme.com', // Ganti dengan email kamu
        'password' => Hash::make('password123'), // Ganti password yang kuat
        'role' => 'admin',
        'nim' => '000000', // Admin tetap butuh isi kolom NIM jika di migrasi kamu 'required'
    ]);
}
}
