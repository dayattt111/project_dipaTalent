<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;
use App\Models\User;

class PrestasiSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua user, atau bisa ambil beberapa
        $users = User::all();

        foreach ($users as $user) {
            // Tambah beberapa prestasi untuk setiap user
            Prestasi::create([
                'user_id' => $user->id,
                'jenis' => 'akademik',
                'nama_prestasi' => 'Juara 1 Olimpiade Matematika',
                'tingkat' => 'nasional',
                'tahun' => 2024,
                'file_sertifikat' => 'sertifikat/olimpiade1.pdf',
                'status' => 'menunggu',
            ]);

            Prestasi::create([
                'user_id' => $user->id,
                'jenis' => 'non-akademik',
                'nama_prestasi' => 'Juara 2 Lomba Futsal',
                'tingkat' => 'lokal',
                'tahun' => 2023,
                'file_sertifikat' => 'sertifikat/futsal2.pdf',
                'status' => 'menunggu',
            ]);
        }
    }
}
