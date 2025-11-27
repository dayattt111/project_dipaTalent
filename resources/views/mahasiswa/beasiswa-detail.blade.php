@extends('layouts.mahasiswa')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <a href="{{ route('mahasiswa.listBeasiswa') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mb-6 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
        </svg>
        Kembali ke Daftar Beasiswa
    </a>

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl text-white p-8 mb-8">
        <h1 class="text-4xl font-bold mb-3">{{ $beasiswa->nama_beasiswa }}</h1>
        <p class="text-lg text-blue-100">{{ $beasiswa->deskripsi }}</p>
    </div>

    <!-- Status Badge -->
    <div class="mb-6">
        @if($beasiswa->status === 'aktif')
            <span class="inline-block px-4 py-2 bg-green-100 text-green-800 font-bold rounded-full text-sm">
                ✓ Dibuka - Pendaftaran Aktif
            </span>
        @else
            <span class="inline-block px-4 py-2 bg-red-100 text-red-800 font-bold rounded-full text-sm">
                ✕ Ditutup - Tidak Menerima Pendaftar
            </span>
        @endif
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Umum -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Umum</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-blue-600">
                                <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Kuota Beasiswa</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $beasiswa->kuota }} Penerima</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-indigo-600">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Periode Pendaftaran</p>
                            <p class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($beasiswa->tanggal_mulai)->format('d M Y') }}</p>
                            <p class="text-gray-600 text-sm">hingga {{ \Carbon\Carbon::parse($beasiswa->tanggal_selesai)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-green-600">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Persyaratan Minimum</p>
                            <ul class="text-gray-900 space-y-1 mt-1">
                                <li class="text-sm">✓ IPK Minimal 2.50</li>
                                <li class="text-sm">✓ Semua Dokumen Lengkap</li>
                                <li class="text-sm">✓ Aktif Akademik</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Detail -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Program</h3>
                <p class="text-gray-600 leading-relaxed">{{ $beasiswa->deskripsi }}</p>
            </div>

            <!-- Dokumen yang Diperlukan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Dokumen yang Diperlukan</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="text-green-600 mt-0.5 flex-shrink-0">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Transkrip Nilai (PDF)</p>
                            <p class="text-sm text-gray-600">File asli atau fotokopi yang sudah dilegalisir</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="text-green-600 mt-0.5 flex-shrink-0">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Foto Diri (JPG/PNG)</p>
                            <p class="text-sm text-gray-600">Ukuran 4x6 cm atau digital clear</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="text-green-600 mt-0.5 flex-shrink-0">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Surat Pernyataan</p>
                            <p class="text-sm text-gray-600">Surat pernyataan bermaterai dan tanda tangan</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right Column - Action Card -->
        <div>
            <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-6 sticky top-8">
                <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-sm text-blue-800 font-medium mb-1">Status Pendaftaran</p>
                    @if($beasiswa->status === 'aktif')
                        <p class="text-lg font-bold text-green-600">✓ Dibuka</p>
                        <p class="text-xs text-gray-600 mt-1">Anda dapat mendaftar untuk program ini</p>
                    @else
                        <p class="text-lg font-bold text-red-600">✕ Ditutup</p>
                        <p class="text-xs text-gray-600 mt-1">Periode pendaftaran telah berakhir</p>
                    @endif
                </div>

                @if($beasiswa->status === 'aktif')
                    <a href="{{ route('mahasiswa.ajukanBeasiswa') }}?beasiswa_id={{ $beasiswa->id }}" class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-lg hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Ajukan Beasiswa
                    </a>
                    <a href="{{ route('mahasiswa.riwayatPendaftaran') }}" class="w-full mt-3 px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors text-center">
                        Lihat Status Pendaftaran
                    </a>
                @else
                    <button disabled class="w-full px-6 py-3 bg-gray-300 text-gray-500 font-bold rounded-lg cursor-not-allowed">
                        Periode Ditutup
                    </button>
                    <p class="text-xs text-gray-500 text-center mt-3">Tunggu periode pendaftaran berikutnya</p>
                @endif

                <!-- Info Box -->
                <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                    <p class="text-xs text-amber-800 font-medium">
                        <strong>💡 Tips:</strong> Pastikan semua dokumen Anda siap sebelum mengajukan. Proses verifikasi membutuhkan waktu 7-14 hari kerja.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
