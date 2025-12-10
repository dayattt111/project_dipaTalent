@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Organisasi</h1>
            <nav class="mt-2 text-sm text-gray-600">
                <a href="{{ route('mahasiswa.dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('mahasiswa.organisasi.index') }}" class="hover:text-indigo-600">Organisasi</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Edit</span>
            </nav>
        </div>

        <!-- Status Info -->
        @if($organisasi->status === 'valid')
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-green-900">Data sudah divalidasi</p>
                        @if($organisasi->catatan_admin)
                            <p class="text-sm text-green-800 mt-1">Catatan: {{ $organisasi->catatan_admin }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @elseif($organisasi->status === 'invalid')
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-red-900">Data ditolak oleh admin</p>
                        @if($organisasi->catatan_admin)
                            <p class="text-sm text-red-800 mt-1">Alasan: {{ $organisasi->catatan_admin }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Warning Box -->
        <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-yellow-900">Perhatian!</p>
                    <p class="text-sm text-yellow-800 mt-1">Jika Anda mengubah data ini, status validasi akan direset menjadi "Pending" dan perlu divalidasi ulang oleh admin.</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('mahasiswa.organisasi.update', $organisasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="p-6 space-y-6">
                    <!-- Nama Organisasi -->
                    <div>
                        <label for="nama_organisasi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Organisasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama_organisasi" 
                               name="nama_organisasi" 
                               value="{{ old('nama_organisasi', $organisasi->nama_organisasi) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('nama_organisasi') border-red-500 @enderror"
                               placeholder="Contoh: BEM, HIMADIPA, OSIS, dll"
                               required>
                        @error('nama_organisasi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label for="jabatan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="jabatan" 
                               name="jabatan" 
                               value="{{ old('jabatan', $organisasi->jabatan) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('jabatan') border-red-500 @enderror"
                               placeholder="Contoh: Ketua, Wakil Ketua, Sekretaris, Anggota, dll"
                               required>
                        @error('jabatan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Periode -->
                    <div>
                        <label for="periode" class="block text-sm font-semibold text-gray-700 mb-2">
                            Periode <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="periode" 
                               name="periode" 
                               value="{{ old('periode', $organisasi->periode) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('periode') border-red-500 @enderror"
                               placeholder="Contoh: 2023-2024, Januari 2023 - Desember 2023"
                               required>
                        @error('periode')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        <textarea id="deskripsi" 
                                  name="deskripsi" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('deskripsi') border-red-500 @enderror"
                                  placeholder="Jelaskan peran dan tanggung jawab Anda dalam organisasi ini...">{{ old('deskripsi', $organisasi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current File -->
                    @if($organisasi->bukti_file)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                File Saat Ini
                            </label>
                            <div class="flex items-center space-x-3 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ basename($organisasi->bukti_file) }}</p>
                                    <p class="text-xs text-gray-500">File yang sudah diupload</p>
                                </div>
                                <a href="{{ Storage::url($organisasi->bukti_file) }}" 
                                   target="_blank"
                                   class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                    Lihat File
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Bukti File -->
                    <div>
                        <label for="bukti_file" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ $organisasi->bukti_file ? 'Ganti Bukti File' : 'Bukti File' }} 
                            <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        @if($organisasi->bukti_file)
                            <p class="text-xs text-gray-500 mb-2">Biarkan kosong jika tidak ingin mengganti file</p>
                        @endif
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors">
                            <div class="space-y-2 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="bukti_file" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                        <span>Upload file</span>
                                        <input id="bukti_file" 
                                               name="bukti_file" 
                                               type="file" 
                                               class="sr-only"
                                               accept=".pdf,.jpg,.jpeg,.png"
                                               onchange="displayFileName(this)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PDF, JPG, PNG hingga 2MB</p>
                                <p id="file-name" class="text-sm text-indigo-600 font-medium"></p>
                            </div>
                        </div>
                        @error('bukti_file')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3 border-t border-gray-200">
                    <a href="{{ route('mahasiswa.organisasi.index') }}" 
                       class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function displayFileName(input) {
    const fileNameDisplay = document.getElementById('file-name');
    if (input.files && input.files[0]) {
        fileNameDisplay.textContent = input.files[0].name;
    } else {
        fileNameDisplay.textContent = '';
    }
}
</script>
@endsection
