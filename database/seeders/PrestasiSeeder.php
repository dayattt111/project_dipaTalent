<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;
use App\Models\User;

class PrestasiSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'mahasiswa')->get();

        $prestasiBatch = [
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Juara 1 Olimpiade Matematika Nasional',
                'tingkat' => 'nasional',
                'tahun' => 2024,
                'status' => 'valid',
            ],
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Juara 2 Kompetisi Algoritma Programming',
                'tingkat' => 'nasional',
                'tahun' => 2024,
                'status' => 'valid',
            ],
            [
                'jenis' => 'non-akademik',
                'nama_prestasi' => 'Juara 1 Lomba Futsal Nasional',
                'tingkat' => 'nasional',
                'tahun' => 2023,
                'status' => 'valid',
            ],
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Publikasi Jurnal Internasional Q1',
                'tingkat' => 'internasional',
                'tahun' => 2024,
                'status' => 'menunggu',
            ],
            [
                'jenis' => 'non-akademik',
                'nama_prestasi' => 'Anggota Delegasi Dialog Pemuda Nasional',
                'tingkat' => 'nasional',
                'tahun' => 2024,
                'status' => 'valid',
            ],
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Finalis Beasiswa Unggulan Calon Pemimpin',
                'tingkat' => 'nasional',
                'tahun' => 2024,
                'status' => 'menunggu',
            ],
            [
                'jenis' => 'non-akademik',
                'nama_prestasi' => 'Juara 3 Lomba Debat Bahasa Inggris',
                'tingkat' => 'regional',
                'tahun' => 2023,
                'status' => 'valid',
            ],
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Peserta Workshop Research Methodology',
                'tingkat' => 'internasional',
                'tahun' => 2024,
                'status' => 'valid',
            ],
        ];

        foreach ($users as $index => $user) {
            // Setiap user mendapat 2-3 prestasi
            for ($i = 0; $i < rand(2, 3); $i++) {
                $prestasi = $prestasiBatch[($index * 3 + $i) % count($prestasiBatch)];

                Prestasi::create([
                    'user_id' => $user->id,
                    'jenis' => $prestasi['jenis'],
                    'nama_prestasi' => $prestasi['nama_prestasi'],
                    'tingkat' => $prestasi['tingkat'],
                    'tahun' => $prestasi['tahun'],
                    'file_sertifikat' => 'sertifikat/' . strtolower(str_replace(' ', '_', $prestasi['nama_prestasi'])) . '.pdf',
                    'status' => $prestasi['status'],
                ]);
            }
        }
    }
}
