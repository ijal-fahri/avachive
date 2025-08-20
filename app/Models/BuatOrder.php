<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuatOrder extends Model
{
    protected $fillable = [
        'tambah_pelanggan_id',
        'layanan',
        'metode_pembayaran',
        'waktu_pembayaran',
        'metode_pengambilan',
        'total_harga',
        'status',
        'cabang_id',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(TambahPelanggan::class, 'tambah_pelanggan_id');
    }
}