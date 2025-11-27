@extends('layouts.mahasiswa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Daftar Beasiswa</h1>
            <p class="text-gray-600 mt-2">Lihat semua program beasiswa yang tersedia dan pilih yang paling sesuai dengan Anda</p>
        </div>

        <!-- Filter & Search -->
        <div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Beasiswa</label>
                    <input type="text" id="search" placeholder="Ketikkan nama beasiswa..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="ditutup">Ditutup</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="resetFilters()" class="w-full px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors">Reset Filter</button>
                </div>
            </div>
        </div>

        <!-- Beasiswa Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($beasiswas as $beasiswa)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow beasiswa-card" data-status="{{ $beasiswa->status }}" data-nama="{{ strtolower($beasiswa->nama_beasiswa) }}">
                <!-- Header Card -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">{{ $beasiswa->nama_beasiswa }}</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-block px-3 py-1 bg-white bg-opacity-20 text-white text-xs font-semibold rounded-full">
                            {{ ucfirst($beasiswa->status) }}
                        </span>
                        @if($beasiswa->status === 'aktif')
                            <span class="inline-block w-2 h-2 bg-green-400 rounded-full"></span>
                        @endif
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 space-y-4">
                    <!-- Deskripsi -->
                    <div>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $beasiswa->deskripsi }}</p>
                    </div>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 mb-1">Kuota Tersedia</p>
                            <p class="text-lg font-bold text-blue-600">{{ $beasiswa->kuota }}</p>
                        </div>
                        <div class="bg-indigo-50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 mb-1">Nomor Beasiswa</p>
                            <p class="text-lg font-bold text-indigo-600">#{{ str_pad($beasiswa->id, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>

                    <!-- Details List -->
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="text-blue-600 mt-0.5 flex-shrink-0">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="text-gray-700">Jenis: <strong>{{ ucwords(str_replace('_', ' ', $beasiswa->kategori ?? 'Umum')) }}</strong></span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="text-green-600 mt-0.5 flex-shrink-0">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022l-3.477 2.905-2.068-2.323a.75.75 0 0 0-1.085.002l-.001.001a.75.75 0 0 0 .171 1.08l2.540 2.882 3.900-3.256a.75.75 0 0 0-.936-1.137L5.5 9.236l2.428 2.428 3.35-3.365a.75.75 0 1 0-1.06-1.06l-2.395 2.465-2.889-2.889a.75.75 0 1 0-1.061 1.061l2.889 2.889-3.183 2.652a.75.75 0 1 0 .976 1.138l3.183-2.652 3.477-2.905a.75.75 0 0 0 .02-1.102z"/>
                            </svg>
                            <span class="text-gray-700">Persyaratan: IPK, Prestasi, Dokumen</span>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex gap-2">
                    <a href="{{ route('mahasiswa.beasiswa.detail', $beasiswa->id) }}" class="flex-1 px-4 py-2 text-center bg-blue-50 text-blue-600 font-medium rounded-lg hover:bg-blue-100 transition-colors">
                        Lihat Detail
                    </a>
                    @if($beasiswa->status === 'aktif')
                        <a href="{{ route('mahasiswa.ajukanBeasiswa') }}?beasiswa={{ $beasiswa->id }}" class="flex-1 px-4 py-2 text-center bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                            Ajukan
                        </a>
                    @else
                        <button disabled class="flex-1 px-4 py-2 text-center bg-gray-300 text-gray-500 font-medium rounded-lg cursor-not-allowed">
                            Ditutup
                        </button>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-300 mb-4">
                    <path d="M8.5 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada program beasiswa yang tersedia</p>
            </div>
            @endforelse
        </div>

        <!-- Info Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-blue-600">
                            <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Program Beragam</h3>
                        <p class="text-sm text-gray-600">Berbagai program beasiswa tersedia untuk berbagai kriteria dan kebutuhan</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-green-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-green-600">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Proses Mudah</h3>
                        <p class="text-sm text-gray-600">Proses pengajuan yang sederhana dan transparan dengan penilaian yang adil</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-purple-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-purple-600">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.5-6a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Dukungan Penuh</h3>
                        <p class="text-sm text-gray-600">Tim support siap membantu menjawab pertanyaan Anda kapan saja</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('status').value = '';
    filterCards();
}

function filterCards() {
    const searchInput = document.getElementById('search').value.toLowerCase();
    const statusInput = document.getElementById('status').value;
    const cards = document.querySelectorAll('.beasiswa-card');

    cards.forEach(card => {
        const nama = card.dataset.nama;
        const status = card.dataset.status;
        
        const matchSearch = nama.includes(searchInput);
        const matchStatus = statusInput === '' || status === statusInput;
        
        card.style.display = (matchSearch && matchStatus) ? 'block' : 'none';
    });
}

document.getElementById('search').addEventListener('keyup', filterCards);
document.getElementById('status').addEventListener('change', filterCards);
</script>
@endsection
