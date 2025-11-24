<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Prestasi;
use App\Models\BobotKriteria;
use App\Models\NormalisasiSaw;
use App\Models\SkorSaw;

class SawSeeder extends Seeder
{
    public function run()
    {
        // ====== USERS ======
        $u1 = User::create([
            'name' => 'Ali',
            'email' => 'ali@example.com',
            'nim' => '23222',
            'password' => bcrypt('123')
        ]);

        $u2 = User::create([
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'nim' => '23111',
            'password' => bcrypt('123')
        ]);

        $u3 = User::create([
            'name' => 'Cici',
            'email' => 'cici@example.com',
            'nim' => '44231',
            'password' => bcrypt('123')
        ]);

        // ====== PRESTASI ======
        $p1 = Prestasi::create(['user_id' => $u1->id, 'nama_prestasi' => 'Prestasi A']);
        $p2 = Prestasi::create(['user_id' => $u2->id, 'nama_prestasi' => 'Prestasi B']);
        $p3 = Prestasi::create(['user_id' => $u3->id, 'nama_prestasi' => 'Prestasi C']);

        // ====== BOBOT KRITERIA ======
        $k1 = BobotKriteria::create(['nama_kriteria' => 'Nilai Sertifikat', 'bobot' => 0.4, 'tipe' => 'benefit']);
        $k2 = BobotKriteria::create(['nama_kriteria' => 'Lama Organisasi', 'bobot' => 0.3, 'tipe' => 'benefit']);
        $k3 = BobotKriteria::create(['nama_kriteria' => 'Jumlah Kompetisi', 'bobot' => 0.3, 'tipe' => 'benefit']);

        // ====== NILAI ASLI (normalisasi_saw) ======
        // Format: prestasi, kriteria, nilai_asli

        $nilai = [
            [$p1->id, $k1->id, 70],
            [$p1->id, $k2->id, 3],
            [$p1->id, $k3->id, 5],

            [$p2->id, $k1->id, 85],
            [$p2->id, $k2->id, 2],
            [$p2->id, $k3->id, 7],

            [$p3->id, $k1->id, 90],
            [$p3->id, $k2->id, 4],
            [$p3->id, $k3->id, 6],
        ];

        foreach ($nilai as $n) {
            NormalisasiSaw::create([
                'prestasi_id' => $n[0],
                'kriteria_id' => $n[1],
                'nilai_normalisasi' => $n[2] // masih nilai mentah, nanti dihitung ulang
            ]);
        }

        // ====== SKOR AWAL ======
        SkorSaw::create(['user_id' => $u1->id, 'total_skor' => 0]);
        SkorSaw::create(['user_id' => $u2->id, 'total_skor' => 0]);
        SkorSaw::create(['user_id' => $u3->id, 'total_skor' => 0]);
    }
}
