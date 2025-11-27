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
                'nama_kriteria' => 'Pengalaman Profesional',
                'bobot' => 0.20,
                'tipe' => 'benefit',
            ],
        ];

        $bobot_kriterias = [];
        foreach ($kriterias as $k) {
            $bobot_kriterias[] = BobotKriteria::create($k);
        }

        // 2. Buat data Skor SAW untuk setiap mahasiswa
        $mahasiswa = User::where('role', 'mahasiswa')->get();

        $skors = [];
        foreach ($mahasiswa as $index => $user) {
            // Generate skor random antara 60-100
            $total_skor = rand(60, 100) + rand(0, 40) / 10;

            $skor = SkorSaw::create([
                'user_id' => $user->id,
                'total_skor' => $total_skor,
            ]);
            
            $skors[] = $skor;

            // 3. Buat Leaderboard berdasarkan skor
            Leaderboard::create([
                'user_id' => $user->id,
                'skor_id' => $skor->id,
                'peringkat' => $index + 1,
            ]);
        }

        // Urutkan ulang ranking berdasarkan total_skor
        $leaderboards = Leaderboard::join('skor_saw', 'leaderboards.skor_id', '=', 'skor_saw.id')
            ->orderBy('skor_saw.total_skor', 'desc')
            ->select('leaderboards.*')
            ->get();

        foreach ($leaderboards as $index => $lb) {
            $lb->update(['peringkat' => $index + 1]);
        }
    }
}
