<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Beasiswa;
use App\Models\PendaftaranBeasiswa;

class beasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user dummy
        $users = [
            ['name' => 'Budi Santoso', 'email' => 'budi@mail.com'],
            ['name' => 'Siti Rahayu', 'email' => 'siti@mail.com'],
            ['name' => 'Ahmad Fadil', 'email' => 'ahmad@mail.com'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@mail.com'],
            ['name' => 'Rizki Pratama', 'email' => 'rizki@mail.com'],
        ];

        foreach ($users as $u) {
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'password' => bcrypt('password')]
            );
        }

        // Buat beasiswa dummy
        $beasiswa = Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Prestasi Akademik',
            'deskripsi' => 'Untuk mahasiswa berprestasi',
            'kuota' => 10,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonth(),
            'status' => 'aktif',
        ]);

        // Buat pendaftaran dummy
        foreach (User::all() as $index => $user) {
            PendaftaranBeasiswa::create([
                'user_id' => $user->id,
                'beasiswa_id' => $beasiswa->id,
                'status' => $index % 2 == 0 ? 'diterima' : 'menunggu',
            ]);
        }
    }
}
