<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom role.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kita tambahkan kolom 'role' setelah kolom 'email'
            // Defaultnya kita set 'mahasiswa' agar tidak perlu isi manual satu-satu
            $table->string('role')->default('mahasiswa')->after('email');
        });
    }

    /**
     * Batalkan migrasi (hapus kolom jika di-rollback).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};