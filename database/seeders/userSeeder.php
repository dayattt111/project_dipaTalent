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
        User::updateOrCreate(
            ['email' => 'admin@dipatalent.com'],
            [
                'name' => 'Admin DipaTalent',
                'password' => Hash::make('admin123'),
                'nim' => 'ADM001',
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Mahasiswa 1
        User::updateOrCreate(
            ['email' => 'budi@mail.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password123'),
                'nim' => '20230101',
                'role' => 'mahasiswa',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Mahasiswa 2
        User::updateOrCreate(
            ['email' => 'siti@mail.com'],
            [
                'name' => 'Siti Rahayu',
                'password' => Hash::make('password123'),
                'nim' => '20230102',
                'role' => 'mahasiswa',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Mahasiswa 3
        User::updateOrCreate(
            ['email' => 'ahmad@mail.com'],
            [
                'name' => 'Ahmad Fadil',
                'password' => Hash::make('password123'),
                'nim' => '20230103',
                'role' => 'mahasiswa',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Mahasiswa 4
        User::updateOrCreate(
            ['email' => 'dewi@mail.com'],
            [
                'name' => 'Dewi Lestari',
                'password' => Hash::make('password123'),
                'nim' => '20230104',
                'role' => 'mahasiswa',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Mahasiswa 5
        User::updateOrCreate(
            ['email' => 'rizki@mail.com'],
            [
                'name' => 'Rizki Pratama',
                'password' => Hash::make('password123'),
                'nim' => '20230105',
                'role' => 'mahasiswa',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // User Umum
        User::updateOrCreate(
            ['email' => 'pengunjung@mail.com'],
            [
                'name' => 'Pengunjung',
                'password' => Hash::make('password123'),
                'role' => 'umum',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );
    }
}
