@extends('layouts.mahasiswa')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Leaderboard SAW 🏆</h1>
        <p class="text-gray-600 mt-2">Peringkat mahasiswa berdasarkan metode Simple Additive Weighting</p>
    </div>

    <!-- My Ranking Card -->
    @if($myRanking && $myScore)
    <div class="bg-gradient-to-r from-indigo-500 via-blue-500 to-blue-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <p class="text-indigo-100 text-sm mb-2 font-medium">POSISI ANDA</p>
                <p class="text-6xl font-bold">#{{ $myRanking }}</p>
            </div>
            <div class="border-l-2 border-r-2 border-white border-opacity-30 pl-6 pr-6">
                <p class="text-indigo-100 text-sm mb-2 font-medium">SKOR SAW</p>
                <p class="text-6xl font-bold">{{ number_format(($myScore->nilai_akhir ?? $myScore->total_skor ?? 0) * 100, 2) }}</p>
                <p class="text-sm text-indigo-100 mt-1">dari 100</p>
            </div>
            <div class="text-center">
                <p class="text-indigo-100 text-sm mb-2 font-medium">DARI TOTAL</p>
                <p class="text-4xl font-bold">{{ $totalMahasiswa ?? 0 }} Mahasiswa</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Info Box -->
    <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mb-8">
        <h3 class="font-bold text-blue-900 mb-2">ℹ️ Tentang Metode SAW</h3>
        <p class="text-sm text-blue-800">Simple Additive Weighting (SAW) adalah metode pengambilan keputusan multikriteria yang menghitung skor berdasarkan kriteria: IPK, Prestasi, dan kontribusi akademik lainnya.</p>
    </div>

    <!-- Leaderboard Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-4">
            <h2 class="text-lg font-bold text-white">📊 Top 15 Mahasiswa Terbaik</h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Peringkat</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">NIM</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Skor SAW</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaderboard as $index => $leader)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition {{ Auth::id() == $leader->user_id ? 'bg-indigo-50 border-indigo-200' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @php
                                    $ranking = $leader->ranking ?? (($leaderboard->currentPage() - 1) * $leaderboard->perPage() + $loop->iteration);
                                @endphp
                                @if($ranking == 1)
                                    <span class="text-2xl">🥇</span>
                                @elseif($ranking == 2)
                                    <span class="text-2xl">🥈</span>
                                @elseif($ranking == 3)
                                    <span class="text-2xl">🥉</span>
                                @else
                                    <span class="font-bold text-gray-700 w-6 text-center">#{{ $ranking }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-bold text-gray-900">{{ $leader->user->name ?? 'Mahasiswa' }}</p>
                                <p class="text-xs text-gray-500">{{ $leader->user->email ?? '-' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $leader->user->nim ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $skor = $leader->nilai_akhir ?? $leader->total_skor ?? 0;
                                $skorDisplay = $skor * 100; // Convert to 0-100 scale
                            @endphp
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full font-bold text-sm">
                                {{ number_format($skorDisplay, 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                // skorDisplay already calculated above (0-100 scale)
                                $percentage = min(100, max(0, $skorDisplay)); // Already in 0-100 scale
                            @endphp
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full transition-all" style="width: {{ number_format($percentage, 1) }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ number_format($percentage, 1) }}%</p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data leaderboard
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($leaderboard->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $leaderboard->links() }}
        </div>
        @endif
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Average Score -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-900">Rata-rata Skor</h3>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="text-blue-600">
                        <path d="M9.465 10H12a2 2 0 1 0 0-1H9.465a.5.5 0 0 0 0 1zM8 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm4.5-1.5A1.5 1.5 0 1 0 11 5.5 1.5 1.5 0 0 0 12.5 4z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-blue-600">{{ number_format(($avgScore ?? 0) * 100, 2) }}</p>
            <p class="text-xs text-gray-500 mt-2">dari semua mahasiswa</p>
        </div>

        <!-- Highest Score -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-900">Skor Tertinggi</h3>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="text-green-600">
                        <path d="M6 .5a.5.5 0 0 1 .5.5v6h3V1a.5.5 0 0 1 1 0v6h3V1a.5.5 0 0 1 1 0v6.5a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5V1a.5.5 0 0 1 .5-.5h1V.5a.5.5 0 0 1 .5-.5h1V.5a.5.5 0 0 1 .5-.5h1V.5z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-green-600">{{ number_format(($maxScore ?? 0) * 100, 2) }}</p>
            <p class="text-xs text-gray-500 mt-2">skor maksimal yang dicapai</p>
        </div>

        <!-- Total Participants -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-900">Total Peserta</h3>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="text-purple-600">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-purple-600">{{ $totalMahasiswa ?? 0 }}</p>
            <p class="text-xs text-gray-500 mt-2">mahasiswa aktif</p>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-medium">
            ← Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
