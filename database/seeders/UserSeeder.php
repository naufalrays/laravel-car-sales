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
        $admin = User::create([
            'name' => 'admin',
            'username' => 'adminRay',
            // 'phone_number' => '',
            'email' => 'admin@test.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'username' => 'userRay',
            // 'phone_number' => 'user@test.com',
            'email' => 'user@test.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('user');
    }
}
