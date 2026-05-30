<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // [CL 99] Membuat Fungsi SQL (Function)
        // Fungsi ini bisa dipanggil di query SQL untuk mengecek apakah harga melebihi batas 500rb
        DB::unprepared("
            DROP FUNCTION IF EXISTS CekBatasAnggaran;
            CREATE FUNCTION CekBatasAnggaran(harga INT) RETURNS VARCHAR(20) DETERMINISTIC
            BEGIN
                IF harga > 500000 THEN
                    RETURN 'Melebihi Batas';
                ELSE
                    RETURN 'Aman';
                END IF;
            END;
        ");

        // [CL 101] Membuat Trigger SQL
        // Trigger ini akan otomatis menolak laporan jika harga barang di atas 500rb saat data baru ditambahkan
        DB::unprepared("
            DROP TRIGGER IF EXISTS validasi_harga_report;
            CREATE TRIGGER validasi_harga_report
            BEFORE INSERT ON reports
            FOR EACH ROW
            BEGIN
                IF NEW.harga > 500000 THEN
                    SET NEW.status = 'rejected';
                    SET NEW.alasan_penolakan = 'Melebihi batas anggaran beasiswa (Rp 500.000)';
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS CekBatasAnggaran;");
        DB::unprepared("DROP TRIGGER IF EXISTS validasi_harga_report;");
    }
};
