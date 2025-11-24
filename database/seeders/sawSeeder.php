<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BobotKriteria;

class sawSeeder extends Seeder
{
    public function run(): void
    {
        $kriterias = [
            ['nama_kriteria' => 'Kriteria 1', 'bobot' => 0.20, 'tipe' => 'benefit'],
            ['nama_kriteria' => 'Kriteria 2', 'bobot' => 0.20, 'tipe' => 'benefit'],
            ['nama_kriteria' => 'Kriteria 3', 'bobot' => 0.20, 'tipe' => 'benefit'],
            ['nama_kriteria' => 'Kriteria 4', 'bobot' => 0.20, 'tipe' => 'benefit'],
            ['nama_kriteria' => 'Kriteria 5', 'bobot' => 0.20, 'tipe' => 'benefit'],
        ];

        foreach ($kriterias as $k) {
            BobotKriteria::create($k);
        }
    }
}
