<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = User::create([
            'name' => 'sales',
            'email' => 'sales@test.com',
            'password' => bcrypt('password')
        ]);
        $sales->assignRole('sales');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@test.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('user');
    }
}
