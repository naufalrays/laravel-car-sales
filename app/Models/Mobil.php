<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = "mobil"; // table adalah nama tablenya
    protected $fillable = ['merek', 'tipe', 'stok', 'harga', 'gambar']; // fillable digunakan untuk field apa saja yang dapat diisi lewat form

    public function pembelian() // Ini adalah untuk relasi 1 to Many || pembelian adalah nama database Pembelian (Harus Nama Database)
    {
        return $this->hasMany(Pembelian::class);
    }
}
