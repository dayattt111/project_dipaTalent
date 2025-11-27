@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Leaderboard Mahasiswa</h1>
            <p class="text-gray-600">Peringkat mahasiswa berdasarkan skor SAW (Simple Additive Weighting)</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Your Rank Card -->
            <div class="bg-white rounded-xl shadow-sm border border-blue-100 p-6">
                <p class="text-sm text-gray-600 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    Peringkat Anda
                </p>
                <p class="text-3xl font-bold text-blue-600">
                    @if($userRanking)
                        {{ $userRanking->ranking ?? '-' }}
                    @else
                        -
                    @endif
                </p>
                <p class="text-xs text-gray-500 mt-2">dari {{ $totalUsers }} mahasiswa</p>
            </div>

            <!-- Your Score Card -->
            <div class="bg-white rounded-xl shadow-sm border border-indigo-100 p-6">
                <p class="text-sm text-gray-600 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Skor SAW Anda
                </p>
                <p class="text-3xl font-bold text-indigo-600">
                    @if($userScore)
                        {{ number_format($userScore->total_skor, 2) }}
                    @else
                        0.00
                    @endif
                </p>
                <p class="text-xs text-gray-500 mt-2">Skor Maksimal: 1.00</p>
            </div>

            <!-- Percentile Card -->
            <div class="bg-white rounded-xl shadow-sm border border-purple-100 p-6">
                <p class="text-sm text-gray-600 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                    Persentil
                </p>
                <p class="text-3xl font-bold text-purple-600">
                    @if($userRanking && $totalUsers > 0)
                        {{ round(((($totalUsers - $userRanking->ranking) / $totalUsers) * 100), 1) }}%
                    @else
                        0%
                    @endif
                </p>
                <p class="text-xs text-gray-500 mt-2">Posisi atas {{ round(((($totalUsers - ($userRanking?->ranking ?? 1)) / $totalUsers) * 100), 1) }}%</p>
            </div>
        </div>

        <!-- Leaderboard Table -->
        <div class="bg-white rounded-xl shadow-sm border border-blue-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h2 class="text-lg font-semibold text-gray-900">Ranking Lengkap</h2>
            </div>

            @if($leaderboards->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Peringkat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">NIM</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Skor SAW</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Progress</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($leaderboards as $rank)
                                @php
                                    $isCurrentUser = Auth::user()->id === $rank->user_id;
                                    $scorePercentage = ($rank->skorSaw?->total_skor ?? 0) * 100;
                                    $medalEmoji = match($rank->ranking) {
                                        1 => '🥇',
                                        2 => '🥈',
                                        3 => '🥉',
                                        default => ''
                                    };
                                @endphp
                                <tr class="@if($isCurrentUser) bg-blue-50 @else hover:bg-gray-50 @endif transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-lg mr-2">{{ $medalEmoji }}</span>
                                            <span class="text-sm font-bold @if($rank->ranking <= 3) text-blue-600 @else text-gray-600 @endif">
                                                #{{ $rank->ranking }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center">
                                                <span class="text-white font-bold text-sm">
                                                    {{ substr($rank->user->name ?? 'U', 0, 1) }}
                                                </span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium @if($isCurrentUser) text-blue-900 @else text-gray-900 @endif">
                                                    {{ $rank->user->name ?? 'N/A' }}
                                                    @if($isCurrentUser)
                                                        <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full font-semibold">Anda</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-600">{{ $rank->user->nim ?? '-' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold">
                                            <span class="text-lg text-indigo-600">{{ number_format($rank->skorSaw?->total_skor ?? 0, 3) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap w-48">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-300"
                                                 style="width: {{ $scorePercentage }}%">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($rank->ranking <= 10)
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full font-semibold">Top 10</span>
                                        @elseif($rank->ranking <= 25)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full font-semibold">Excellent</span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs rounded-full font-semibold">Standar</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($leaderboards->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $leaderboards->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="mt-4 text-gray-600">Belum ada data leaderboard</p>
                    <p class="text-sm text-gray-500">Data akan tersedia setelah sistem SAW memproses pendaftaran</p>
                </div>
            @endif
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- SAW Explanation -->
            <div class="bg-white rounded-xl shadow-sm border border-blue-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"></path>
                    </svg>
                    Tentang SAW
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    <strong>Simple Additive Weighting (SAW)</strong> adalah metode pengambilan keputusan yang digunakan untuk mengevaluasi dan menentukan peringkat mahasiswa berdasarkan beberapa kriteria yang telah ditentukan.
                </p>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Skor SAW Anda dihitung berdasarkan nilai prestasi akademik, non-akademik, dan faktor-faktor lainnya dengan bobot tertentu untuk memberikan penilaian yang adil dan komprehensif.
                </p>
            </div>

            <!-- Ranking Tips -->
            <div class="bg-white rounded-xl shadow-sm border border-indigo-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    Tips Meningkatkan Peringkat
                </h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <span class="text-indigo-600 font-bold mr-3">1.</span>
                        <span>Tingkatkan prestasi akademik dengan mempertahankan IPK tinggi</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-indigo-600 font-bold mr-3">2.</span>
                        <span>Raih prestasi non-akademik melalui kompetisi dan sertifikasi</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-indigo-600 font-bold mr-3">3.</span>
                        <span>Aktif dalam organisasi dan kegiatan kampus</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-indigo-600 font-bold mr-3">4.</span>
                        <span>Lengkapi semua data dan dokumen yang dibutuhkan</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
