<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $table = "jurnal";
    protected $fillable = ['tanggal', 'keterangan', 'debit', 'kredit'];
}
