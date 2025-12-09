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
    public function index()
    {
        $kriterias = BobotKriteria::all();
        return view('admin.metode.index', compact('kriterias'));
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

        // Ambil semua kriteria kecuali yang diedit
        $otherKriterias = BobotKriteria::where('id', '!=', $id)->get();
        $countOthers = $otherKriterias->count();

        // Hitung sisa total untuk dibagi ke kriteria lain
        $remaining = round(1 - $newBobot, 4);
        
        if ($countOthers > 0) {
            // Bagikan sisa bobot secara merata ke kriteria lain
            $share = round($remaining / $countOthers, 4);
            
            // Hitung akumulasi untuk adjustment
            $totalDistributed = $share * $countOthers;
            $difference = round($remaining - $totalDistributed, 4);
            
            // Update kriteria lain
            $updated = 0;
            foreach ($otherKriterias as $k) {
                $bobotBaru = $share;
                
                // Tambahkan sisa pembulatan ke kriteria terakhir
                if ($updated === $countOthers - 1 && $difference != 0) {
                    $bobotBaru = round($share + $difference, 4);
                }
                
                $k->update(['bobot' => $bobotBaru]);
                $updated++;
            }
        }

        // Update kriteria yang diedit SETELAH update yang lain
        $kriteria = BobotKriteria::findOrFail($id);
        $kriteria->update([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot'         => $newBobot,
            'tipe'          => $request->tipe,
        ]);

        // Recalculate SAW
        $this->hitungNormalisasiSaw();
        $this->hitungSkorSaw();

        return redirect()->route('admin.metode.index')
                        ->with('success', 'Bobot berhasil diperbarui! Kriteria lain telah disesuaikan otomatis. Total bobot: 100%');
    }


    // ======================================
    // ==========  NORMALISASI SAW ==========
    // ======================================

    private function hitungNormalisasiSaw()
    {
        $kriterias = BobotKriteria::all();
        $prestasis = Prestasi::all();

        foreach ($kriterias as $kriteria) {

            // Ambil nilai asli prestasi berdasar kriteria
            $nilai_asli = NormalisasiSaw::where('kriteria_id', $kriteria->id)
                                        ->pluck('nilai_normalisasi')
                                        ->toArray();

            if (empty($nilai_asli)) {
                continue;
            }

            // Benefit = nilai / max
            // Cost    = min / nilai
            $max = max($nilai_asli);
            $min = min($nilai_asli);

            foreach ($prestasis as $p) {

                $data = NormalisasiSaw::where('prestasi_id', $p->id)
                                       ->where('kriteria_id', $kriteria->id)
                                       ->first();

                if (!$data) {
                    continue;
                }

                $nilai = $data->nilai_normalisasi;

                if ($kriteria->tipe == 'benefit') {
                    $hasil = $max == 0 ? 0 : $nilai / $max;
                } else {
                    $hasil = $nilai == 0 ? 0 : $min / $nilai;
                }

                $data->update([
                    'nilai_normalisasi' => round($hasil, 4),
                ]);
            }
        }
    }


    // ======================================
    // ============ HITUNG SKOR =============
    // ======================================

    private function hitungSkorSaw()
    {
        $kriterias = BobotKriteria::all();
        $prestasis = Prestasi::all();

        foreach ($prestasis as $p) {

            $total = 0;

            foreach ($kriterias as $kriteria) {

                $norm = NormalisasiSaw::where('prestasi_id', $p->id)
                        ->where('kriteria_id', $kriteria->id)
                        ->first();

                if ($norm) {
                    $total += $norm->nilai_normalisasi * $kriteria->bobot;
                }
            }

            // Update atau buat skor
            SkorSaw::updateOrCreate(
                ['user_id' => $p->user_id],
                [
                    'total_skor' => round($total, 4),
                    'nilai_akhir' => round($total, 4)
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
