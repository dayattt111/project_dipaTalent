<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Leaderboard;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;

class UmumController extends Controller
{
    /**
     * Display the umum dashboard
     */
    public function dashboard()
    {
        // Get top 10 leaderboard
        $topLeaderboard = Leaderboard::with(['user', 'skorSaw'])
            ->orderBy('peringkat', 'asc')
            ->limit(10)
            ->get();

        // Get active scholarships count
        $activeBeasiswaCount = Beasiswa::where('status', 'aktif')->count();

        // Get total students with achievements
        $studentWithAchievements = Prestasi::where('status', 'valid')
            ->distinct('user_id')
            ->count('user_id');

        // Get recent valid achievements
        $recentPrestasi = Prestasi::with('user')
            ->where('status', 'valid')
            ->latest()
            ->limit(6)
            ->get();

        // Get statistics
        $totalBeasiswa = Beasiswa::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalPrestasi = Prestasi::where('status', 'valid')->count();

        return view('umum.dashboard', compact(
            'topLeaderboard',
            'activeBeasiswaCount',
            'studentWithAchievements',
            'recentPrestasi',
            'totalBeasiswa',
            'totalMahasiswa',
            'totalPrestasi'
        ));
    }

    /**
     * Display full leaderboard
     */
    public function leaderboard()
    {
        $leaderboards = Leaderboard::with(['user', 'skorSaw'])
            ->orderBy('peringkat', 'asc')
            ->paginate(20);

        $totalStudents = User::where('role', 'mahasiswa')->count();

        return view('umum.leaderboard', compact('leaderboards', 'totalStudents'));
    }

    /**
     * Display list of scholarships
     */
    public function beasiswa(Request $request)
    {
        $query = Beasiswa::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('nama_beasiswa', 'like', '%' . $request->search . '%');
        }

        $beasiswas = $query->latest()->paginate(12);
        
        $stats = [
            'total' => Beasiswa::count(),
            'aktif' => Beasiswa::where('status', 'aktif')->count(),
            'ditutup' => Beasiswa::where('status', 'ditutup')->count(),
        ];

        return view('umum.beasiswa', compact('beasiswas', 'stats'));
    }

    /**
     * Display scholarship detail
     */
    public function beasiswaDetail($id)
    {
        $beasiswa = Beasiswa::with(['pendaftaran' => function($query) {
            $query->where('status', 'diterima');
        }])->findOrFail($id);

        $acceptedCount = $beasiswa->pendaftaran->count();
        $availableQuota = max(0, $beasiswa->kuota - $acceptedCount);

        return view('umum.beasiswa-detail', compact('beasiswa', 'acceptedCount', 'availableQuota'));
    }

    /**
     * Display student profile from leaderboard
     */
    public function mahasiswaProfile($id)
    {
        $mahasiswa = User::with(['prestasi' => function($query) {
            $query->where('status', 'valid')->latest();
        }, 'leaderboard.skorSaw'])
            ->where('role', 'mahasiswa')
            ->findOrFail($id);

        // Get leaderboard data
        $leaderboard = $mahasiswa->leaderboard;

        // Get prestasi
        $prestasis = $mahasiswa->prestasi;

        // Calculate prestasi stats
        $prestasiStats = [
            'total' => $prestasis->count(),
            'internasional' => $prestasis->where('tingkat', 'internasional')->count(),
            'nasional' => $prestasis->where('tingkat', 'nasional')->count(),
            'regional' => $prestasis->whereIn('tingkat', ['provinsi', 'kabupaten', 'kampus'])->count(),
        ];

        return view('umum.mahasiswa-profile', compact(
            'mahasiswa',
            'leaderboard',
            'prestasis',
            'prestasiStats'
        ));
    }
}
