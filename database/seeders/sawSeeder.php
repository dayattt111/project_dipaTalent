<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BobotKriteria;
use App\Models\SkorSaw;
use App\Models\Leaderboard;
use App\Models\User;

class sawSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua data lama
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        BobotKriteria::truncate();
        SkorSaw::truncate();
        Leaderboard::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Buat Bobot Kriteria dengan nama yang lebih deskriptif
        $kriterias = [
            [
                'nama_kriteria' => 'IPK (Indeks Prestasi Kumulatif)',
                'bobot' => 0.25,
                'tipe' => 'benefit',
            ],
            [
                'nama_kriteria' => 'Prestasi Akademik',
                'bobot' => 0.20,
                'tipe' => 'benefit',
            ],
            [
                'nama_kriteria' => 'Keaktifan Organisasi',
                'bobot' => 0.20,
                'tipe' => 'benefit',
            ],
            [
                'nama_kriteria' => 'Keterampilan & Sertifikasi',
                'bobot' => 0.15,
                'tipe' => 'benefit',
            ],
            [
                'nama_kriteria' => 'Prestasi Non-Akademik',
                'bobot' => 0.20,
                'tipe' => 'benefit',
            ],
        ];

        foreach ($kriterias as $k) {
            BobotKriteria::create($k);
        }

        // 2. Isi data mahasiswa dengan IPK, Organisasi, Sertifikasi
        $mahasiswa = User::where('role', 'mahasiswa')->get();

        foreach ($mahasiswa as $user) {
            // Update IPK random 2.50 - 4.00
            $user->update(['ipk' => rand(250, 400) / 100]);

            // Buat 1-3 organisasi
            for ($i = 0; $i < rand(1, 3); $i++) {
                \App\Models\Organisasi::create([
                    'user_id' => $user->id,
                    'nama_organisasi' => ['HMTI', 'BEM', 'Himpunan Mahasiswa', 'UKM Olahraga', 'Pecinta Alam'][array_rand(['HMTI', 'BEM', 'Himpunan Mahasiswa', 'UKM Olahraga', 'Pecinta Alam'])],
                    'jabatan' => ['Anggota', 'Sekretaris', 'Bendahara', 'Ketua'][array_rand(['Anggota', 'Sekretaris', 'Bendahara', 'Ketua'])],
                    'periode' => '2023-2024',
                    'status' => 'valid',
                    'poin' => 1,
                ]);
            }

            // Buat 0-2 sertifikasi
            for ($i = 0; $i < rand(0, 2); $i++) {
                \App\Models\Sertifikasi::create([
                    'user_id' => $user->id,
                    'nama_sertifikat' => ['AWS Certified', 'BNSP Junior Web Developer', 'Google Data Analytics', 'Microsoft Azure'][array_rand(['AWS Certified', 'BNSP Junior Web Developer', 'Google Data Analytics', 'Microsoft Azure'])],
                    'penerbit' => ['BNSP', 'Google', 'Microsoft', 'AWS'][array_rand(['BNSP', 'Google', 'Microsoft', 'AWS'])],
                    'jenis' => ['BNSP', 'Bootcamp', 'Online Course'][array_rand(['BNSP', 'Bootcamp', 'Online Course'])],
                    'tanggal_terbit' => now()->subMonths(rand(1, 12)),
                    'status' => 'valid',
                    'poin' => rand(1, 3),
                ]);
            }
        }

        // 3. Trigger perhitungan SAW
        app(\App\Http\Controllers\Admin\SawController::class)->hitungSaw();
    }
}
