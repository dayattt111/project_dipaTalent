<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beasiswa;

class BeasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Beasiswa 1 - Prestasi Akademik
        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Prestasi Akademik',
            'deskripsi' => 'Untuk mahasiswa dengan IPK minimal 3.5 dan prestasi akademik terbaik',
            'kuota' => 10,
            'tanggal_mulai' => now()->subMonth(),
            'tanggal_selesai' => now()->addMonth(),
            'status' => 'aktif',
        ]);

        // Beasiswa 2 - Kurang Mampu
        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Kurang Mampu',
            'deskripsi' => 'Untuk mahasiswa dengan kondisi ekonomi kurang mampu dan IPK minimal 2.5',
            'kuota' => 15,
            'tanggal_mulai' => now()->subMonth(),
            'tanggal_selesai' => now()->addMonth(2),
            'status' => 'aktif',
        ]);

        // Beasiswa 3 - Bidikmisi
        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Bidikmisi',
            'deskripsi' => 'Program bantuan pendidikan bagi siswa berprestasi dari keluarga kurang mampu',
            'kuota' => 20,
            'tanggal_mulai' => now()->subMonth(2),
            'tanggal_selesai' => now()->subMonth(),
            'status' => 'ditutup',
        ]);

        // Beasiswa 4 - Afirmasi
        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Afirmasi',
            'deskripsi' => 'Beasiswa untuk mahasiswa dari daerah terdepan, terpencil, dan tertinggal',
            'kuota' => 12,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(3),
            'status' => 'aktif',
        ]);

        // Beasiswa 5 - Kemitraan Industri
        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Kemitraan Industri',
            'deskripsi' => 'Beasiswa dari kerjasama dengan industri dan perusahaan swasta',
            'kuota' => 8,
            'tanggal_mulai' => now()->addDays(7),
            'tanggal_selesai' => now()->addMonths(4),
            'status' => 'aktif',
        ]);

        // Beasiswa 6 - Disabilitas
        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Disabilitas',
            'deskripsi' => 'Beasiswa khusus untuk mahasiswa dengan penyandang disabilitas',
            'kuota' => 5,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(6),
            'status' => 'aktif',
        ]);
    }
}
