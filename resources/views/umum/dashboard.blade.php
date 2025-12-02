@extends('layouts.umum')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-600 mt-2">Jelajahi informasi beasiswa dan prestasi mahasiswa terbaik</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Beasiswa -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Program Beasiswa</p>
                    <p class="text-3xl font-bold mt-1">{{ $totalBeasiswa }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                    </svg>
                </div>
            </div>
            <p class="text-blue-100 text-sm">{{ $activeBeasiswaCount }} program sedang aktif</p>
        </div>

        <!-- Total Mahasiswa -->
        <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-cyan-100 text-sm font-medium">Total Mahasiswa</p>
                    <p class="text-3xl font-bold mt-1">{{ $totalMahasiswa }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
            </div>
            <p class="text-cyan-100 text-sm">{{ $studentWithAchievements }} dengan prestasi valid</p>
        </div>

        <!-- Total Prestasi -->
        <div class="bg-gradient-to-br from-sky-500 to-sky-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sky-100 text-sm font-medium">Total Prestasi</p>
                    <p class="text-3xl font-bold mt-1">{{ $totalPrestasi }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
            <p class="text-sky-100 text-sm">Prestasi terverifikasi</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Leaderboard Section (2 columns) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">🏆 Top 10 Mahasiswa Berprestasi</h2>
                        <p class="text-sm text-gray-600 mt-1">Berdasarkan Metode SAW (Simple Additive Weighting)</p>
                    </div>
                    <a href="{{ route('umum.leaderboard') }}" class="px-4 py-2 bg-sky-50 text-sky-600 rounded-lg hover:bg-sky-100 transition text-sm font-semibold">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-6">
                    @if($topLeaderboard->count() > 0)
                        <div class="space-y-4">
                            @foreach($topLeaderboard as $index => $leader)
                            <div class="flex items-center gap-4 p-4 rounded-xl {{ $index < 3 ? 'bg-gradient-to-r from-sky-50 to-cyan-50 border-2 border-sky-200' : 'bg-gray-50' }} hover:shadow-md transition">
                                <!-- Rank Badge -->
                                <div class="flex-shrink-0">
                                    @if($index === 0)
                                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                            🥇
                                        </div>
                                    @elseif($index === 1)
                                        <div class="w-12 h-12 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                            🥈
                                        </div>
                                    @elseif($index === 2)
                                        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                            🥉
                                        </div>
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-br from-sky-100 to-cyan-100 rounded-full flex items-center justify-center text-sky-700 font-bold text-lg">
                                            {{ $leader->peringkat }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Student Info -->
                                <div class="flex-grow min-w-0">
                                    <h3 class="font-bold text-gray-900 truncate">{{ $leader->user->name }}</h3>
                                    <p class="text-sm text-gray-600">NIM: {{ $leader->user->nim }}</p>
                                </div>

                                <!-- Score -->
                                <div class="flex-shrink-0 text-right">
                                    <p class="text-2xl font-bold text-sky-600">{{ number_format($leader->skorSaw->nilai_akhir ?? 0, 2) }}</p>
                                    <p class="text-xs text-gray-500">Skor SAW</p>
                                </div>

                                <!-- View Profile -->
                                <a href="{{ route('umum.mahasiswa.profile', $leader->user_id) }}" class="flex-shrink-0 px-3 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition text-sm font-medium text-gray-700">
                                    Lihat
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="mt-2 text-gray-500">Belum ada data leaderboard</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Links -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Menu Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('umum.leaderboard') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-sky-50 transition group">
                        <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center group-hover:bg-sky-200 transition">
                            <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 text-sm">Leaderboard Lengkap</p>
                            <p class="text-xs text-gray-500">Lihat semua peringkat</p>
                        </div>
                    </a>
                    <a href="{{ route('umum.beasiswa') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-sky-50 transition group">
                        <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center group-hover:bg-cyan-200 transition">
                            <svg class="w-5 h-5 text-cyan-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 text-sm">Daftar Beasiswa</p>
                            <p class="text-xs text-gray-500">Jelajahi program beasiswa</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-gradient-to-br from-sky-500 to-cyan-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <h3 class="font-bold text-lg">Info</h3>
                </div>
                <p class="text-sm text-sky-50">
                    Platform ini menggunakan metode SAW untuk menentukan peringkat mahasiswa berdasarkan IPK, prestasi, organisasi, dan kriteria lainnya secara objektif.
                </p>
            </div>
        </div>
    </div>

    <!-- Recent Achievements -->
    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">✨ Prestasi Terbaru</h2>
            <p class="text-sm text-gray-600 mt-1">Pencapaian mahasiswa yang baru diverifikasi</p>
        </div>
        <div class="p-6">
            @if($recentPrestasi->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentPrestasi as $prestasi)
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-5 border border-blue-100 hover:shadow-lg transition">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <div class="flex-grow min-w-0">
                                <span class="inline-block px-2 py-1 bg-sky-100 text-sky-700 text-xs font-semibold rounded mb-2">
                                    {{ ucwords(str_replace('_', ' ', $prestasi->tingkat)) }}
                                </span>
                                <h3 class="font-bold text-gray-900 text-sm line-clamp-2">{{ $prestasi->nama_prestasi }}</h3>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $prestasi->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span class="font-medium">{{ $prestasi->user->name }}</span>
                            <span>{{ $prestasi->tahun }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="mt-2 text-gray-500">Belum ada prestasi terbaru</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
