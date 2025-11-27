<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Beasiswa;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'mahasiswa')->get();
        $beasiswas = Beasiswa::all();

        if ($users->isEmpty() || $beasiswas->isEmpty()) {
            return;
        }

        $statuses = ['menunggu', 'diterima', 'ditolak'];
        $data = [
            [
                'ipk' => 3.85,
                'prestasi' => 'Juara 1 Lomba Karya Tulis Ilmiah Nasional',
                'organisasi' => 'Himpunan Mahasiswa Informatika',
                'keterampilan' => 'Python, Laravel, Public Speaking',
                'catatan' => 'Lolos verifikasi dengan nilai excellent',
            ],
            [
                'ipk' => 3.65,
                'prestasi' => 'Finalis Hackathon DIPA 2025',
                'organisasi' => 'BEM Fakultas Teknik',
                'keterampilan' => 'ReactJS, Leadership, UI/UX',
                'catatan' => 'Menunggu verifikasi dokumen',
            ],
            [
                'ipk' => 3.45,
                'prestasi' => 'Peserta Kompetisi Programmer Se-Indonesia',
                'organisasi' => 'IKADA',
                'keterampilan' => 'C++, Java, Problem Solving',
                'catatan' => 'Memenuhi semua kriteria',
            ],
            [
                'ipk' => 3.25,
                'prestasi' => 'Anggota Aktif Organisasi Mahasiswa',
                'organisasi' => 'HIMA-IMADA',
                'keterampilan' => 'Manajemen, Komunikasi, Teamwork',
                'catatan' => 'IPK kurang dari batas minimum 3.5',
            ],
            [
                'ipk' => 3.75,
                'prestasi' => 'Pemenang Beasiswa Penelitian Muda',
                'organisasi' => 'Kemristek',
                'keterampilan' => 'Research, Writing, Data Analysis',
                'catatan' => 'Sedang dalam proses review',
            ],
        ];

        foreach ($users as $index => $user) {
            $beasiswa = $beasiswas->random();
            $datum = $data[$index % count($data)];

            Pendaftaran::create([
                'user_id' => $user->id,
                'beasiswa_id' => $beasiswa->id,
                'ipk' => $datum['ipk'],
                'prestasi' => $datum['prestasi'],
                'organisasi' => $datum['organisasi'],
                'keterampilan' => $datum['keterampilan'],
                'transkrip' => 'transkrip_' . $user->nim . '.pdf',
                'foto' => 'foto_' . $user->nim . '.jpg',
                'status' => $statuses[$index % 3],
                'catatan_admin' => $datum['catatan'],
            ]);
        }
    }
}
