<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {   
        $users = [
        ['name' => 'Alexandra Putri', 'email' => 'alex@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Michael Santoso', 'email' => 'michael@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Jessica Tan', 'email' => 'jessica@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Andi Wijaya', 'email' => 'andi@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Siti Aisyah', 'email' => 'siti@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Rudi Hartono', 'email' => 'rudi@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Lisa Manoban', 'email' => 'lisa@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Dewi Sartika', 'email' => 'dewi@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Kevin Pranata', 'email' => 'kevin@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Anita Sari', 'email' => 'anita@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Fajar Nugraha', 'email' => 'fajar@example.com', 'password' => Hash::make('password123')],
        ['name' => 'Rina Kusuma', 'email' => 'rina@example.com', 'password' => Hash::make('password123')],
    ];
    DB::table('users')->insert($users);
    }
}
