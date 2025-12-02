@extends('layouts.umum')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">📚 Daftar Beasiswa</h1>
        <p class="text-gray-600 mt-2">Jelajahi program beasiswa yang tersedia</p>
    </div>

    <!-- Stats & Filter -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stats Cards -->
        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Program</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Aktif</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['aktif'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Ditutup</p>
                        <p class="text-2xl font-bold text-gray-600 mt-1">{{ $stats['ditutup'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <form method="GET" action="{{ route('umum.beasiswa') }}" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-sky-500 focus:border-sky-500">
                        <option value="">Semua</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="ditutup" {{ request('status') == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                    </select>
                </div>
                <button type="submit" class="w-full px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700 transition text-sm font-semibold">
                    Terapkan
                </button>
            </form>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <form method="GET" action="{{ route('umum.beasiswa') }}" class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari beasiswa..." class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-sky-500 focus:border-sky-500">
            <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
            </svg>
            <button type="submit" class="absolute right-2 top-2 px-4 py-1.5 bg-sky-600 text-white rounded-lg hover:bg-sky-700 transition text-sm font-semibold">
                Cari
            </button>
        </form>
    </div>

    <!-- Beasiswa Cards -->
    @if($beasiswas->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($beasiswas as $beasiswa)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition overflow-hidden">
                <!-- Header with Status Badge -->
                <div class="relative h-32 {{ $beasiswa->status == 'aktif' ? 'bg-gradient-to-br from-sky-400 to-cyan-500' : 'bg-gradient-to-br from-gray-400 to-gray-500' }} flex items-center justify-center">
                    <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                    </svg>
                    <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold {{ $beasiswa->status == 'aktif' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                        {{ ucfirst($beasiswa->status) }}
                    </span>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">{{ $beasiswa->nama_beasiswa }}</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $beasiswa->deskripsi }}</p>

                    <!-- Info Grid -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            <span class="text-gray-700">Kuota: <span class="font-semibold">{{ $beasiswa->kuota }}</span></span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">{{ \Carbon\Carbon::parse($beasiswa->tanggal_buka)->format('d M Y') }} - {{ \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('d M Y') }}</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('umum.beasiswa.detail', $beasiswa->id) }}" class="block w-full py-2.5 px-4 bg-sky-50 text-sky-600 text-center rounded-lg hover:bg-sky-100 transition font-semibold text-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($beasiswas->hasPages())
        <div class="flex justify-center">
            {{ $beasiswas->links() }}
        </div>
        @endif
    @else
        <div class="bg-white rounded-xl p-12 text-center border border-gray-200">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada beasiswa ditemukan</h3>
            <p class="text-gray-600">Coba ubah filter atau pencarian Anda</p>
        </div>
    @endif
</div>
@endsection
