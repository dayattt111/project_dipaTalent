<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin DipaTalent',
            'email' => 'admin@dipatalent.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Mahasiswa Informatika',
            'email' => 'mahasiswa@dipatalent.com',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
