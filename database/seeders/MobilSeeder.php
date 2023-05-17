<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mobil::create([
            'merek' => 'Suzuki',
            'tipe' => 'S-Presso',
            'stok' => '8',
            'harga' => '160000000',
            'gambar' => 'S-Presso.png'
        ]);
        Mobil::create([
            'merek' => 'Suzuki',
            'tipe' => 'Baleno',
            'stok' => '4',
            'harga' => '230000000',
            'gambar' => 'Baleno.png'
        ]);
        Mobil::create([
            'merek' => 'Suzuki',
            'tipe' => 'Ignis',
            'stok' => '2',
            'harga' => '209000000',
            'gambar' => 'Ignis.png'
        ]);
        Mobil::create([
            'merek' => 'Suzuki',
            'tipe' => 'XL7',
            'stok' => '2',
            'harga' => '290000000',
            'gambar' => 'XL7.png'
        ]);
        Mobil::create([
            'merek' => 'Suzuki',
            'tipe' => 'Ertiga',
            'stok' => '12',
            'harga' => '260000000',
            'gambar' => 'Ertiga.png'
        ]);
    }
}
