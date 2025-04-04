<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => 0343453543,
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'status' => 'active',
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'phone' => 0343453543,
            'password' => Hash::make('user'),
            'role' => 'client',
            'status' => 'active',
        ]);
    }
}
