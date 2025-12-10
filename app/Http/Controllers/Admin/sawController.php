<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BobotKriteria;
use App\Models\Leaderboard;
use App\Models\NormalisasiSaw;
use App\Models\Prestasi;
use App\Models\SkorSaw;
use Illuminate\Http\Request;

class SawController extends Controller
{
    private $rawData = [];

    public function index()
    {
        $kriterias = BobotKriteria::all();
        return view('admin.metode.index', compact('kriterias'));
    }

    /**
     * Public method untuk trigger perhitungan SAW dari controller lain
     */
    public function hitungSaw()
    {
        $this->hitungNormalisasiSaw();
        $this->hitungSkorSaw();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string',
            'bobot' => 'required|numeric|min:0|max:1',
            'tipe' => 'required|in:benefit,cost',
        ]);

        BobotKriteria::create([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'tipe' => $request->tipe,
        ]);

        // Recalculate if needed
        $this->hitungNormalisasiSaw();
        $this->hitungSkorSaw();

        return redirect()->route('metode.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kriteria = BobotKriteria::findOrFail($id);
        return view('admin.metode.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required|string',
            'bobot_decimal' => 'required|numeric|min:0|max:1',
            'tipe'          => 'required|in:benefit,cost',
        ]);

        // Get bobot dalam format decimal (0-1)
        $newBobot = round(floatval($request->bobot_decimal), 4);

        // Update kriteria yang diedit dulu
        $kriteria = BobotKriteria::findOrFail($id);
        $oldBobot = $kriteria->bobot;
        
        $kriteria->update([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot'         => $newBobot,
            'tipe'          => $request->tipe,
        ]);

        // Ambil semua kriteria lain
        $otherKriterias = BobotKriteria::where('id', '!=', $id)->get();
        $countOthers = $otherKriterias->count();

        if ($countOthers > 0) {
            // Hitung total bobot kriteria lain saat ini
            $totalOtherBobot = $otherKriterias->sum('bobot');
            
            // Sisa bobot yang harus dibagi ke kriteria lain
            $remaining = round(1 - $newBobot, 4);
            
            if ($totalOtherBobot > 0) {
                // Sesuaikan setiap kriteria lain secara proporsional
                $updated = 0;
                $totalAdjusted = 0;
                
                foreach ($otherKriterias as $k) {
                    // Hitung proporsi kriteria ini terhadap total kriteria lain
                    $proportion = $k->bobot / $totalOtherBobot;
                    
                    // Hitung bobot baru berdasarkan proporsi
                    if ($updated === $countOthers - 1) {
                        // Kriteria terakhir: berikan sisa agar total tepat 100%
                        $bobotBaru = round($remaining - $totalAdjusted, 4);
                    } else {
                        $bobotBaru = round($remaining * $proportion, 4);
                        $totalAdjusted += $bobotBaru;
                    }
                    
                    // Pastikan tidak negatif
                    $bobotBaru = max(0, $bobotBaru);
                    
                    $k->update(['bobot' => $bobotBaru]);
                    $updated++;
                }
            } else {
                // Jika total kriteria lain = 0, bagikan merata
                $share = round($remaining / $countOthers, 4);
                $totalDistributed = 0;
                $updated = 0;
                
                foreach ($otherKriterias as $k) {
                    if ($updated === $countOthers - 1) {
                        // Kriteria terakhir: berikan sisa
                        $bobotBaru = round($remaining - $totalDistributed, 4);
                    } else {
                        $bobotBaru = $share;
                        $totalDistributed += $bobotBaru;
                    }
                    
                    $k->update(['bobot' => max(0, $bobotBaru)]);
                    $updated++;
                }
            }
        }

        // Recalculate SAW
        $this->hitungNormalisasiSaw();
        $this->hitungSkorSaw();

        return redirect()->route('admin.metode.index')
                        ->with('success', 'Bobot berhasil diperbarui! Kriteria lain telah disesuaikan otomatis. Total bobot: 100%');
    }


    // ======================================
    // ==========  NORMALISASI SAW ==========
    // ======================================
    // Kriteria Baru:
    // 1. IPK (benefit)
    // 2. Prestasi Akademik (benefit) - total poin
    // 3. Organisasi (benefit) - jumlah valid
    // 4. Sertifikasi (benefit) - total poin
    // 5. Prestasi Non-Akademik (benefit) - total poin

    private function hitungNormalisasiSaw()
    {
        $users = \App\Models\User::where('role', 'mahasiswa')->get();
        $kriterias = BobotKriteria::all();

        if ($kriterias->count() != 5) {
            return; // Harus ada 5 kriteria
        }

        $dataMahasiswa = [];

        // Kumpulkan data mentah setiap mahasiswa
        foreach ($users as $user) {
            // Hitung poin prestasi akademik
            $prestasiAkademik = $user->prestasi()->valid()->akademik()->get();
            $poinPrestasiAkademik = $prestasiAkademik->sum(function($prestasi) {
                return $prestasi->poin; // Gunakan accessor
            });

            // Hitung jumlah organisasi valid
            $jumlahOrganisasi = $user->organisasi()->valid()->count();

            // Hitung poin sertifikasi
            $sertifikasi = $user->sertifikasi()->valid()->get();
            $poinSertifikasi = $sertifikasi->sum('poin'); // Kolom poin ada di tabel

            // Hitung poin prestasi non-akademik
            $prestasiNonAkademik = $user->prestasi()->valid()->nonAkademik()->get();
            $poinPrestasiNonAkademik = $prestasiNonAkademik->sum(function($prestasi) {
                return $prestasi->poin; // Gunakan accessor
            });

            $dataMahasiswa[$user->id] = [
                'ipk' => $user->ipk ?? 0,
                'prestasi_akademik' => $poinPrestasiAkademik,
                'organisasi' => $jumlahOrganisasi,
                'sertifikasi' => $poinSertifikasi,
                'prestasi_non_akademik' => $poinPrestasiNonAkademik,
            ];
        }

        // Simpan untuk normalisasi
        $this->rawData = $dataMahasiswa;
    }


    // ======================================
    // ============ HITUNG SKOR =============
    // ======================================

    private function hitungSkorSaw()
    {
        if (!isset($this->rawData) || empty($this->rawData)) {
            return;
        }

        $kriterias = BobotKriteria::orderBy('id')->get();
        $dataMahasiswa = $this->rawData;

        // Cari nilai max untuk setiap kriteria (semua benefit)
        $maxValues = [
            'ipk' => 4.00, // IPK maksimal
            'prestasi_akademik' => max(array_column($dataMahasiswa, 'prestasi_akademik')) ?: 1,
            'organisasi' => max(array_column($dataMahasiswa, 'organisasi')) ?: 1,
            'sertifikasi' => max(array_column($dataMahasiswa, 'sertifikasi')) ?: 1,
            'prestasi_non_akademik' => max(array_column($dataMahasiswa, 'prestasi_non_akademik')) ?: 1,
        ];

        $kriteriaKeys = ['ipk', 'prestasi_akademik', 'organisasi', 'sertifikasi', 'prestasi_non_akademik'];

        // Hitung skor SAW untuk setiap mahasiswa
        foreach ($dataMahasiswa as $userId => $data) {
            $totalSkor = 0;

            foreach ($kriterias as $index => $kriteria) {
                $key = $kriteriaKeys[$index] ?? null;
                if (!$key) continue;

                $nilaiAsli = $data[$key];
                $maxValue = $maxValues[$key];

                // Normalisasi (benefit): nilai / max
                $nilaiNormalisasi = $maxValue > 0 ? ($nilaiAsli / $maxValue) : 0;

                // Kalikan dengan bobot
                $totalSkor += $nilaiNormalisasi * $kriteria->bobot;
            }

            // Konversi skor SAW (0-1) ke sistem poin (0-1000)
            $poin = round($totalSkor * 1000, 2);

            // Update atau buat skor
            SkorSaw::updateOrCreate(
                ['user_id' => $userId],
                [
                    'total_skor' => round($totalSkor, 4),
                    'nilai_akhir' => $poin
                ]
            );
        }

        // Generate leaderboard setelah hitung skor
        $this->generateLeaderboard();
    }

    // ======================================
    // ======== GENERATE LEADERBOARD ========
    // ======================================

    private function generateLeaderboard()
    {
        // Get all scores ordered by nilai_akhir descending
        $scores = SkorSaw::orderBy('nilai_akhir', 'desc')->get();

        // Update leaderboard dengan peringkat
        foreach ($scores as $index => $score) {
            Leaderboard::updateOrCreate(
                ['user_id' => $score->user_id],
                [
                    'skor_id' => $score->id,
                    'peringkat' => $index + 1
                ]
            );
        }
    }
}
