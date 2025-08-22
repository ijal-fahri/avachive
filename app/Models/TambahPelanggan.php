<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TambahPelanggan extends Model
{
    protected $fillable = ['nama', 'no_handphone', 'provinsi', 'kota','kecamatan','kodepos','detail_alamat'];
}
