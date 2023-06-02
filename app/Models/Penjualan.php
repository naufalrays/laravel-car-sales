<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan'; // table adalah nama tablenya

    public function user() // Ini adalah untuk relasi 1 to Many || user adalah nama database User (Harus Nama Database) 
    {
        return $this->belongsTo(User::class);
    }

    public function pemesanan() // Ini adalah untuk relasi 1 to Many || mobil adalah nama database Mobil (Harus Nama Database)
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
