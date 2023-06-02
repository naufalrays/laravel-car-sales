<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = "mobil"; // table adalah nama tablenya
    protected $fillable = ['merek', 'tipe', 'stok', 'harga', 'gambar']; // fillable digunakan untuk field apa saja yang dapat diisi lewat form

    public function pemesanan() // Ini adalah untuk relasi 1 to Many || pemesanan adalah nama database Pemesanan (Harus Nama Database)
    {
        return $this->hasMany(Pemesanan::class);
    }
}
