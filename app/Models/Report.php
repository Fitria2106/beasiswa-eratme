<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{

    use HasFactory;
    // Pastikan SEMUA kolom ini ada di dalam array fillable
    protected $table = 'reports';
    protected $fillable = [
        'user_id',
        'jenis_laporan',
        'semester',
        'nama_item',
        'ringkasan_buku',
        'keterangan',
        'harga',
        'foto_nota',
        'foto_barang',
        'status',
        'alasan_penolakan'
    ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }
}