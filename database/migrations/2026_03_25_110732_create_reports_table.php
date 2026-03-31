<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('semester');
            $table->enum('jenis_laporan', ['buku', 'barang_penunjang']);
            $table->string('nama_item');
            $table->integer('harga');
            $table->text('keterangan')->nullable();
            $table->string('foto_nota');
            $table->string('foto_barang');
            $table->string('status')->default('pending'); // pending, disetujui, ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};