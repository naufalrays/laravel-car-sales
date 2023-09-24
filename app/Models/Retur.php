<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $table = "retur"; // table adalah nama tablenya
    protected $fillable = [
        'user_id',
        'mobil_id',
        'nomor_retur',
        'jumlah_retur',
        'harga_total_retur',
        'status',
        'alasan_retur',
    ]; // fillable digunakan untuk field apa saja yang dapat diisi lewat form

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
