@extends('layouts.admin')

@section('title', 'Verifikasi Prestasi - ' . $prestasi->nama_prestasi)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ route('admin.verifikasiPrestasi.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Verifikasi Prestasi</h1>
        <p class="text-gray-600 mt-1">Review detail prestasi mahasiswa sebelum verifikasi</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column - Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Profile Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8 text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                            <p class="text-indigo-100">NIM: {{ $user->nim }}</p>
                            <p class="text-indigo-100">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-indigo-50 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold text-indigo-600">{{ $skorSaw->nilai_akhir ?? 0 }}</div>
                            <div class="text-sm text-gray-600 mt-1">Total Poin</div>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold text-purple-600">#{{ $leaderboard->peringkat ?? '-' }}</div>
                            <div class="text-sm text-gray-600 mt-1">Peringkat</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Prestasi Detail Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-teal-600 px-6 py-4 text-white">
                    <h3 class="text-xl font-bold">Detail Prestasi yang Diajukan</h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Prestasi</label>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $prestasi->nama_prestasi }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jenis</label>
                            <p class="text-gray-900 mt-1">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $prestasi->jenis === 'akademik' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($prestasi->jenis) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tingkat</label>
                            <p class="text-gray-900 mt-1">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    {{ ucfirst($prestasi->tingkat ?? '-') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tahun</label>
                            <p class="text-gray-900 mt-1">{{ $prestasi->tahun ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Poin yang Didapat</label>
                            <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $prestasi->poin }} Poin</p>
                        </div>
                    </div>

                    @if($prestasi->tanggal_pencapaian)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tanggal Pencapaian</label>
                        <p class="text-gray-900 mt-1">{{ \Carbon\Carbon::parse($prestasi->tanggal_pencapaian)->format('d M Y') }}</p>
                    </div>
                    @endif

                    @if($prestasi->penyelenggara)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Penyelenggara</label>
                        <p class="text-gray-900 mt-1">{{ $prestasi->penyelenggara }}</p>
                    </div>
                    @endif

                    @if($prestasi->deskripsi)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                        <p class="text-gray-900 mt-1 text-sm leading-relaxed">{{ $prestasi->deskripsi }}</p>
                    </div>
                    @endif

                    <div>
                        <label class="text-sm font-medium text-gray-500">Status Saat Ini</label>
                        <p class="mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $prestasi->status === 'valid' ? 'bg-green-100 text-green-800' : 
                                   ($prestasi->status === 'invalid' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($prestasi->status) }}
                            </span>
                        </p>
                    </div>

                    @if($prestasi->catatan_admin)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Catatan Admin Sebelumnya</label>
                        <div class="mt-1 p-3 bg-gray-50 rounded-lg text-sm text-gray-700">
                            {{ $prestasi->catatan_admin }}
                        </div>
                    </div>
                    @endif

                    {{-- Document Preview --}}
                    @if($prestasi->file_sertifikat)
                    <div>
                        <label class="text-sm font-medium text-gray-500 block mb-2">Dokumen Sertifikat</label>
                        <div class="flex gap-2">
                            <button type="button" onclick="openModalPreview('{{ route('admin.verifikasiPrestasi.bukti', $prestasi->id) }}')" 
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M2 4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4zm10-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z"/>
                                </svg>
                                Preview Dokumen
                            </button>
                            <a href="{{ route('admin.verifikasiPrestasi.bukti', $prestasi->id) }}" target="_blank" download
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Other Prestasi from Same User --}}
            @if($prestasiLainnya->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-600 to-orange-600 px-6 py-4 text-white">
                    <h3 class="text-xl font-bold">Prestasi Lain dari Mahasiswa Ini</h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($prestasiLainnya as $item)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">{{ $item->nama_prestasi }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ ucfirst($item->jenis) }} • {{ ucfirst($item->tingkat) }} • {{ $item->tahun }}
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-bold text-indigo-600">{{ $item->poin }} poin</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Right Column - Action Panel --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4 text-white">
                    <h3 class="text-xl font-bold">Panel Verifikasi</h3>
                </div>
                
                <form action="{{ route('admin.verifikasiPrestasi.updateStatus', $prestasi->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Statistics Summary --}}
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg p-4 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Total Prestasi Valid</span>
                            <span class="font-bold text-gray-900">{{ $totalPrestasi }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Prestasi Akademik</span>
                            <span class="font-bold text-blue-600">{{ $totalPrestasiAkademik }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Prestasi Non-Akademik</span>
                            <span class="font-bold text-green-600">{{ $totalPrestasiNonAkademik }}</span>
                        </div>
                        <hr class="border-gray-300">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-700">IPK Mahasiswa</span>
                            <span class="font-bold text-indigo-600">{{ $user->ipk ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Status Selection --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Verifikasi</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="menunggu" {{ $prestasi->status=='menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="valid" {{ $prestasi->status=='valid' ? 'selected' : '' }}>Valid ✓</option>
                            <option value="invalid" {{ $prestasi->status=='invalid' ? 'selected' : '' }}>Invalid ✗</option>
                        </select>
                    </div>

                    {{-- Admin Notes --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                        <textarea name="catatan_admin" rows="4" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            placeholder="Berikan catatan atau alasan verifikasi...">{{ old('catatan_admin', $prestasi->catatan_admin ?? '') }}</textarea>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                        Simpan Verifikasi
                    </button>

                    {{-- Info Box --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="text-blue-600 flex-shrink-0">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </svg>
                            <div class="text-xs text-blue-800">
                                <p class="font-semibold mb-1">Catatan Penting:</p>
                                <p>Setelah verifikasi valid, sistem SAW akan otomatis diperbarui dan peringkat mahasiswa akan di-recalculate.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Preview Document --}}
<div id="modalPreview" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50" onclick="closeModalPreview()">
    <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-2/3 max-h-[90vh] flex flex-col" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-t-lg">
            <h3 class="text-lg font-bold">Preview Dokumen Sertifikat</h3>
            <button onclick="closeModalPreview()" class="text-white hover:text-gray-200 text-2xl font-bold">&times;</button>
        </div>
        <div class="flex-1 overflow-hidden">
            <iframe id="previewFrame" src="" class="w-full h-full" frameborder="0"></iframe>
        </div>
    </div>
</div>

<script>
function openModalPreview(url) {
    document.getElementById('previewFrame').src = url;
    document.getElementById('modalPreview').classList.remove('hidden');
}

function closeModalPreview() {
    document.getElementById('modalPreview').classList.add('hidden');
    document.getElementById('previewFrame').src = '';
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModalPreview();
    }
});
</script>

@endsection
