<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Beasiswa;

class PendaftaranSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Pastikan ada user dan beasiswa agar relasi valid
        $user = User::first() ?? User::factory()->create([
            'name' => 'Mahasiswa Contoh',
            'email' => 'mahasiswa@example.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);

        $beasiswa = Beasiswa::first() ?? Beasiswa::factory()->create([
            'nama_beasiswa' => 'Beasiswa Prestasi Akademik',
            'deskripsi' => 'Beasiswa untuk mahasiswa berprestasi akademik tinggi',
        ]);

        // Tambahkan beberapa data dummy pendaftaran
        $pendaftarans = [
            [
                'user_id' => $user->id,
                'beasiswa_id' => $beasiswa->id,
                'ipk' => 3.85,
                'prestasi' => 'Juara 1 Lomba Karya Tulis Ilmiah Nasional',
                'organisasi' => 'Himpunan Mahasiswa Informatika',
                'keterampilan' => 'Python, Laravel, Public Speaking',
                'transkrip' => 'transkrip_mahasiswa1.pdf',
                'foto' => 'foto_mahasiswa1.jpg',
                'status' => 'menunggu',
                'catatan_admin' => 'Menunggu verifikasi dokumen',
            ],
            [
                'user_id' => $user->id,
                'beasiswa_id' => $beasiswa->id,
                'ipk' => 3.65,
                'prestasi' => 'Finalis Hackathon DIPA 2025',
                'organisasi' => 'BEM Fakultas Teknik',
                'keterampilan' => 'ReactJS, Leadership, UI/UX',
                'transkrip' => 'transkrip_mahasiswa2.pdf',
                'foto' => 'foto_mahasiswa2.jpg',
                'status' => 'diterima',
                'catatan_admin' => 'Lolos tahap seleksi awal',
            ],
            [
                'user_id' => $user->id,
                'beasiswa_id' => $beasiswa->id,
                'ipk' => 3.40,
                'prestasi' => 'Peserta Seminar Nasional AI',
                'organisasi' => 'Komunitas Data Science',
                'keterampilan' => 'Machine Learning, Data Visualization',
                'transkrip' => 'transkrip_mahasiswa3.pdf',
                'foto' => 'foto_mahasiswa3.jpg',
                'status' => 'ditolak',
                'catatan_admin' => 'IPK di bawah rata-rata penerima',
            ],
        ];

        foreach ($pendaftarans as $data) {
            Pendaftaran::create($data);
        }
    }
}
