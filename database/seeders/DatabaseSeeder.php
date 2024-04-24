<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password'=> bcrypt('admin123'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password'=> bcrypt('kasir123'),
            'role' => 'Kasir',
        ]);
        User::create([
            'name' => 'mulki',
            'email' => 'kasir3@gmail.com',
            'password'=> bcrypt('kasir123'),
            'role' => 'Kasir',
        ]);
    }
}