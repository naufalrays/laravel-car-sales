<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
            'name' => 'Suzuki',
            'type' => 'S-Presso',
            'stock' => '8',
            'price' => '160000000',
            'image' => 'S-Presso.jpeg'
        ]);
        Car::create([
            'name' => 'Suzuki',
            'type' => 'Baleno',
            'stock' => '4',
            'price' => '230000000',
            'image' => 'Baleno.jpeg'
        ]);
        Car::create([
            'name' => 'Suzuki',
            'type' => 'Ignis',
            'stock' => '2',
            'price' => '209000000',
            'image' => 'Ignis.jpeg'
        ]);
        Car::create([
            'name' => 'Suzuki',
            'type' => 'XL7',
            'stock' => '2',
            'price' => '290000000',
            'image' => 'XL7.jpeg'
        ]);
        Car::create([
            'name' => 'Suzuki',
            'type' => 'Ertiga',
            'stock' => '12',
            'price' => '260000000',
            'image' => 'Ertiga.jpeg'
        ]);
    }
}
