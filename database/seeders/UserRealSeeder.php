<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRealSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = [
            ['name' => 'Andi Prawira', 'nim' => '20240001'],
            ['name' => 'Bagus Makkasau', 'nim' => '20240002'],
            ['name' => 'Tenri Ningrum', 'nim' => '20240003'],
            ['name' => 'Putu Hasanuddin', 'nim' => '20240004'],
            ['name' => 'Besse Sekar', 'nim' => '20240005'],
            ['name' => 'Made Tata', 'nim' => '20240006'],
            ['name' => 'Sitti Lestari', 'nim' => '20240007'],
            ['name' => 'Agung Pasamangi', 'nim' => '20240008'],
            ['name' => 'Bambang Palakka', 'nim' => '20240009'],
            ['name' => 'Joko Sangkala', 'nim' => '20240010'],
            ['name' => 'Luh Karaeng', 'nim' => '20240011'],
            ['name' => 'Raden Mahendra', 'nim' => '20240012'],
            ['name' => 'Gusti Romo', 'nim' => '20240013'],
            ['name' => 'Kadek Permadi', 'nim' => '20240014'],
            ['name' => 'Lagaligo Santoso', 'nim' => '20240015'],
            ['name' => 'Slamet Ngalle', 'nim' => '20240016'],
            ['name' => 'Bagus Tenrisau', 'nim' => '20240017'],
            ['name' => 'Tirta Wijaya', 'nim' => '20240018'],
            ['name' => 'Dewa Mattalatta', 'nim' => '20240019'],
            ['name' => 'Wayan Mappanyukki', 'nim' => '20240020'],
        ];

        $loginInfo = [];
        
        foreach ($mahasiswa as $mhs) {
            // Generate email dari nama (lowercase, replace space dengan dot)
            $email = strtolower(str_replace(' ', '.', $mhs['name'])) . '@mail.com';
            
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $mhs['name'],
                    'password' => Hash::make('password123'),
                    'nim' => $mhs['nim'],
                    'role' => 'mahasiswa',
                    'ipk' => rand(280, 400) / 100, // IPK random 2.80 - 4.00
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]
            );
            
            $loginInfo[] = [
                'name' => $mhs['name'],
                'email' => $email,
                'nim' => $mhs['nim'],
            ];
        }

        $this->command->info('✓ 20 mahasiswa berhasil di-seed!');
        $this->command->newLine();
        $this->command->info('📧 Info Login (Password semua: password123):');
        $this->command->table(
            ['Nama', 'Email', 'NIM'],
            array_map(fn($info) => [$info['name'], $info['email'], $info['nim']], $loginInfo)
        );
    }
}
