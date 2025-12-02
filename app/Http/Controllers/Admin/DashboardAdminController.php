<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\BobotKriteria;
use App\Models\Prestasi;
use App\Models\User;
use App\Models\pendaftaranBeasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Statistics
        $totalBeasiswa = Beasiswa::count();
        $beasiswaAktif = Beasiswa::where('status', 'aktif')->count();
        $beasiswaDitutup = Beasiswa::where('status', 'ditutup')->count();
        
        $totalPendaftar = pendaftaranBeasiswa::count();
        $pendaftarDiterima = pendaftaranBeasiswa::where('status', 'diterima')->count();
        $pendaftarProses = pendaftaranBeasiswa::where('status', 'proses')->count();
        $pendaftarDitolak = pendaftaranBeasiswa::where('status', 'ditolak')->count();
        
        $totalPrestasi = Prestasi::count();
        $prestasiValid = Prestasi::where('status', 'valid')->count();
        $prestasiPending = Prestasi::where('status', 'pending')->count();
        $prestasiDitolak = Prestasi::where('status', 'ditolak')->count();
        
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalUmum = User::where('role', 'umum')->count();
        
        $totalBobotSAW = BobotKriteria::count();
        
        // Current date and time
        $currentDate = Carbon::now()->locale('id');
        $currentDateTime = $currentDate->isoFormat('dddd, D MMMM YYYY - HH:mm:ss');
        
        // Chart data - Prestasi by tingkat
        $prestasiByTingkat = [
            'internasional' => Prestasi::where('status', 'valid')->where('tingkat', 'internasional')->count(),
            'nasional' => Prestasi::where('status', 'valid')->where('tingkat', 'nasional')->count(),
            'provinsi' => Prestasi::where('status', 'valid')->where('tingkat', 'provinsi')->count(),
            'kabupaten' => Prestasi::where('status', 'valid')->where('tingkat', 'kabupaten')->count(),
            'kampus' => Prestasi::where('status', 'valid')->where('tingkat', 'kampus')->count(),
        ];
        
        // Chart data - Prestasi by jenis
        $prestasiByJenis = [
            'akademik' => Prestasi::where('status', 'valid')->where('jenis', 'akademik')->count(),
            'non_akademik' => Prestasi::where('status', 'valid')->where('jenis', 'non-akademik')->count(),
        ];
        
        // Chart data - Pendaftaran per bulan (last 6 months)
        $pendaftaranPerBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $pendaftaranPerBulan[] = [
                'bulan' => $month->locale('id')->isoFormat('MMM YYYY'),
                'jumlah' => pendaftaranBeasiswa::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count()
            ];
        }
        
        // Recent activities
        $recentPendaftaran = pendaftaranBeasiswa::with(['user', 'beasiswa'])
            ->latest()
            ->limit(5)
            ->get();
            
        $recentPrestasi = Prestasi::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBeasiswa',
            'beasiswaAktif',
            'beasiswaDitutup',
            'totalPendaftar',
            'pendaftarDiterima',
            'pendaftarProses',
            'pendaftarDitolak',
            'totalPrestasi',
            'prestasiValid',
            'prestasiPending',
            'prestasiDitolak',
            'totalUsers',
            'totalAdmin',
            'totalMahasiswa',
            'totalUmum',
            'totalBobotSAW',
            'currentDateTime',
            'prestasiByTingkat',
            'prestasiByJenis',
            'pendaftaranPerBulan',
            'recentPendaftaran',
            'recentPrestasi'
        ));
    }
}
