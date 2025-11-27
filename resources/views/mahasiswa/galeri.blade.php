@extends('layouts.mahasiswa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Galeri Prestasi</h1>
            <p class="text-gray-600 mt-2">Lihat prestasi dan pencapaian mahasiswa terbaik dari komunitas DipaTalent</p>
        </div>

        <!-- Filter -->
        <div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Prestasi</label>
                    <input type="text" id="search" placeholder="Ketikkan nama prestasi..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
                    <select id="jenis" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Jenis</option>
                        <option value="akademik">Akademik</option>
                        <option value="non_akademik">Non-Akademik</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="resetFilters()" class="w-full px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors">Reset Filter</button>
                </div>
            </div>
        </div>

        <!-- Galeri Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($galeri as $prestasi)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow prestasi-card" data-jenis="{{ $prestasi->jenis }}" data-nama="{{ strtolower($prestasi->nama_prestasi) }}">
                <!-- Image Section -->
                <div class="relative bg-gradient-to-br from-blue-400 to-indigo-600 h-48 overflow-hidden flex items-center justify-center">
                    @if($prestasi->galeri_path)
                        <img src="{{ Storage::url($prestasi->galeri_path) }}" alt="{{ $prestasi->nama_prestasi }}" class="w-full h-full object-cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16" class="text-white opacity-30">
                            <path d="M.5 1a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h15a.5.5 0 0 0 .5-.5V1.5a.5.5 0 0 0-.5-.5H.5zm1 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                            <path d="m3 5 2-2 3 3-2 5 3-1 2-6 3 1v5l-6-1-4-5z"/>
                        </svg>
                    @endif
                    <!-- Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="inline-block px-3 py-1 bg-white bg-opacity-90 text-indigo-600 text-xs font-bold rounded-full">
                            {{ ucwords(str_replace('_', ' ', $prestasi->tingkat)) }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 space-y-3">
                    <!-- Nama Prestasi -->
                    <h3 class="text-lg font-bold text-gray-900 line-clamp-2">{{ $prestasi->nama_prestasi }}</h3>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-600 text-xs">Oleh</p>
                            <p class="font-semibold text-gray-900">{{ $prestasi->user->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs">Jenis</p>
                            <p class="font-semibold text-gray-900">{{ ucwords(str_replace('_', ' ', $prestasi->jenis)) }}</p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <p class="text-sm text-gray-600 line-clamp-2">{{ $prestasi->deskripsi }}</p>

                    <!-- Details -->
                    <div class="space-y-2 text-sm border-t border-gray-200 pt-3">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="text-gray-400">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="text-gray-600">{{ \Carbon\Carbon::parse($prestasi->tanggal_pencapaian)->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="text-gray-400">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M6.5 6a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-5a.5.5 0 0 0-.5-.5H6.5z"/>
                            </svg>
                            <span class="text-gray-600">{{ $prestasi->penyelenggara }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
                    <button onclick="openModal({{ $prestasi->id }})" class="w-full px-4 py-2 text-center bg-indigo-50 text-indigo-600 font-medium rounded-lg hover:bg-indigo-100 transition-colors">
                        Lihat Detail
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-300 mb-4">
                    <path d="M8.5 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada prestasi di galeri</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($galeri->hasPages())
        <div class="mb-12 flex justify-center">
            {{ $galeri->links() }}
        </div>
        @endif

        <!-- Info Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-blue-600">
                            <path d="M4 6a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3 7h8v-1c0-1-1-4-5-4H2c-4 0-5 3-5 4v1h4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Inspirasi Bersama</h3>
                        <p class="text-sm text-gray-600">Lihat prestasi mahasiswa lain dan dapatkan inspirasi untuk mencapai lebih tinggi</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-yellow-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-yellow-600">
                            <path d="M3 13v1h10v-1H3zm7-8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm4.95 7H4.05a.75.75 0 0 0-.75.75v.5c0 .896.56 1.748 1.45 2.104C5.697 15.868 7.519 16 8 16c.481 0 2.303-.132 3.437-.75.89-.356 1.45-1.208 1.45-2.104v-.5a.75.75 0 0 0-.75-.75z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Berbagi Kesuksesan</h3>
                        <p class="text-sm text-gray-600">Bagikan prestasi Anda dan motivasi komunitas untuk terus berkembang</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-purple-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-purple-600">
                            <path d="M2.5 1A1.5 1.5 0 0 0 1 2.5v11A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 13.5 1h-11zM2 2.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11z"/>
                            <path d="M2 5.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3zm6-1a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Apresiasi Nyata</h3>
                        <p class="text-sm text-gray-600">Prestasi dirayakan dalam komunitas dan dapat meningkatkan peluang mendapat beasiswa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full max-h-96 overflow-y-auto">
        <div id="modalContent" class="p-6">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('jenis').value = '';
    filterCards();
}

function filterCards() {
    const searchInput = document.getElementById('search').value.toLowerCase();
    const jenisInput = document.getElementById('jenis').value;
    const cards = document.querySelectorAll('.prestasi-card');

    cards.forEach(card => {
        const nama = card.dataset.nama;
        const jenis = card.dataset.jenis;
        
        const matchSearch = nama.includes(searchInput);
        const matchJenis = jenisInput === '' || jenis === jenisInput;
        
        card.style.display = (matchSearch && matchJenis) ? 'block' : 'none';
    });
}

function openModal(id) {
    // Bisa di-implementasikan untuk menampilkan detail prestasi
    console.log('Open modal for prestasi: ' + id);
    // Untuk sekarang, buka di tab baru atau redirect
}

function closeModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

document.getElementById('search').addEventListener('keyup', filterCards);
document.getElementById('jenis').addEventListener('change', filterCards);

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection
