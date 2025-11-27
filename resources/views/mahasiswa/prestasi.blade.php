@extends('layouts.mahasiswa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Kelola Prestasi</h1>
            <p class="text-gray-600 mt-2">Tambahkan dan kelola prestasi akademik dan non-akademik Anda</p>
        </div>

        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-6">
            <div class="flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-red-600 flex-shrink-0 mt-0.5">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0l-5.708 9.7a1.13 1.13 0 0 0 .98 1.734h11.396a1.13 1.13 0 0 0 .98-1.734l-5.707-9.7zM8 5a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 5zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-red-800 mb-2">Terjadi Kesalahan</h3>
                    <ul class="text-red-700 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-6">
            <div class="flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="text-green-600 flex-shrink-0 mt-0.5">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-green-800">{{ session('success') }}</h3>
                </div>
            </div>
        </div>
        @endif

        <!-- Tabs -->
        <div class="mb-6 flex gap-2 border-b border-gray-200">
            <button onclick="showTab('add')" id="tabAdd" class="px-6 py-3 font-medium text-indigo-600 border-b-2 border-indigo-600">+ Tambah Prestasi</button>
            <button onclick="showTab('list')" id="tabList" class="px-6 py-3 font-medium text-gray-600 border-b-2 border-transparent hover:text-gray-900">Daftar Prestasi Saya</button>
        </div>

        <!-- Add Prestasi Tab -->
        <div id="addTab" class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <form action="{{ route('mahasiswa.prestasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Prestasi <span class="text-red-500">*</span></label>
                        <select id="jenis" name="jenis" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('jenis') ? 'border-red-500' : '' }}">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="akademik">Akademik</option>
                            <option value="non_akademik">Non-Akademik</option>
                        </select>
                        @error('jenis')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-2">Tingkat Pencapaian <span class="text-red-500">*</span></label>
                        <select id="tingkat" name="tingkat" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('tingkat') ? 'border-red-500' : '' }}">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="internasional">Internasional</option>
                            <option value="nasional">Nasional</option>
                            <option value="regional">Regional</option>
                            <option value="provinsi">Provinsi</option>
                            <option value="kabupaten">Kabupaten/Kota</option>
                            <option value="universitas">Universitas</option>
                            <option value="fakultas">Fakultas</option>
                            <option value="program_studi">Program Studi</option>
                        </select>
                        @error('tingkat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="nama_prestasi" class="block text-sm font-medium text-gray-700 mb-2">Nama Prestasi <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_prestasi" name="nama_prestasi" value="{{ old('nama_prestasi') }}" placeholder="Misalnya: Juara 1 Kompetisi Algoritma" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('nama_prestasi') ? 'border-red-500' : '' }}">
                    @error('nama_prestasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan prestasi Anda secara detail..." required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('deskripsi') ? 'border-red-500' : '' }}">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tanggal_pencapaian" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pencapaian <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_pencapaian" name="tanggal_pencapaian" value="{{ old('tanggal_pencapaian') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('tanggal_pencapaian') ? 'border-red-500' : '' }}">
                        @error('tanggal_pencapaian')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="penyelenggara" class="block text-sm font-medium text-gray-700 mb-2">Penyelenggara/Organisasi <span class="text-red-500">*</span></label>
                        <input type="text" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}" placeholder="Misalnya: Universitas Indonesia" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('penyelenggara') ? 'border-red-500' : '' }}">
                        @error('penyelenggara')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="sertifikat" class="block text-sm font-medium text-gray-700 mb-2">Upload Sertifikat (PDF/Gambar) <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors {{ $errors->has('sertifikat') ? 'border-red-400 bg-red-50' : '' }}" onclick="document.getElementById('sertifikat').click()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-400 mb-2">
                            <path d="M.5 1a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h15a.5.5 0 0 0 .5-.5V1.5a.5.5 0 0 0-.5-.5H.5zm1 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                            <path d="m3 5 2-2 3 3-2 5 3-1 2-6 3 1v5l-6-1-4-5z"/>
                        </svg>
                        <p class="text-gray-600 font-medium">Klik untuk memilih file</p>
                        <p class="text-sm text-gray-500 mt-1">atau drag & drop file di sini</p>
                    </div>
                    <input type="file" id="sertifikat" name="sertifikat" accept="application/pdf,image/jpeg,image/png" class="hidden" required>
                    <p class="text-xs text-gray-500 mt-2">Format: PDF, JPG, atau PNG (Max 5MB)</p>
                    @error('sertifikat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                    <p class="text-blue-800 text-sm">
                        <strong>Catatan:</strong> Semua prestasi akan diverifikasi oleh admin sebelum ditampilkan. Pastikan dokumen pendukung jelas dan dapat dibaca.
                    </p>
                </div>

                <div class="flex gap-3 justify-end">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-100 transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">Tambah Prestasi</button>
                </div>
            </form>
        </div>

        <!-- List Prestasi Tab -->
        <div id="listTab" class="hidden bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            @if($prestasis->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">No</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Prestasi</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Jenis</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tingkat</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($prestasis as $index => $prestasi)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="font-medium text-gray-900">{{ $prestasi->nama_prestasi }}</div>
                                    <div class="text-xs text-gray-500">{{ $prestasi->penyelenggara }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded">
                                        {{ ucwords(str_replace('_', ' ', $prestasi->jenis)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ ucwords(str_replace('_', ' ', $prestasi->tingkat)) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($prestasi->tanggal_pencapaian)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($prestasi->status === 'valid')
                                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Valid</span>
                                    @elseif($prestasi->status === 'menunggu')
                                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Menunggu</span>
                                    @else
                                        <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2">
                                        <a href="{{ route('mahasiswa.prestasi.edit', $prestasi->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                        <form action="{{ route('mahasiswa.prestasi.delete', $prestasi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-300 mb-4">
                        <path d="M8.5 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada prestasi yang ditambahkan</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function showTab(tab) {
    if (tab === 'add') {
        document.getElementById('addTab').classList.remove('hidden');
        document.getElementById('listTab').classList.add('hidden');
        document.getElementById('tabAdd').classList.add('text-indigo-600', 'border-b-2', 'border-indigo-600');
        document.getElementById('tabAdd').classList.remove('text-gray-600', 'border-b-2', 'border-transparent');
        document.getElementById('tabList').classList.add('text-gray-600', 'border-b-2', 'border-transparent');
        document.getElementById('tabList').classList.remove('text-indigo-600', 'border-b-2', 'border-indigo-600');
    } else {
        document.getElementById('addTab').classList.add('hidden');
        document.getElementById('listTab').classList.remove('hidden');
        document.getElementById('tabList').classList.add('text-indigo-600', 'border-b-2', 'border-indigo-600');
        document.getElementById('tabList').classList.remove('text-gray-600', 'border-b-2', 'border-transparent');
        document.getElementById('tabAdd').classList.add('text-gray-600', 'border-b-2', 'border-transparent');
        document.getElementById('tabAdd').classList.remove('text-indigo-600', 'border-b-2', 'border-indigo-600');
    }
}
</script>
@endsection
