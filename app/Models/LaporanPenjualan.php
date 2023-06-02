<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    protected $table = "lap_penjualan"; // nama tablenya adalah lap_penjualan
    protected $fillable = ['bulan', 'tahun']; // fillable digunakan untuk field apa saja yang dapat diisi lewat form
}
