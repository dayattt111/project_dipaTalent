<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Prestasi;
use App\Models\SkorSaw;
use App\Models\Leaderboard;
use App\Models\Beasiswa;
use App\Models\GaleriPrestasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get count of pendaftaran
        $pendaftaranCount = Pendaftaran::where('user_id', $user->id)->count();
        
        // Get max IPK dari pendaftaran
        $maxIPK = Pendaftaran::where('user_id', $user->id)
            ->max('ipk') ?? 0;
        
        // Get count of prestasi
        $prestasiCount = Prestasi::where('user_id', $user->id)->count();
        
        // Get recent pendaftaran
        $recentPendaftaran = Pendaftaran::where('user_id', $user->id)
            ->with('beasiswa')
            ->latest()
            ->take(5)
            ->get();
        
        // Get recent prestasi
        $recentPrestasi = Prestasi::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        // Get SAW score
        $skorSaw = SkorSaw::where('user_id', $user->id)
            ->latest()
            ->first();
        
        $skorSawValue = $skorSaw?->total_skor ?? 0;
        
        // Get ranking from leaderboard
        $leaderboard = Leaderboard::where('user_id', $user->id)
            ->latest()
            ->first();
        
        $ranking = $leaderboard?->ranking ?? '-';
        
        // Get total users (mahasiswa)
        $totalUsers = \App\Models\User::where('role', 'mahasiswa')->count();
        
        return view('mahasiswa.dashboard', [
            'pendaftaranCount' => $pendaftaranCount,
            'prestasiCount' => $prestasiCount,
            'maxIPK' => number_format($maxIPK, 2),
            'ranking' => $ranking,
            'sawScore' => number_format($skorSawValue, 2),
            'totalUsers' => $totalUsers,
            'recentPendaftaran' => $recentPendaftaran,
            'recentPrestasi' => $recentPrestasi,
        ]);
    }

    public function ajukanBeasiswa()
    {
        $beasiswas = Beasiswa::where('status', 'aktif')->get();
        return view('mahasiswa.ajukanBeasiswa', ['beasiswas' => $beasiswas]);
    }

    public function storeAjukanBeasiswa()
    {
        $validated = request()->validate([
            'beasiswa_id' => 'required|exists:beasiswas,id',
            'ipk' => 'required|numeric|min:0|max:4',
            'prestasi_akademik' => 'required|string',
            'organisasi' => 'required|string',
            'keterampilan' => 'required|string',
            'transkrip' => 'required|mimes:pdf|max:5120',
            'foto' => 'required|mimes:jpeg,png|max:3072',
        ]);

        $user = Auth::user();
        
        // Store files
        $transkripPath = request()->file('transkrip')->store('pendaftaran/transkrip', 'public');
        $fotoPath = request()->file('foto')->store('pendaftaran/foto', 'public');
        
        // Create pendaftaran
        Pendaftaran::create([
            'user_id' => $user->id,
            'beasiswa_id' => $validated['beasiswa_id'],
            'ipk' => $validated['ipk'],
            'prestasi_akademik' => $validated['prestasi_akademik'],
            'organisasi' => $validated['organisasi'],
            'keterampilan' => $validated['keterampilan'],
            'transkrip' => $transkripPath,
            'foto' => $fotoPath,
            'status' => 'menunggu',
        ]);

        return redirect()->route('mahasiswa.riwayatPendaftaran')
            ->with('success', 'Beasiswa berhasil diajukan! Tim kami akan melakukan review dalam waktu 7-14 hari kerja.');
    }

    public function listBeasiswa()
    {
        $beasiswas = Beasiswa::all();
        return view('mahasiswa.listBeasiswa', ['beasiswas' => $beasiswas]);
    }

    public function beasiswaDetail($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('mahasiswa.beasiswa-detail', ['beasiswa' => $beasiswa]);
    }

    public function riwayatPendaftaran()
    {
        $user = Auth::user();
        
        $totalPendaftaran = Pendaftaran::where('user_id', $user->id)->count();
        $pendingPendaftaran = Pendaftaran::where('user_id', $user->id)->where('status', 'menunggu')->count();
        $acceptedPendaftaran = Pendaftaran::where('user_id', $user->id)->where('status', 'diterima')->count();
        $rejectedPendaftaran = Pendaftaran::where('user_id', $user->id)->where('status', 'ditolak')->count();
        
        $pendaftarans = Pendaftaran::where('user_id', $user->id)
            ->with('beasiswa')
            ->latest()
            ->paginate(10);
        
        return view('mahasiswa.riwayatPendaftaran', [
            'pendaftarans' => $pendaftarans,
            'totalPendaftaran' => $totalPendaftaran,
            'pendingPendaftaran' => $pendingPendaftaran,
            'acceptedPendaftaran' => $acceptedPendaftaran,
            'rejectedPendaftaran' => $rejectedPendaftaran,
        ]);
    }

    public function prestasi()
    {
        $user = Auth::user();
        $prestasis = Prestasi::where('user_id', $user->id)->latest()->get();
        
        return view('mahasiswa.prestasi', ['prestasis' => $prestasis]);
    }

    public function storePrestasi()
    {
        $validated = request()->validate([
            'jenis' => 'required|in:akademik,non_akademik',
            'tingkat' => 'required|in:internasional,nasional,regional,provinsi,kabupaten,universitas,fakultas,program_studi',
            'nama_prestasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_pencapaian' => 'required|date',
            'penyelenggara' => 'required|string|max:255',
            'sertifikat' => 'required|mimes:pdf,jpeg,png|max:5120',
        ]);

        $user = Auth::user();
        
        // Store sertifikat
        $sertifikatPath = request()->file('sertifikat')->store('prestasi/sertifikat', 'public');
        
        // Create prestasi
        Prestasi::create([
            'user_id' => $user->id,
            'jenis' => $validated['jenis'],
            'tingkat' => $validated['tingkat'],
            'nama_prestasi' => $validated['nama_prestasi'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_pencapaian' => $validated['tanggal_pencapaian'],
            'penyelenggara' => $validated['penyelenggara'],
            'sertifikat' => $sertifikatPath,
            'status' => 'menunggu',
        ]);

        return redirect()->route('mahasiswa.prestasi')
            ->with('success', 'Prestasi berhasil ditambahkan! Admin akan melakukan verifikasi.');
    }

    public function editPrestasi($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        if ($prestasi->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('mahasiswa.prestasi-edit', ['prestasi' => $prestasi]);
    }

    public function updatePrestasi($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        if ($prestasi->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = request()->validate([
            'jenis' => 'required|in:akademik,non_akademik',
            'tingkat' => 'required|in:internasional,nasional,regional,provinsi,kabupaten,universitas,fakultas,program_studi',
            'nama_prestasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_pencapaian' => 'required|date',
            'penyelenggara' => 'required|string|max:255',
            'sertifikat' => 'nullable|mimes:pdf,jpeg,png|max:5120',
        ]);

        if (request()->hasFile('sertifikat')) {
            Storage::disk('public')->delete($prestasi->sertifikat);
            $validated['sertifikat'] = request()->file('sertifikat')->store('prestasi/sertifikat', 'public');
        }

        $prestasi->update($validated);

        return redirect()->route('mahasiswa.prestasi')
            ->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function deletePrestasi($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        if ($prestasi->user_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($prestasi->sertifikat);
        $prestasi->delete();

        return redirect()->route('mahasiswa.prestasi')
            ->with('success', 'Prestasi berhasil dihapus!');
    }

    public function leaderboard()
    {
        $user = Auth::user();
        
        // Get all scores from SkorSaw, ordered by total_skor descending
        $skorSawList = SkorSaw::with('user')
            ->orderBy('total_skor', 'desc')
            ->get();
        
        // Get user's ranking and score
        $userScore = SkorSaw::where('user_id', $user->id)->latest()->first();
        $myRanking = $skorSawList->search(function($item) use ($user) {
            return $item->user_id === $user->id;
        });
        $myRanking = $myRanking !== false ? $myRanking + 1 : null;
        
        // Get total users
        $totalMahasiswa = $skorSawList->count();
        
        // Get average score
        $avgScore = $skorSawList->avg('total_skor') ?? 0;
        
        // Get max score
        $maxScore = $skorSawList->max('total_skor') ?? 0;
        
        // Get paginated leaderboard from SkorSaw data
        $leaderboard = SkorSaw::with('user')
            ->orderBy('total_skor', 'desc')
            ->paginate(15);
        
        // Add ranking number to each item
        $leaderboard->getCollection()->transform(function($item, $key) use ($leaderboard) {
            $item->ranking = (($leaderboard->currentPage() - 1) * $leaderboard->perPage()) + $key + 1;
            return $item;
        });
        
        return view('mahasiswa.leaderboard', [
            'leaderboard' => $leaderboard,
            'myRanking' => $myRanking,
            'myScore' => $userScore,
            'totalMahasiswa' => $totalMahasiswa,
            'avgScore' => number_format($avgScore, 2),
            'maxScore' => number_format($maxScore, 2),
        ]);
    }

    public function galeri()
    {
        $galeri = GaleriPrestasi::with('user')
            ->where('status', 'valid')
            ->latest()
            ->paginate(12);
        
        return view('mahasiswa.galeri', ['galeri' => $galeri]);
    }
}
