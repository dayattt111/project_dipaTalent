@extends('layouts.umum')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">🏆 Leaderboard Mahasiswa Berprestasi</h1>
        <p class="text-gray-600 mt-2">Ranking berdasarkan Metode SAW (Simple Additive Weighting)</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalStudents }}</p>
                    <p class="text-sm text-gray-600">Total Mahasiswa</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">🥇</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $leaderboards->first()->user->name ?? '-' }}</p>
                    <p class="text-sm text-gray-600">Juara 1</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($leaderboards->first()->skorSaw->nilai_akhir ?? 0, 2) }}</p>
                    <p class="text-sm text-gray-600">Skor Tertinggi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaderboard Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Peringkat</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Mahasiswa</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">NIM</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Skor SAW</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($leaderboards as $index => $leader)
                    <tr class="hover:bg-gray-50 {{ $index < 3 ? 'bg-sky-50/50' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($leader->peringkat === 1)
                                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                                        <span class="text-xl">🥇</span>
                                    </div>
                                @elseif($leader->peringkat === 2)
                                    <div class="w-10 h-10 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center shadow-lg">
                                        <span class="text-xl">🥈</span>
                                    </div>
                                @elseif($leader->peringkat === 3)
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                                        <span class="text-xl">🥉</span>
                                    </div>
                                @else
                                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                        <span class="font-bold text-gray-700">{{ $leader->peringkat }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-sky-400 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($leader->user->name, 0, 1)) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $leader->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $leader->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-900 font-medium">{{ $leader->user->nim }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-sky-100 text-sky-800">
                                {{ number_format($leader->skorSaw->nilai_akhir ?? 0, 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="{{ route('umum.mahasiswa.profile', $leader->user_id) }}" class="inline-flex items-center px-4 py-2 bg-sky-50 text-sky-600 rounded-lg hover:bg-sky-100 transition text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                Lihat Profil
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="mt-2">Belum ada data leaderboard</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($leaderboards->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $leaderboards->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
