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
                'deskripsi' => 'Juara pertama kompetisi Olimpiade Matematika tingkat nasional dengan menyelesaikan 30 soal dalam waktu 4 jam.',
                'tanggal_pencapaian' => '2024-06-15',
                'penyelenggara' => 'Kementerian Pendidikan dan Kebudayaan',
            ],
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Juara 2 Kompetisi Algoritma Programming',
                'tingkat' => 'nasional',
                'tahun' => 2024,
                'status' => 'valid',
                'deskripsi' => 'Tim terpilih untuk kompetisi nasional programming dengan menggunakan C++ sebagai bahasa pemrograman utama.',
                'tanggal_pencapaian' => '2024-05-20',
                'penyelenggara' => 'Asosiasi Programmer Indonesia',
            ],
            [
                'jenis' => 'non-akademik',
                'nama_prestasi' => 'Juara 1 Lomba Futsal Nasional',
                'tingkat' => 'nasional',
                'tahun' => 2023,
                'status' => 'valid',
                'deskripsi' => 'Menjadi juara pertama dalam kompetisi futsal nasional untuk kategori mahasiswa dengan tim yang solid dan disiplin tinggi.',
                'tanggal_pencapaian' => '2023-12-10',
                'penyelenggara' => 'Federasi Futsal Indonesia',
            ],
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Publikasi Jurnal Internasional Q1',
                'tingkat' => 'internasional',
                'tahun' => 2024,
                'status' => 'menunggu',
                'deskripsi' => 'Publikasi penelitian tentang Machine Learning dalam jurnal internasional bereputasi tinggi.',
                'tanggal_pencapaian' => '2024-07-01',
                'penyelenggara' => 'IEEE Transactions',
            ],
            [
                'jenis' => 'non-akademik',
                'nama_prestasi' => 'Anggota Delegasi Dialog Pemuda Nasional',
                'tingkat' => 'nasional',
                'tahun' => 2024,
                'status' => 'valid',
                'deskripsi' => 'Terpilih sebagai salah satu delegasi pemuda untuk mewakili universitas dalam dialog pemuda nasional di Jakarta.',
                'tanggal_pencapaian' => '2024-04-12',
                'penyelenggara' => 'Kementerian Pemuda dan Olahraga',
            ],
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Finalis Beasiswa Unggulan Calon Pemimpin',
                'tingkat' => 'nasional',
                'tahun' => 2024,
                'status' => 'menunggu',
                'deskripsi' => 'Lolos seleksi administratif dan wawancara tahap pertama untuk mendapatkan beasiswa kepemimpinan tingkat nasional.',
                'tanggal_pencapaian' => '2024-03-15',
                'penyelenggara' => 'LPDP (Lembaga Pengelola Dana Pendidikan)',
            ],
            [
                'jenis' => 'non-akademik',
                'nama_prestasi' => 'Juara 3 Lomba Debat Bahasa Inggris',
                'tingkat' => 'regional',
                'tahun' => 2023,
                'status' => 'valid',
                'deskripsi' => 'Menjadi juara ketiga dalam kompetisi debat bahasa inggris tingkat regional dengan menampilkan argumen yang kuat dan persuasif.',
                'tanggal_pencapaian' => '2023-11-05',
                'penyelenggara' => 'Universitas Regional',
            ],
            [
                'jenis' => 'akademik',
                'nama_prestasi' => 'Peserta Workshop Research Methodology',
                'tingkat' => 'internasional',
                'tahun' => 2024,
                'status' => 'valid',
                'deskripsi' => 'Peserta aktif dalam workshop internasional tentang metodologi penelitian yang diselenggarakan oleh universitas top dunia.',
                'tanggal_pencapaian' => '2024-02-20',
                'penyelenggara' => 'Cambridge University',
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
                    'deskripsi' => $prestasi['deskripsi'],
                    'tanggal_pencapaian' => $prestasi['tanggal_pencapaian'],
                    'penyelenggara' => $prestasi['penyelenggara'],
                ]);
            }
        }
    }
}
