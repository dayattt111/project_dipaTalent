@extends('layouts.umum')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('umum.beasiswa') }}" class="inline-flex items-center text-sky-600 hover:text-sky-700 font-semibold">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Kembali ke Daftar Beasiswa
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Header Card -->
            <div class="bg-gradient-to-br from-sky-400 to-cyan-500 rounded-2xl p-8 text-white shadow-lg">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $beasiswa->status == 'aktif' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }} mb-3">
                            {{ ucfirst($beasiswa->status) }}
                        </span>
                        <h1 class="text-3xl font-bold mb-2">{{ $beasiswa->nama_beasiswa }}</h1>
                        <p class="text-sky-100 text-sm">{{ $beasiswa->deskripsi }}</p>
                    </div>
                    <div class="ml-4">
                        <svg class="w-20 h-20 text-white opacity-30" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Detail Sections -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm divide-y divide-gray-200">
                <!-- Periode -->
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        Periode Pendaftaran
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-sky-50 rounded-lg p-4">
                            <p class="text-xs text-gray-600 mb-1">Tanggal Buka</p>
                            <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($beasiswa->tanggal_buka)->format('d F Y') }}</p>
                        </div>
                        <div class="bg-sky-50 rounded-lg p-4">
                            <p class="text-xs text-gray-600 mb-1">Tanggal Tutup</p>
                            <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Persyaratan -->
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                        </svg>
                        Persyaratan
                    </h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($beasiswa->persyaratan)) !!}
                    </div>
                </div>

                <!-- Kriteria -->
                @if($beasiswa->kriteria)
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Kriteria Penilaian
                    </h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($beasiswa->kriteria)) !!}
                    </div>
                </div>
                @endif

                <!-- Benefit -->
                @if($beasiswa->benefit)
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Manfaat
                    </h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($beasiswa->benefit)) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Stats Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Total Kuota</p>
                                <p class="text-xl font-bold text-gray-900">{{ $beasiswa->kuota }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Diterima</p>
                                <p class="text-xl font-bold text-green-600">{{ $acceptedCount }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Sisa Kuota</p>
                                <p class="text-xl font-bold text-blue-600">{{ $beasiswa->kuota - $acceptedCount }}</p>
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
                        <h4 class="font-bold text-gray-900 mb-2">Informasi</h4>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Anda saat ini masuk sebagai <strong>Pengunjung</strong>. Untuk mengajukan beasiswa, silakan login sebagai mahasiswa.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Tautan Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('umum.beasiswa') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition group">
                        <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center group-hover:bg-sky-200 transition">
                            <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-900 group-hover:text-sky-600 transition">Daftar Beasiswa</span>
                    </a>
                    <a href="{{ route('umum.leaderboard') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition group">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:bg-yellow-200 transition">
                            <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-900 group-hover:text-sky-600 transition">Leaderboard</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
