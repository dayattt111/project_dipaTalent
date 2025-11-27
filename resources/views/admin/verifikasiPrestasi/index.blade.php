@extends('layouts.admin')

@section('title', 'Verifikasi Prestasi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Verifikasi Prestasi</h1>
            <p class="text-gray-600 mt-1">Verifikasi prestasi dan pencapaian mahasiswa</p>
        </div>
        <button onclick="openAddModal()" class="mt-4 md:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Tambah Prestasi
        </button>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- Table Card --}}
    @if(count($prestasi) > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Mahasiswa</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Jenis</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Prestasi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tingkat</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tahun</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($prestasi as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($item->jenis ?? '-') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->nama_prestasi ?? $item->judul ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->tingkat ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->tahun ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                {{ $item->status === 'valid' ? 'bg-green-100 text-green-800' : 
                                   ($item->status === 'invalid' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($item->status ?? 'menunggu') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            @if($item->file_sertifikat)
                            <button onclick="openModal('{{ route('admin.verifikasiPrestasi.bukti', $item->id) }}')" 
                                class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 hover:bg-blue-200 rounded-lg text-xs font-medium transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5H1.5zM0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v12a1.5 1.5 0 0 1-1.5 1.5H1.5A1.5 1.5 0 0 1 0 13.5v-12z"/>
                                </svg>
                                Dokumen
                            </button>
                            @endif

                            <button onclick="openEditModal({{ $item->id }}, '{{ $item->status }}')" 
                                class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 hover:bg-green-200 rounded-lg text-xs font-medium transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10.5 10.5a.5.5 0 0 1-.168.11l-5 1.667a.5.5 0 0 1-.65-.65l1.667-5a.5.5 0 0 1 .11-.168l10.5-10.5z"/>
                                </svg>
                                Verifikasi
                            </button>

                            <form action="{{ route('admin.verifikasiPrestasi.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 hover:bg-red-200 rounded-lg text-xs font-medium transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V11a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Empty State --}}
    @if(count($prestasi) === 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-400 mb-3">
            <path d="M6.5 0a.5.5 0 0 0 0 1H7v5H.5a.5.5 0 0 0 0 1H7v2H.5a.5.5 0 0 0 0 1H7v4.5a.5.5 0 0 0 1 0V7h5v4.5a.5.5 0 0 0 1 0V7h5.5a.5.5 0 0 0 0-1H13V6h3.5a.5.5 0 0 0 0-1H13V0h-1v5H7V0H6.5z"/>
        </svg>
        <p class="text-gray-600">Tidak ada prestasi untuk diverifikasi</p>
    </div>
    @endif
</div>

<!-- Modal Dokumen -->
<div id="modalDokumen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-1/2 p-4 relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl font-bold">&times;</button>
        <iframe id="dokumenFrame" src="" class="w-full h-96 rounded" frameborder="0"></iframe>
    </div>
</div>

<!-- Modal Tambah Prestasi -->
<div id="modalAddPrestasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg w-11/12 md:w-1/2 p-6 relative">
        <button onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl font-bold">&times;</button>
        <h3 class="text-lg font-bold mb-4">Tambah Prestasi</h3>
        <form action="{{ route('admin.verifikasiPrestasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="block text-gray-700">Mahasiswa</label>
                <select name="user_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach(App\Models\User::where('role', 'mahasiswa')->get() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Jenis Prestasi</label>
                <select name="jenis" class="w-full border px-3 py-2 rounded" required>
                    <option value="akademik">Akademik</option>
                    <option value="non-akademik">Non-Akademik</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Nama Prestasi</label>
                <input type="text" name="nama_prestasi" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Tingkat</label>
                <input type="text" name="tingkat" class="w-full border px-3 py-2 rounded" placeholder="Lokal / Nasional / Internasional">
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Tahun</label>
                <input type="number" name="tahun" min="1900" max="{{ date('Y') }}" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Upload Sertifikat (PDF / JPG / PNG)</label>
                <input type="file" name="file_sertifikat" class="w-full" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</div>

<!-- Modal Edit Status -->
<div id="modalEditPrestasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg w-11/12 md:w-1/3 p-6 relative">
        <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl font-bold">&times;</button>
        <h3 class="text-lg font-bold mb-4">Verifikasi Prestasi</h3>
        <form id="formEditPrestasi" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="block text-gray-700">Status</label>
                <select name="status" class="w-full border px-3 py-2 rounded" required>
                    <option value="menunggu">Menunggu</option>
                    <option value="valid">Valid</option>
                    <option value="invalid">Invalid</option>
                </select>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</div>

<script>
function openModal(url) {
    document.getElementById('dokumenFrame').src = url;
    document.getElementById('modalDokumen').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modalDokumen').classList.add('hidden');
    document.getElementById('dokumenFrame').src = '';
}

function openAddModal() {
    document.getElementById('modalAddPrestasi').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('modalAddPrestasi').classList.add('hidden');
}

function openEditModal(id, status) {
    const form = document.getElementById('formEditPrestasi');
    form.action = '/admin/verifikasi-prestasi/' + id + '/update-status';
    form.querySelector('select[name="status"]').value = status;
    document.getElementById('modalEditPrestasi').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('modalEditPrestasi').classList.add('hidden');
}
</script>
@endsection