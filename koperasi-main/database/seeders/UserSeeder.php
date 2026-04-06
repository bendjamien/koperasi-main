<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user 'Owner'
        User::create([
            'name' => 'Owner',
            'email' => 'owner@menukhas.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
        ]);

        // Anda bisa menambahkan user lain jika perlu
        // User::create([
        //     'name' => 'Staff',
        //     'email' => 'staff@menukhas.com',
        //     'password' => Hash::make('password123'),
        // ]);
    }
}