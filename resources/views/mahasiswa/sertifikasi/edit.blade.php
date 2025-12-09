@extends('layouts.mahasiswa')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
                <a href="{{ route('mahasiswa.sertifikasi.index') }}" class="hover:text-blue-600 transition">Sertifikasi</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900 font-medium">Edit</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Sertifikasi</h1>
            <p class="text-gray-600 mt-2">Perbarui data sertifikasi Anda</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <form action="{{ route('mahasiswa.sertifikasi.update', $sertifikasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Status Info -->
                @if($sertifikasi->status !== 'pending')
                <div class="mb-6 p-4 {{ $sertifikasi->status === 'valid' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded-lg">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 {{ $sertifikasi->status === 'valid' ? 'text-green-600' : 'text-red-600' }}" fill="currentColor" viewBox="0 0 20 20">
                            @if($sertifikasi->status === 'valid')
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            @else
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            @endif
                        </svg>
                        <div>
                            <p class="text-sm font-semibold {{ $sertifikasi->status === 'valid' ? 'text-green-800' : 'text-red-800' }}">
                                Data {{ $sertifikasi->status === 'valid' ? 'telah divalidasi' : 'ditolak' }} oleh admin
                            </p>
                            @if($sertifikasi->catatan_admin)
                            <p class="text-sm {{ $sertifikasi->status === 'valid' ? 'text-green-700' : 'text-red-700' }} mt-1">
                                Catatan: {{ $sertifikasi->catatan_admin }}
                            </p>
                            @endif
                            <p class="text-xs {{ $sertifikasi->status === 'valid' ? 'text-green-600' : 'text-red-600' }} mt-2">
                                Perubahan yang Anda lakukan akan mereset status validasi ke "Menunggu Validasi"
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Nama Sertifikat -->
                <div class="mb-6">
                    <label for="nama_sertifikat" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Sertifikat / Pelatihan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_sertifikat" id="nama_sertifikat" value="{{ old('nama_sertifikat', $sertifikasi->nama_sertifikat) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_sertifikat') border-red-500 @enderror">
                    @error('nama_sertifikat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penerbit -->
                <div class="mb-6">
                    <label for="penerbit" class="block text-sm font-semibold text-gray-700 mb-2">
                        Penerbit / Penyelenggara <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $sertifikasi->penerbit) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('penerbit') border-red-500 @enderror">
                    @error('penerbit')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Sertifikasi -->
                <div class="mb-6">
                    <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jenis Sertifikasi <span class="text-red-500">*</span>
                    </label>
                    <select name="jenis" id="jenis" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis') border-red-500 @enderror">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Sertifikasi BNSP" {{ old('jenis', $sertifikasi->jenis) == 'Sertifikasi BNSP' ? 'selected' : '' }}>Sertifikasi BNSP (3 poin)</option>
                        <option value="Bootcamp" {{ old('jenis', $sertifikasi->jenis) == 'Bootcamp' ? 'selected' : '' }}>Bootcamp (2 poin)</option>
                        <option value="Online Course" {{ old('jenis', $sertifikasi->jenis) == 'Online Course' ? 'selected' : '' }}>Online Course / Pelatihan (1 poin)</option>
                    </select>
                    @error('jenis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Sertifikat -->
                <div class="mb-6">
                    <label for="nomor_sertifikat" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Sertifikat (Opsional)
                    </label>
                    <input type="text" name="nomor_sertifikat" id="nomor_sertifikat" value="{{ old('nomor_sertifikat', $sertifikasi->nomor_sertifikat) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nomor_sertifikat') border-red-500 @enderror">
                    @error('nomor_sertifikat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Terbit & Expired -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="tanggal_terbit" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Terbit <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_terbit" id="tanggal_terbit" value="{{ old('tanggal_terbit', $sertifikasi->tanggal_terbit) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_terbit') border-red-500 @enderror">
                        @error('tanggal_terbit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tanggal_expired" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Expired (Opsional)
                        </label>
                        <input type="date" name="tanggal_expired" id="tanggal_expired" value="{{ old('tanggal_expired', $sertifikasi->tanggal_expired) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_expired') border-red-500 @enderror">
                        @error('tanggal_expired')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current File -->
                @if($sertifikasi->bukti_file)
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">File Saat Ini</label>
                    <a href="{{ Storage::url($sertifikasi->bukti_file) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                        </svg>
                        Lihat File
                    </a>
                </div>
                @endif

                <!-- Bukti File -->
                <div class="mb-6">
                    <label for="bukti_file" class="block text-sm font-semibold text-gray-700 mb-2">
                        Ganti Bukti Sertifikat (Opsional)
                    </label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="bukti_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload file</span>
                                    <input id="bukti_file" name="bukti_file" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF, JPG, PNG hingga 5MB</p>
                        </div>
                    </div>
                    @error('bukti_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti file</p>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('mahasiswa.sertifikasi.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                        Update Sertifikasi
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
// Preview file name when selected
document.getElementById('bukti_file').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    if (fileName) {
        const label = document.querySelector('label[for="bukti_file"] span');
        label.textContent = fileName;
    }
});
</script>
@endsection
