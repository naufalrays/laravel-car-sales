<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'Pemesanan'; // table adalah nama tablenya

    protected $fillable = [
        'user_id',
        'mobil_id',
        'nama_penerima',
        'nomor_penerima',
        'alamat_penerima',
        'jumlah',
        'harga_total',
    ]; // fillable digunakan untuk field apa saja yang dapat diisi lewat form

    public function mobil() // Ini adalah untuk relasi 1 to Many || mobil adalah nama database Mobil (Harus Nama Database)
    {
        return $this->belongsTo(Mobil::class);
    }

    public function user() // Ini adalah untuk relasi 1 to Many || user adalah nama database User (Harus Nama Database) 
    {
        return $this->belongsTo(User::class);
    }

    public function penjualan() // Ini adalah untuk relasi 1 to Many || pemesanan adalah nama database Pemesanan (Harus Nama Database)
    {
        return $this->hasMany(Penjualan::class);
    }
}
