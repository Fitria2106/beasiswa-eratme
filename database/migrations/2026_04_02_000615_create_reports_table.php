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
        Spublic function up(): void
{
    Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_laporan'); // Misal: Buku atau ATK
            $table->string('semester');
            $table->string('nama_item');
            $table->text('ringkasan_buku')->nullable(); // Pakai nullable jika ATK tidak butuh ringkasan
            $table->text('keterangan')->nullable();
            $table->integer('harga');
            $table->string('foto_nota')->nullable();
            $table->string('foto_barang')->nullable();
            $table->string('status')->default('pending'); // default status
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
