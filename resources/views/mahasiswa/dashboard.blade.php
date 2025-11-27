@extends('layouts.mahasiswa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Selamat datang, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-gray-600 mt-1">NIM: {{ Auth::user()->nim ?? 'N/A' }}</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 - Beasiswa Aktif -->
        <div class="bg-white rounded-xl shadow-sm border border-blue-100 p-6 hover:shadow-lg transition-all hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Beasiswa Aktif</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $pendaftaranCount ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">pengajuan sedang diproses</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-blue-600">
                        <path d="M4 4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2V4zm2.5 7a2.5 2.5 0 0 0 0 5h3a2.5 2.5 0 0 0 0-5h-3zm9-7a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v-8zm-2.5 7a2.5 2.5 0 0 0 0 5h3a2.5 2.5 0 0 0 0-5h-3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 - Prestasi -->
        <div class="bg-white rounded-xl shadow-sm border border-green-100 p-6 hover:shadow-lg transition-all hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Total Prestasi</p>
                    <p class="text-3xl font-bold text-green-600">{{ $prestasiCount ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">pencapaian Anda</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-green-600">
                        <path d="M6 .5a.5.5 0 0 1 .5.5v6h3V1a.5.5 0 0 1 1 0v6h3V1a.5.5 0 0 1 1 0v6.5a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5V1a.5.5 0 0 1 .5-.5h1V.5a.5.5 0 0 1 .5-.5h1V.5a.5.5 0 0 1 .5-.5h1V.5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 - IPK -->
        <div class="bg-white rounded-xl shadow-sm border border-purple-100 p-6 hover:shadow-lg transition-all hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">IPK Tertinggi</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $maxIPK ?? '0.00' }}</p>
                    <p class="text-xs text-gray-500 mt-1">dari maksimal 4.0</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-purple-600">
                        <path d="M12.206 3.007H3.794a.75.75 0 1 0 0 1.5h8.412a.75.75 0 1 0 0-1.5zM3.794 6.757h8.412a.75.75 0 0 0 0-1.5H3.794a.75.75 0 0 0 0 1.5zm0 3a.75.75 0 0 0 0 1.5h8.412a.75.75 0 0 0 0-1.5H3.794z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 - Skor SAW Ranking -->
        <div class="bg-white rounded-xl shadow-sm border border-indigo-100 p-6 hover:shadow-lg transition-all hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Ranking SAW</p>
                    <p class="text-3xl font-bold text-indigo-600">#{{ $ranking ?? '-' }}</p>
                    <p class="text-xs text-gray-500 mt-1">posisi Anda saat ini</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-indigo-600">
                        <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Recent Activities -->
        <div class="lg:col-span-2">
            <!-- Recent Pendaftaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">📝 Pendaftaran Terbaru</h3>
                    <a href="{{ route('mahasiswa.riwayatPendaftaran') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @if($recentPendaftaran && count($recentPendaftaran) > 0)
                        @foreach($recentPendaftaran as $item)
                        <div class="border border-gray-100 rounded-lg p-4 hover:bg-gray-50 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item->beasiswa->nama_beasiswa ?? 'Beasiswa' }}</p>
                                    <p class="text-sm text-gray-600">Diajukan {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-medium 
                                    @if($item->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($item->status == 'accepted') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada pendaftaran beasiswa</p>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">⚡ Aksi Cepat</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('mahasiswa.listBeasiswa') }}" class="bg-white border border-blue-200 rounded-lg p-4 hover:bg-blue-50 transition text-center">
                        <p class="text-sm font-medium text-gray-900">Cari Beasiswa</p>
                        <p class="text-xs text-gray-500">Jelajahi program terbaru</p>
                    </a>
                    <a href="{{ route('mahasiswa.prestasi') }}" class="bg-white border border-green-200 rounded-lg p-4 hover:bg-green-50 transition text-center">
                        <p class="text-sm font-medium text-gray-900">Upload Prestasi</p>
                        <p class="text-xs text-gray-500">Tambah pencapaian Anda</p>
                    </a>
                    <a href="{{ route('mahasiswa.leaderboard') }}" class="bg-white border border-purple-200 rounded-lg p-4 hover:bg-purple-50 transition text-center">
                        <p class="text-sm font-medium text-gray-900">Leaderboard</p>
                        <p class="text-xs text-gray-500">Lihat peringkat SAW</p>
                    </a>
                    <a href="{{ route('mahasiswa.galeri') }}" class="bg-white border border-indigo-200 rounded-lg p-4 hover:bg-indigo-50 transition text-center">
                        <p class="text-sm font-medium text-gray-900">Galeri Prestasi</p>
                        <p class="text-xs text-gray-500">Inspirasi dari sesama</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column - Info & Stats -->
        <div>
            <!-- My Ranking Card -->
            <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl shadow-lg p-6 text-white mb-6">
                <h3 class="font-bold text-lg mb-4">Peringkat Anda</h3>
                <div class="text-center mb-4">
                    <p class="text-5xl font-bold mb-2">#{{ $ranking ?? '-' }}</p>
                    <p class="text-indigo-100">dari {{ $totalUsers ?? 0 }} mahasiswa</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-lg p-3">
                    <p class="text-sm text-indigo-50 mb-2">Skor SAW Anda</p>
                    <p class="text-2xl font-bold">{{ $sawScore ?? '0.00' }}</p>
                </div>
            </div>

            <!-- Tips & Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-bold text-gray-900 mb-4">💡 Tips untuk Anda</h3>
                <div class="space-y-3">
                    <div class="border-l-4 border-blue-500 pl-3">
                        <p class="text-sm font-medium text-gray-900">Perbanyak Prestasi</p>
                        <p class="text-xs text-gray-600">Setiap prestasi meningkatkan skor SAW Anda</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-3">
                        <p class="text-sm font-medium text-gray-900">Jaga IPK</p>
                        <p class="text-xs text-gray-600">IPK adalah kriteria utama seleksi beasiswa</p>
                    </div>
                    <div class="border-l-4 border-purple-500 pl-3">
                        <p class="text-sm font-medium text-gray-900">Lengkapi Dokumen</p>
                        <p class="text-xs text-gray-600">Dokumen lengkap meningkatkan peluang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
