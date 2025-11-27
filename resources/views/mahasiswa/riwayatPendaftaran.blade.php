@extends('layouts.mahasiswa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Riwayat Pendaftaran</h1>
            <p class="text-gray-600 mt-2">Lihat status dan riwayat pengajuan beasiswa Anda</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-blue-600">
                            <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Pengajuan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalPendaftaran }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-yellow-200 p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-yellow-600">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Menunggu Review</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pendingPendaftaran }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-green-200 p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-green-600">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Diterima</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $acceptedPendaftaran }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-red-200 p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-red-600">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M5.354 5.354a.5.5 0 1 0 .707.707L8 7.293l1.939-1.939a.5.5 0 1 0 .707-.707L8.707 8l1.939 1.939a.5.5 0 0 1-.707.707L8 8.707l-1.939 1.939a.5.5 0 0 1-.707-.707L7.293 8 5.354 6.061z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Ditolak</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $rejectedPendaftaran }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="mb-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex gap-4 flex-wrap">
                <select id="filterStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu Review</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
        </div>

        <!-- Pendaftaran Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">No</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Program Beasiswa</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">IPK</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Prestasi Akademik</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal Ajuan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pendaftarans as $index => $pendaftaran)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="font-medium text-gray-900">{{ $pendaftaran->beasiswa->nama_beasiswa ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $pendaftaran->beasiswa->deskripsi ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ number_format($pendaftaran->ipk ?? 0, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($pendaftaran->prestasi_akademik ?? '-', 30) }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($pendaftaran->status === 'menunggu')
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Menunggu</span>
                                @elseif($pendaftaran->status === 'diterima')
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Diterima</span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $pendaftaran->created_at->format('d M Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">
                                <button onclick="showDetail({{ $pendaftaran->id }})" class="text-indigo-600 hover:text-indigo-800 font-medium">Lihat Detail</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-300 mb-2">
                                    <path d="M8.5 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                </svg>
                                <p>Belum ada riwayat pengajuan beasiswa</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($pendaftarans->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $pendaftarans->links() }}
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="mt-8 flex gap-4 justify-center">
            <a href="{{ route('mahasiswa.listBeasiswa') }}" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                Ajukan Beasiswa Baru
            </a>
            <a href="{{ route('mahasiswa.dashboard') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<script>
function showDetail(id) {
    // Bisa di-expand untuk menampilkan modal atau redirect ke halaman detail
    console.log('Show detail for pendaftaran: ' + id);
}

document.getElementById('filterStatus').addEventListener('change', function() {
    // Implementasi filter jika diperlukan
    console.log('Filter: ' + this.value);
});
</script>
@endsection
