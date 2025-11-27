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
            'nim' => 'ADM001',
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Mahasiswa 1
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@mail.com',
            'password' => Hash::make('password123'),
            'nim' => '20230101',
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Mahasiswa 2
        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@mail.com',
            'password' => Hash::make('password123'),
            'nim' => '20230102',
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Mahasiswa 3
        User::create([
            'name' => 'Ahmad Fadil',
            'email' => 'ahmad@mail.com',
            'password' => Hash::make('password123'),
            'nim' => '20230103',
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Mahasiswa 4
        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@mail.com',
            'password' => Hash::make('password123'),
            'nim' => '20230104',
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Mahasiswa 5
        User::create([
            'name' => 'Rizki Pratama',
            'email' => 'rizki@mail.com',
            'password' => Hash::make('password123'),
            'nim' => '20230105',
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // User Umum
        User::create([
            'name' => 'Pengunjung',
            'email' => 'pengunjung@mail.com',
            'password' => Hash::make('password123'),
            'role' => 'umum',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
