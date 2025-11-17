@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Verifikasi Prestasi Mahasiswa</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Prestasi -->
    <button onclick="openAddModal()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded mb-4">
        Tambah Prestasi
    </button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-700">#</th>
                    <th class="px-4 py-2 text-left text-gray-700">Nama Mahasiswa</th>
                    <th class="px-4 py-2 text-left text-gray-700">Jenis</th>
                    <th class="px-4 py-2 text-left text-gray-700">Prestasi</th>
                    <th class="px-4 py-2 text-left text-gray-700">Tingkat</th>
                    <th class="px-4 py-2 text-left text-gray-700">Tahun</th>
                    <th class="px-4 py-2 text-left text-gray-700">Status</th>
                    <th class="px-4 py-2 text-left text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestasi as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $item->user->name }}</td>
                    <td class="px-4 py-2">{{ ucfirst($item->jenis) }}</td>
                    <td class="px-4 py-2">{{ $item->nama_prestasi }}</td>
                    <td class="px-4 py-2">{{ $item->tingkat ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $item->tahun ?? '-' }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded 
                            @if($item->status == 'valid') bg-green-200 text-green-800 
                            @elseif($item->status == 'invalid') bg-red-200 text-red-800 
                            @else bg-yellow-200 text-yellow-800 @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 space-x-2">
                        <!-- Lihat Dokumen -->
                        @if($item->file_sertifikat)
                        <button onclick="openModal('{{ route('admin.verifikasiPrestasi.bukti', $item->id) }}')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            Lihat Dokumen
                        </button>
                        @endif

                        <!-- Verifikasi / Edit Status -->
                        <button onclick="openEditModal({{ $item->id }}, '{{ $item->status }}')" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                            Verifikasi
                        </button>

                        <!-- Hapus -->
                        <form action="{{ route('admin.verifikasiPrestasi.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
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

<!-- Modal Dokumen -->
<div id="modalDokumen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-1/2 p-4 relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900">&times;</button>
        <iframe id="dokumenFrame" src="" class="w-full h-96 rounded" frameborder="0"></iframe>
    </div>
</div>

<!-- Modal Tambah Prestasi -->
<div id="modalAddPrestasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg w-11/12 md:w-1/2 p-6 relative">
        <button onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900">&times;</button>
        <h3 class="text-lg font-bold mb-4">Tambah Prestasi</h3>
        <form action="{{ route('admin.verifikasiPrestasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="block text-gray-700">Mahasiswa</label>
                <select name="user_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach(App\Models\User::all() as $user)
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
                <input type="number" name="tahun" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Upload Sertifikat (PDF / JPG / PNG)</label>
                <input type="file" name="file_sertifikat" class="w-full">
            </div>
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</div>

<!-- Modal Edit Status -->
<div id="modalEditPrestasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg w-11/12 md:w-1/3 p-6 relative">
        <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900">&times;</button>
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

// Tambah Prestasi
function openAddModal() {
    document.getElementById('modalAddPrestasi').classList.remove('hidden');
}
function closeAddModal() {
    document.getElementById('modalAddPrestasi').classList.add('hidden');
}

// Edit / Verifikasi
function openEditModal(id, status) {
    const form = document.getElementById('formEditPrestasi');
    form.action = '/admin/verifikasi-prestasi/' + id + '/status';
    form.status.value = status;
    document.getElementById('modalEditPrestasi').classList.remove('hidden');
}
function closeEditModal() {
    document.getElementById('modalEditPrestasi').classList.add('hidden');
}
</script>
@endsection
