@extends('layouts.umum')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('umum.leaderboard') }}" class="inline-flex items-center text-sky-600 hover:text-sky-700 font-semibold">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Kembali ke Leaderboard
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Profile Header -->
            <div class="bg-gradient-to-br from-sky-400 to-cyan-500 rounded-2xl p-8 text-white shadow-lg">
                <div class="flex items-start gap-6">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-sky-600 font-bold text-4xl shadow-lg">
                        {{ strtoupper(substr($mahasiswa->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-2">{{ $mahasiswa->name }}</h1>
                        <div class="space-y-1 text-sky-100">
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                NIM: <span class="font-semibold">{{ $mahasiswa->nim }}</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                {{ $mahasiswa->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ranking Info -->
            @if($leaderboard)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Peringkat & Skor SAW
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl p-6 text-white">
                        <p class="text-sm opacity-90 mb-2">Peringkat</p>
                        <div class="flex items-center gap-3">
                            @if($leaderboard->peringkat === 1)
                                <span class="text-4xl">🥇</span>
                            @elseif($leaderboard->peringkat === 2)
                                <span class="text-4xl">🥈</span>
                            @elseif($leaderboard->peringkat === 3)
                                <span class="text-4xl">🥉</span>
                            @else
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                    <span class="font-bold text-xl">{{ $leaderboard->peringkat }}</span>
                                </div>
                            @endif
                            <span class="text-3xl font-bold">#{{ $leaderboard->peringkat }}</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-sky-400 to-cyan-500 rounded-xl p-6 text-white">
                        <p class="text-sm opacity-90 mb-2">Skor SAW</p>
                        <p class="text-3xl font-bold">{{ number_format($leaderboard->skorSaw->nilai_akhir ?? 0, 2) }}</p>
                        <p class="text-xs opacity-75 mt-1">dari 100.00</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Prestasi List -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Daftar Prestasi
                </h3>

                @if($prestasis->count() > 0)
                    <div class="space-y-4">
                        @foreach($prestasis as $prestasi)
                        <div class="border border-gray-200 rounded-xl p-5 hover:border-sky-300 transition">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 mb-1">{{ $prestasi->nama_prestasi }}</h4>
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $prestasi->deskripsi }}</p>
                                </div>
                                <span class="ml-4 px-3 py-1 rounded-full text-xs font-bold 
                                    {{ $prestasi->tingkat == 'internasional' ? 'bg-purple-100 text-purple-700' : '' }}
                                    {{ $prestasi->tingkat == 'nasional' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $prestasi->tingkat == 'provinsi' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $prestasi->tingkat == 'kabupaten' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $prestasi->tingkat == 'kampus' ? 'bg-sky-100 text-sky-700' : '' }}">
                                    {{ ucfirst($prestasi->tingkat) }}
                                </span>
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $prestasi->tahun }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $prestasi->penyelenggara }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p>Belum ada prestasi yang terverifikasi</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Stats Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Prestasi</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Total Prestasi</p>
                                <p class="text-xl font-bold text-gray-900">{{ $prestasiStats['total'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <span class="text-lg">🌍</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Internasional</p>
                                <p class="text-xl font-bold text-purple-600">{{ $prestasiStats['internasional'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <span class="text-lg">🇮🇩</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Nasional</p>
                                <p class="text-xl font-bold text-red-600">{{ $prestasiStats['nasional'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <span class="text-lg">🏛️</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Regional</p>
                                <p class="text-xl font-bold text-blue-600">{{ $prestasiStats['regional'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-sky-50 rounded-2xl border border-sky-200 p-6">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-sky-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Tentang SAW</h4>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Peringkat dihitung menggunakan metode Simple Additive Weighting (SAW) berdasarkan berbagai kriteria prestasi mahasiswa.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Tautan Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('umum.leaderboard') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition group">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:bg-yellow-200 transition">
                            <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-900 group-hover:text-sky-600 transition">Lihat Leaderboard</span>
                    </a>
                    <a href="{{ route('umum.beasiswa') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition group">
                        <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center group-hover:bg-sky-200 transition">
                            <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-900 group-hover:text-sky-600 transition">Daftar Beasiswa</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
