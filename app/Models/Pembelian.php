<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian';

    protected $fillable = [
        'id_akun',
        'id_mobil',
        'nama_penerima',
        'nomor_penerima',
        'alamat_penerima',
        'jumlah',
        'harga_total',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
