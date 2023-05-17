<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = "mobil";
    protected $fillable = ['merek', 'tipe', 'stok', 'harga', 'gambar'];

    public function purchases()
    {
        return $this->hasMany(Order::class);
    }
}
