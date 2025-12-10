@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Verifikasi Pendaftaran Beasiswa</h1>
                    <p class="text-gray-600 mt-1">Review detail pendaftar dan kelayakan beasiswa</p>
                </div>
                <a href="{{ route('admin.verifikasiPendaftar.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Info -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 p-6 text-white">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center text-indigo-600 font-bold text-2xl">
                                    {{ strtoupper(substr($pendaftaran->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold">{{ $pendaftaran->user->name }}</h2>
                                    <p class="text-indigo-100 mt-1">NIM: {{ $pendaftaran->user->nim }}</p>
                                    <p class="text-indigo-100">{{ $pendaftaran->user->email }}</p>
                                    <div class="mt-3 inline-flex items-center px-3 py-1 bg-white bg-opacity-20 rounded-full text-sm">
                                        🎓 {{ $pendaftaran->beasiswa->nama_beasiswa }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ranking & Poin -->
                    <div class="p-6 bg-gradient-to-br from-gray-50 to-white">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white border-2 border-indigo-200 rounded-xl p-4 text-center">
                                <p class="text-sm text-gray-600 mb-2">Total Poin</p>
                                <p class="text-4xl font-bold text-indigo-600">{{ number_format($skorSaw->nilai_akhir ?? 0, 0) }}</p>
                                <p class="text-xs text-gray-500 mt-1">Akumulatif prestasi</p>
                            </div>
                            <div class="bg-white border-2 border-green-200 rounded-xl p-4 text-center">
                                <p class="text-sm text-gray-600 mb-2">Peringkat</p>
                                <p class="text-4xl font-bold text-green-600">#{{ $leaderboard->peringkat ?? '-' }}</p>
                                <p class="text-xs text-gray-500 mt-1">dari {{ \App\Models\User::where('role', 'mahasiswa')->count() }} mahasiswa</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Breakdown -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">📊 Rincian Pencapaian</h3>
                    
                    <!-- IPK -->
                    <div class="mb-4 pb-4 border-b">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">IPK Tervalidasi</p>
                                <p class="text-xs text-gray-500">Indeks Prestasi Kumulatif</p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($detailPoin['ipk'], 2) }}</p>
                                <p class="text-xs text-gray-500">dari 4.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Prestasi Akademik -->
                    <div class="mb-4 pb-4 border-b">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Prestasi Akademik</p>
                                <p class="text-xs text-gray-500">{{ $pendaftaran->user->prestasi()->valid()->akademik()->count() }} prestasi tervalidasi</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-green-600">{{ $detailPoin['prestasi_akademik'] }}</p>
                                <p class="text-xs text-gray-500">poin</p>
                            </div>
                        </div>
                        <button type="button" onclick="openModal('prestasiAkademik')" 
                                class="w-full px-4 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition text-sm font-medium">
                            Lihat Detail Prestasi Akademik →
                        </button>
                    </div>

                    <!-- Prestasi Non-Akademik -->
                    <div class="mb-4 pb-4 border-b">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Prestasi Non-Akademik</p>
                                <p class="text-xs text-gray-500">{{ $pendaftaran->user->prestasi()->valid()->nonAkademik()->count() }} prestasi tervalidasi</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-blue-600">{{ $detailPoin['prestasi_non_akademik'] }}</p>
                                <p class="text-xs text-gray-500">poin</p>
                            </div>
                        </div>
                        <button type="button" onclick="openModal('prestasiNonAkademik')" 
                                class="w-full px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition text-sm font-medium">
                            Lihat Detail Prestasi Non-Akademik →
                        </button>
                    </div>

                    <!-- Organisasi -->
                    <div class="mb-4 pb-4 border-b">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Organisasi</p>
                                <p class="text-xs text-gray-500">{{ $detailPoin['organisasi'] }} organisasi aktif</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-purple-600">{{ $detailPoin['organisasi'] }}</p>
                                <p class="text-xs text-gray-500">organisasi</p>
                            </div>
                        </div>
                        <button type="button" onclick="openModal('organisasi')" 
                                class="w-full px-4 py-2 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition text-sm font-medium">
                            Lihat Detail Organisasi →
                        </button>
                    </div>

                    <!-- Sertifikasi -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Sertifikasi & Pelatihan</p>
                                <p class="text-xs text-gray-500">{{ $pendaftaran->user->sertifikasi()->valid()->count() }} sertifikat tervalidasi</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-indigo-600">{{ $detailPoin['sertifikasi'] }}</p>
                                <p class="text-xs text-gray-500">poin</p>
                            </div>
                        </div>
                        <button type="button" onclick="openModal('sertifikasi')" 
                                class="w-full px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition text-sm font-medium">
                            Lihat Detail Sertifikasi →
                        </button>
                    </div>
                </div>

                <!-- Dokumen Transkrip -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">📄 Dokumen Pendukung</h3>
                    <div class="space-y-3">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Transkrip Nilai</p>
                                        <p class="text-xs text-gray-500">Dokumen resmi IPK</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button type="button" onclick="openModal('transkrip')" 
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                                        Review
                                    </button>
                                    <a href="{{ asset('storage/'.$pendaftaran->transkrip) }}" target="_blank" download
                                       class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition text-sm font-medium">
                                        Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column - Action -->
            <div class="lg:col-span-1">
                <form method="POST" action="{{ route('admin.verifikasiPendaftar.verifikasi', $pendaftaran->id) }}" class="space-y-6">
                    @csrf

                    <!-- Status Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">⚡ Tindakan Verifikasi</h3>
                        
                        <div class="space-y-4">
                            <!-- Catatan Admin -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Admin</label>
                                <textarea name="catatan_admin" rows="4"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                          placeholder="Tambahkan catatan untuk mahasiswa...">{{ old('catatan_admin', $pendaftaran->catatan_admin) }}</textarea>
                            </div>

                            <input type="hidden" name="status" value="setujui">

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <button type="submit" 
                                        class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition shadow-md hover:shadow-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Setujui Pendaftaran
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Info -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-900 mb-2">ℹ️ Info</h4>
                        <p class="text-sm text-blue-800">Pastikan semua data sudah sesuai sebelum menyetujui. Poin dan peringkat dihitung otomatis oleh sistem.</p>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal Prestasi Akademik -->
<div id="modalPrestasiAkademik" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-t-xl sticky top-0">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white">🏆 Prestasi Akademik</h3>
                <button onclick="closeModal('prestasiAkademik')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            @php
                $prestasiAkademik = $pendaftaran->user->prestasi()->valid()->akademik()->get();
            @endphp
            @if($prestasiAkademik->count() > 0)
                <div class="space-y-4">
                    @foreach($prestasiAkademik as $prestasi)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-gray-900">{{ $prestasi->nama_prestasi }}</h4>
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                    {{ $prestasi->poin }} poin
                                </span>
                            </div>
                            <div class="space-y-1 text-sm">
                                <p class="text-gray-600"><span class="font-medium">Tingkat:</span> {{ ucfirst($prestasi->tingkat) }}</p>
                                <p class="text-gray-600"><span class="font-medium">Tahun:</span> {{ $prestasi->tahun }}</p>
                                @if($prestasi->penyelenggara)
                                    <p class="text-gray-600"><span class="font-medium">Penyelenggara:</span> {{ $prestasi->penyelenggara }}</p>
                                @endif
                                @if($prestasi->deskripsi)
                                    <p class="text-gray-600 mt-2">{{ $prestasi->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Belum ada prestasi akademik</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal Prestasi Non-Akademik -->
<div id="modalPrestasiNonAkademik" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-t-xl sticky top-0">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white">🎨 Prestasi Non-Akademik</h3>
                <button onclick="closeModal('prestasiNonAkademik')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            @php
                $prestasiNonAkademik = $pendaftaran->user->prestasi()->valid()->nonAkademik()->get();
            @endphp
            @if($prestasiNonAkademik->count() > 0)
                <div class="space-y-4">
                    @foreach($prestasiNonAkademik as $prestasi)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-gray-900">{{ $prestasi->nama_prestasi }}</h4>
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">
                                    {{ $prestasi->poin }} poin
                                </span>
                            </div>
                            <div class="space-y-1 text-sm">
                                <p class="text-gray-600"><span class="font-medium">Tingkat:</span> {{ ucfirst($prestasi->tingkat) }}</p>
                                <p class="text-gray-600"><span class="font-medium">Tahun:</span> {{ $prestasi->tahun }}</p>
                                @if($prestasi->penyelenggara)
                                    <p class="text-gray-600"><span class="font-medium">Penyelenggara:</span> {{ $prestasi->penyelenggara }}</p>
                                @endif
                                @if($prestasi->deskripsi)
                                    <p class="text-gray-600 mt-2">{{ $prestasi->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Belum ada prestasi non-akademik</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal Organisasi -->
<div id="modalOrganisasi" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-t-xl sticky top-0">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white">👥 Pengalaman Organisasi</h3>
                <button onclick="closeModal('organisasi')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            @php
                $organisasi = $pendaftaran->user->organisasi()->valid()->get();
            @endphp
            @if($organisasi->count() > 0)
                <div class="space-y-4">
                    @foreach($organisasi as $org)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $org->nama_organisasi }}</h4>
                                    <p class="text-sm text-purple-600 font-medium">{{ $org->jabatan }}</p>
                                </div>
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold">
                                    {{ $org->poin }} poin
                                </span>
                            </div>
                            <div class="space-y-1 text-sm">
                                <p class="text-gray-600"><span class="font-medium">Periode:</span> {{ $org->periode }}</p>
                                @if($org->deskripsi)
                                    <p class="text-gray-600 mt-2">{{ $org->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Belum ada pengalaman organisasi</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal Sertifikasi -->
<div id="modalSertifikasi" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-6 rounded-t-xl sticky top-0">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white">📜 Sertifikasi & Pelatihan</h3>
                <button onclick="closeModal('sertifikasi')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            @php
                $sertifikasi = $pendaftaran->user->sertifikasi()->valid()->get();
            @endphp
            @if($sertifikasi->count() > 0)
                <div class="space-y-4">
                    @foreach($sertifikasi as $sert)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $sert->nama_sertifikat }}</h4>
                                    <p class="text-sm text-indigo-600 font-medium">{{ $sert->penerbit }}</p>
                                </div>
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-bold">
                                    {{ $sert->poin }} poin
                                </span>
                            </div>
                            <div class="space-y-1 text-sm">
                                <p class="text-gray-600"><span class="font-medium">Jenis:</span> {{ ucfirst($sert->jenis) }}</p>
                                @if($sert->nomor_sertifikat)
                                    <p class="text-gray-600"><span class="font-medium">Nomor:</span> {{ $sert->nomor_sertifikat }}</p>
                                @endif
                                <p class="text-gray-600"><span class="font-medium">Tanggal Terbit:</span> {{ \Carbon\Carbon::parse($sert->tanggal_terbit)->format('d M Y') }}</p>
                                @if($sert->tanggal_expired)
                                    <p class="text-gray-600"><span class="font-medium">Berlaku Hingga:</span> {{ \Carbon\Carbon::parse($sert->tanggal_expired)->format('d M Y') }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Belum ada sertifikasi</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal Transkrip -->
<div id="modalTranskrip" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-5xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 rounded-t-xl sticky top-0">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white">📄 Review Transkrip Nilai</h3>
                <button onclick="closeModal('transkrip')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <iframe src="{{ asset('storage/'.$pendaftaran->transkrip) }}" 
                    class="w-full h-[600px] border border-gray-300 rounded-lg"></iframe>
            <div class="mt-4 flex justify-end">
                <a href="{{ asset('storage/'.$pendaftaran->transkrip) }}" target="_blank" download
                   class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                    Download Transkrip
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(type) {
    const modalMap = {
        'prestasiAkademik': 'modalPrestasiAkademik',
        'prestasiNonAkademik': 'modalPrestasiNonAkademik',
        'organisasi': 'modalOrganisasi',
        'sertifikasi': 'modalSertifikasi',
        'transkrip': 'modalTranskrip'
    };
    
    const modalId = modalMap[type];
    if (modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.getElementById(modalId).classList.add('flex');
    }
}

function closeModal(type) {
    const modalMap = {
        'prestasiAkademik': 'modalPrestasiAkademik',
        'prestasiNonAkademik': 'modalPrestasiNonAkademik',
        'organisasi': 'modalOrganisasi',
        'sertifikasi': 'modalSertifikasi',
        'transkrip': 'modalTranskrip'
    };
    
    const modalId = modalMap[type];
    if (modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.getElementById(modalId).classList.remove('flex');
    }
}

// Close modal on outside click
document.querySelectorAll('[id^="modal"]').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            this.classList.remove('flex');
        }
    });
});
</script>

@endsection
