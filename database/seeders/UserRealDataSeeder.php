<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sertifikasi;
use App\Models\Organisasi;
use App\Models\Prestasi;
use App\Models\Beasiswa;
use App\Models\Pendaftaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRealDataSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user dari UserRealSeeder (NIM 20240001 - 20240020)
        $users = User::whereBetween('nim', ['20240001', '20240020'])->get();

        if ($users->isEmpty()) {
            $this->command->error('❌ User dari UserRealSeeder tidak ditemukan. Jalankan UserRealSeeder terlebih dahulu!');
            return;
        }

        // Template data untuk sertifikasi
        $sertifikasiTemplates = [
            ['nama' => 'Certified Cloud Practitioner', 'penerbit' => 'AWS', 'jenis' => 'teknis', 'poin' => 3],
            ['nama' => 'Google Associate Cloud Engineer', 'penerbit' => 'Google Cloud', 'jenis' => 'teknis', 'poin' => 3],
            ['nama' => 'Microsoft Azure Fundamentals', 'penerbit' => 'Microsoft', 'jenis' => 'teknis', 'poin' => 2],
            ['nama' => 'Certified Kubernetes Administrator', 'penerbit' => 'CNCF', 'jenis' => 'teknis', 'poin' => 4],
            ['nama' => 'Oracle Database Administrator', 'penerbit' => 'Oracle', 'jenis' => 'teknis', 'poin' => 3],
            ['nama' => 'CompTIA Security+', 'penerbit' => 'CompTIA', 'jenis' => 'keamanan', 'poin' => 3],
            ['nama' => 'Certified Ethical Hacker', 'penerbit' => 'EC-Council', 'jenis' => 'keamanan', 'poin' => 4],
            ['nama' => 'Project Management Professional', 'penerbit' => 'PMI', 'jenis' => 'manajemen', 'poin' => 4],
            ['nama' => 'Scrum Master Certified', 'penerbit' => 'Scrum Alliance', 'jenis' => 'manajemen', 'poin' => 2],
            ['nama' => 'Python for Data Science', 'penerbit' => 'Coursera', 'jenis' => 'data', 'poin' => 2],
            ['nama' => 'Machine Learning Specialist', 'penerbit' => 'IBM', 'jenis' => 'data', 'poin' => 3],
            ['nama' => 'Data Analytics Professional', 'penerbit' => 'Google', 'jenis' => 'data', 'poin' => 3],
            ['nama' => 'Full Stack Web Developer', 'penerbit' => 'FreeCodeCamp', 'jenis' => 'teknis', 'poin' => 2],
            ['nama' => 'Mobile App Development', 'penerbit' => 'Udacity', 'jenis' => 'teknis', 'poin' => 2],
            ['nama' => 'Digital Marketing Fundamentals', 'penerbit' => 'Google Digital Garage', 'jenis' => 'marketing', 'poin' => 1],
        ];

        // Template data untuk organisasi
        $organisasiTemplates = [
            ['nama' => 'Himpunan Mahasiswa Informatika', 'jabatan' => 'Ketua', 'periode' => '2023-2024', 'poin' => 3],
            ['nama' => 'BEM Fakultas Teknik', 'jabatan' => 'Wakil Ketua', 'periode' => '2023-2024', 'poin' => 2.5],
            ['nama' => 'Himpunan Mahasiswa Sistem Informasi', 'jabatan' => 'Sekretaris', 'periode' => '2024-2025', 'poin' => 2],
            ['nama' => 'UKM Robotika', 'jabatan' => 'Kepala Divisi Riset', 'periode' => '2023-2024', 'poin' => 2],
            ['nama' => 'Komunitas Programming', 'jabatan' => 'Koordinator Acara', 'periode' => '2024-2025', 'poin' => 1.5],
            ['nama' => 'Kelompok Studi AI & ML', 'jabatan' => 'Anggota Aktif', 'periode' => '2023-2025', 'poin' => 1],
            ['nama' => 'Organisasi Mahasiswa Daerah', 'jabatan' => 'Bendahara', 'periode' => '2024-2025', 'poin' => 2],
            ['nama' => 'Tim Olimpiade Sains', 'jabatan' => 'Pelatih', 'periode' => '2023-2024', 'poin' => 2.5],
            ['nama' => 'Ikatan Mahasiswa Pecinta Alam', 'jabatan' => 'Anggota', 'periode' => '2023-2024', 'poin' => 1],
            ['nama' => 'Paduan Suara Mahasiswa', 'jabatan' => 'Ketua Seksi', 'periode' => '2024-2025', 'poin' => 1.5],
        ];

        // Template data untuk prestasi
        $prestasiTemplates = [
            [
                'jenis' => 'akademik',
                'nama' => 'Juara 1 Kompetisi Pemrograman',
                'tingkat' => 'nasional',
                'penyelenggara' => 'Kementerian Pendidikan',
            ],
            [
                'jenis' => 'akademik',
                'nama' => 'Juara 2 Lomba Karya Tulis Ilmiah',
                'tingkat' => 'nasional',
                'penyelenggara' => 'Dikti',
            ],
            [
                'jenis' => 'akademik',
                'nama' => 'Juara 3 Hackathon Teknologi',
                'tingkat' => 'provinsi',
                'penyelenggara' => 'Dinas Kominfo Provinsi',
            ],
            [
                'jenis' => 'akademik',
                'nama' => 'Best Paper International Conference',
                'tingkat' => 'internasional',
                'penyelenggara' => 'IEEE',
            ],
            [
                'jenis' => 'non-akademik',
                'nama' => 'Juara 1 Futsal Tournament',
                'tingkat' => 'nasional',
                'penyelenggara' => 'KEMENPORA',
            ],
            [
                'jenis' => 'non-akademik',
                'nama' => 'Juara 2 Lomba Debat',
                'tingkat' => 'nasional',
                'penyelenggara' => 'Kemendikbud',
            ],
            [
                'jenis' => 'akademik',
                'nama' => 'Finalis Inovasi Teknologi',
                'tingkat' => 'nasional',
                'penyelenggara' => 'Kemristekdikti',
            ],
            [
                'jenis' => 'non-akademik',
                'nama' => 'Juara 3 Badminton Championship',
                'tingkat' => 'provinsi',
                'penyelenggara' => 'PBSI Provinsi',
            ],
            [
                'jenis' => 'akademik',
                'nama' => 'Peserta Olimpiade Sains',
                'tingkat' => 'nasional',
                'penyelenggara' => 'DIKTI',
            ],
            [
                'jenis' => 'non-akademik',
                'nama' => 'Juara 1 Lomba Fotografi',
                'tingkat' => 'kampus',
                'penyelenggara' => 'BEM Universitas',
            ],
        ];

        DB::beginTransaction();
        try {
            foreach ($users as $user) {
                // 1. SERTIFIKASI - minimal 2 per user
                $numSertifikasi = rand(2, 4);
                $selectedSertifikasi = collect($sertifikasiTemplates)->random($numSertifikasi);
                
                foreach ($selectedSertifikasi as $sert) {
                    Sertifikasi::create([
                        'user_id' => $user->id,
                        'nama_sertifikat' => $sert['nama'],
                        'penerbit' => $sert['penerbit'],
                        'jenis' => $sert['jenis'],
                        'nomor_sertifikat' => 'CERT-' . strtoupper(substr(md5($user->nim . $sert['nama']), 0, 8)),
                        'tanggal_terbit' => now()->subMonths(rand(1, 24)),
                        'tanggal_expired' => now()->addYears(rand(1, 3)),
                        'bukti_file' => 'sertifikat/' . strtolower(str_replace(' ', '_', $sert['nama'])) . '.pdf',
                        'deskripsi' => 'Sertifikat ' . $sert['nama'] . ' yang diterbitkan oleh ' . $sert['penerbit'],
                        'status' => collect(['valid', 'valid', 'valid', 'pending'])->random(),
                        'poin' => $sert['poin'],
                    ]);
                }

                // 2. ORGANISASI - minimal 2 per user
                $numOrganisasi = rand(2, 3);
                $selectedOrganisasi = collect($organisasiTemplates)->random($numOrganisasi);
                
                foreach ($selectedOrganisasi as $org) {
                    Organisasi::create([
                        'user_id' => $user->id,
                        'nama_organisasi' => $org['nama'],
                        'jabatan' => $org['jabatan'],
                        'periode' => $org['periode'],
                        'deskripsi' => 'Aktif sebagai ' . $org['jabatan'] . ' di ' . $org['nama'] . ' periode ' . $org['periode'],
                        'bukti_file' => 'organisasi/' . strtolower(str_replace(' ', '_', $org['nama'])) . '.pdf',
                        'status' => collect(['valid', 'valid', 'valid', 'pending'])->random(),
                        'poin' => $org['poin'],
                    ]);
                }

                // 3. PRESTASI - minimal 2 per user
                $numPrestasi = rand(2, 4);
                $selectedPrestasi = collect($prestasiTemplates)->random($numPrestasi);
                
                foreach ($selectedPrestasi as $prestasi) {
                    Prestasi::create([
                        'user_id' => $user->id,
                        'jenis' => $prestasi['jenis'],
                        'nama_prestasi' => $prestasi['nama'],
                        'tingkat' => $prestasi['tingkat'],
                        'tahun' => rand(2023, 2025),
                        'sertifikat' => 'prestasi/' . strtolower(str_replace(' ', '_', $prestasi['nama'])) . '.pdf',
                        'status' => collect(['valid', 'valid', 'valid', 'menunggu'])->random(),
                        'deskripsi' => 'Prestasi ' . $prestasi['nama'] . ' tingkat ' . $prestasi['tingkat'],
                        'tanggal_pencapaian' => now()->subMonths(rand(1, 18))->format('Y-m-d'),
                        'penyelenggara' => $prestasi['penyelenggara'],
                    ]);
                }
            }

            // 4. BEASISWA - buat beberapa beasiswa dulu jika belum ada
            $beasiswaList = Beasiswa::all();
            if ($beasiswaList->isEmpty()) {
                $beasiswaList = collect([
                    Beasiswa::create([
                        'nama_beasiswa' => 'Beasiswa Prestasi Akademik 2024',
                        'deskripsi' => 'Beasiswa untuk mahasiswa berprestasi dengan IPK minimal 3.50',
                        'tanggal_mulai' => '2024-01-01',
                        'tanggal_selesai' => '2024-12-31',
                        'kuota' => 50,
                        'status' => 'aktif',
                    ]),
                    Beasiswa::create([
                        'nama_beasiswa' => 'Beasiswa Bantuan Pendidikan 2024',
                        'deskripsi' => 'Beasiswa untuk mahasiswa kurang mampu dengan prestasi baik',
                        'tanggal_mulai' => '2024-02-01',
                        'tanggal_selesai' => '2024-11-30',
                        'kuota' => 30,
                        'status' => 'aktif',
                    ]),
                    Beasiswa::create([
                        'nama_beasiswa' => 'Beasiswa Riset dan Inovasi 2024',
                        'deskripsi' => 'Beasiswa untuk mahasiswa yang aktif melakukan riset dan inovasi',
                        'tanggal_mulai' => '2024-03-01',
                        'tanggal_selesai' => '2024-12-31',
                        'kuota' => 20,
                        'status' => 'aktif',
                    ]),
                ]);
            }

            // 5. PENDAFTARAN BEASISWA - minimal 2 per user
            foreach ($users as $user) {
                $numPendaftaran = rand(2, 3);
                $selectedBeasiswa = $beasiswaList->random($numPendaftaran);
                
                foreach ($selectedBeasiswa as $beasiswa) {
                    Pendaftaran::create([
                        'user_id' => $user->id,
                        'beasiswa_id' => $beasiswa->id,
                        'ipk' => $user->ipk,
                        'prestasi' => 'Prestasi akademik dan non-akademik',
                        'organisasi' => 'Aktif di berbagai organisasi',
                        'keterampilan' => 'Programming, Leadership, Communication',
                        'status' => collect(['menunggu', 'menunggu', 'diterima', 'ditolak'])->random(),
                        'catatan_admin' => collect([
                            'Berkas lengkap, menunggu verifikasi',
                            'Prestasi sangat baik',
                            'IPK memenuhi syarat',
                            null,
                        ])->random(),
                    ]);
                }
            }

            DB::commit();
            
            $this->command->info('✓ Data berhasil di-seed untuk ' . $users->count() . ' user!');
            $this->command->info('  - Sertifikasi: ' . Sertifikasi::whereIn('user_id', $users->pluck('id'))->count() . ' records');
            $this->command->info('  - Organisasi: ' . Organisasi::whereIn('user_id', $users->pluck('id'))->count() . ' records');
            $this->command->info('  - Prestasi: ' . Prestasi::whereIn('user_id', $users->pluck('id'))->count() . ' records');
            $this->command->info('  - Pendaftaran Beasiswa: ' . Pendaftaran::whereIn('user_id', $users->pluck('id'))->count() . ' records');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('❌ Error: ' . $e->getMessage());
        }
    }
}
