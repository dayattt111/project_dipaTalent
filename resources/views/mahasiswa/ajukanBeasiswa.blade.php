@extends('layouts.mahasiswa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Ajukan Beasiswa</h1>
            <p class="text-gray-600 mt-2">Daftarkan diri Anda untuk mendapatkan bantuan beasiswa</p>
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

        <form action="{{ route('mahasiswa.ajukanBeasiswa.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200">
            @csrf

            <!-- Step 1: Pilih Beasiswa -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex items-start gap-3 mb-6">
                    <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Pilih Program Beasiswa</h2>
                        <p class="text-sm text-gray-600">Pilih program beasiswa yang ingin Anda ikuti</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse($beasiswas as $beasiswa)
                    <label class="flex items-start gap-4 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-300 hover:bg-indigo-50 transition-all {{ $errors->has('beasiswa_id') ? 'border-red-300' : '' }}">
                        <input type="radio" name="beasiswa_id" value="{{ $beasiswa->id }}" class="mt-1 w-4 h-4 text-indigo-600 cursor-pointer beasiswa-radio" data-beasiswa-id="{{ $beasiswa->id }}" {{ old('beasiswa_id') == $beasiswa->id || (isset($selectedBeasiswa) && $selectedBeasiswa->id == $beasiswa->id) ? 'checked' : '' }} required>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $beasiswa->nama_beasiswa }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $beasiswa->deskripsi }}</p>
                            <div class="flex flex-wrap gap-4 mt-3 text-sm">
                                <span class="flex items-center gap-1 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                                    </svg>
                                    Kuota: {{ $beasiswa->kuota }}
                                </span>
                                <span class="flex items-center gap-1 {{ $beasiswa->status === 'aktif' ? 'text-green-600' : 'text-red-600' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 9.71V3.5z"/>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 7-7z"/>
                                    </svg>
                                    Status: <span class="font-medium">{{ ucfirst($beasiswa->status) }}</span>
                                </span>
                            </div>
                        </div>
                    </label>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <p>Belum ada program beasiswa yang tersedia</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Step 2: Alasan Mengajukan Beasiswa -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex items-start gap-3 mb-6">
                    <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Alasan Mengajukan Beasiswa</h2>
                        <p class="text-sm text-gray-600">Jelaskan mengapa Anda layak mendapatkan beasiswa ini</p>
                    </div>
                </div>

                <div>
                    <label for="alasan" class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alasan" name="alasan" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('alasan') ? 'border-red-500' : '' }}" placeholder="Jelaskan alasan Anda mengajukan beasiswa ini, kondisi ekonomi keluarga, prestasi yang telah diraih, rencana studi, dan bagaimana beasiswa ini akan membantu Anda..." required>{{ old('alasan') }}</textarea>
                    @error('alasan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-2">
                        <span id="char-count">0</span>/minimum 50 karakter
                    </p>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-3">
                        <p class="text-sm text-blue-800 font-medium mb-2">💡 Tips Menulis Alasan yang Baik:</p>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li>• Ceritakan kondisi ekonomi keluarga Anda dengan jujur</li>
                            <li>• Sebutkan prestasi akademik dan non-akademik yang telah diraih</li>
                            <li>• Jelaskan bagaimana beasiswa ini akan membantu studi Anda</li>
                            <li>• Tuliskan rencana dan tujuan akademik Anda ke depan</li>
                            <li>• Gunakan bahasa yang sopan dan formal</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Step 3: Dokumen Pendukung -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex items-start gap-3 mb-6">
                    <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">4</div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Dokumen Pendukung</h2>
                        <p class="text-sm text-gray-600">Upload dokumen yang mendukung aplikasi Anda</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="transkrip" class="block text-sm font-medium text-gray-700 mb-2">
                            Transkrip Nilai (PDF) <span class="text-red-500">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors {{ $errors->has('transkrip') ? 'border-red-400 bg-red-50' : '' }}" onclick="document.getElementById('transkrip').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-400 mb-2">
                                <path d="M4 1a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V1zm2 0a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6z"/>
                            </svg>
                            <p class="text-gray-600 font-medium">Klik untuk memilih file PDF</p>
                            <p class="text-sm text-gray-500 mt-1">atau drag & drop file di sini</p>
                            <p id="transkrip-filename" class="text-sm text-indigo-600 font-medium mt-2 hidden"></p>
                        </div>
                        <input type="file" id="transkrip" name="transkrip" accept="application/pdf" class="hidden" required>
                        <p class="text-xs text-gray-500 mt-2">Format: PDF | Ukuran maksimal: 5MB | Transkrip nilai resmi dari kampus</p>
                        @error('transkrip')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="foto_formal" class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Formal (JPG/PNG) <span class="text-red-500">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors {{ $errors->has('foto_formal') ? 'border-red-400 bg-red-50' : '' }}" onclick="document.getElementById('foto_formal').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-400 mb-2">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                            </svg>
                            <p class="text-gray-600 font-medium">Klik untuk memilih foto</p>
                            <p class="text-sm text-gray-500 mt-1">atau drag & drop file gambar di sini</p>
                            <div id="foto-preview" class="mt-3 hidden">
                                <img id="foto-preview-img" src="" alt="Preview" class="mx-auto max-w-xs max-h-48 rounded-lg border border-gray-300">
                            </div>
                        </div>
                        <input type="file" id="foto_formal" name="foto_formal" accept="image/jpeg,image/png,image/jpg" class="hidden" required>
                        <p class="text-xs text-gray-500 mt-2">Format: JPG/PNG | Ukuran maksimal: 3MB | Foto dengan latar belakang formal</p>
                        @error('foto_formal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <p class="text-sm text-amber-800 font-medium mb-2">📋 Informasi Dokumen:</p>
                        <ul class="text-xs text-amber-700 space-y-1">
                            <li>• <strong>Transkrip</strong> akan digunakan untuk verifikasi IPK dan prestasi akademik Anda</li>
                            <li>• <strong>Foto formal</strong> akan digunakan dalam berkas administrasi beasiswa</li>
                            <li>• Pastikan dokumen yang diunggah jelas dan terbaca dengan baik</li>
                            <li>• Data prestasi, organisasi, dan sertifikasi akan diambil dari sistem</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Catatan Penting -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6">
                <h3 class="font-semibold text-blue-900 mb-2">📌 Catatan Penting</h3>
                <ul class="text-blue-800 text-sm space-y-1">
                    <li>• Sistem akan mengambil data IPK, prestasi, organisasi, dan sertifikasi dari profil Anda</li>
                    <li>• Pastikan dokumen yang diunggah jelas, asli, dan dapat dibaca dengan baik</li>
                    <li>• Alasan harus ditulis dengan jujur dan minimal 50 karakter</li>
                    <li>• Dokumen akan diverifikasi oleh admin dalam waktu 7-14 hari kerja</li>
                    <li>• Status pengajuan dapat dipantau melalui menu "Riwayat Pendaftaran"</li>
                    <li>• Anda hanya dapat mengajukan satu kali untuk setiap program beasiswa</li>
                </ul>
            </div>

            <!-- Tombol Aksi -->
            <div class="p-6 border-t border-gray-200 bg-gray-50 flex gap-3 justify-end">
                <a href="{{ route('mahasiswa.dashboard') }}" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-100 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M12.146.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V12h2.293l6.5-6.5z"/>
                    </svg>
                    Ajukan Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    // Auto-select beasiswa dari query parameter
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const beasiswaId = urlParams.get('beasiswa_id') || urlParams.get('beasiswa');
        
        if (beasiswaId) {
            const radio = document.querySelector(`input[type="radio"][value="${beasiswaId}"]`);
            if (radio) {
                radio.checked = true;
                setTimeout(() => {
                    radio.closest('label').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }
        }
    });

    // Character counter for alasan
    const alasanTextarea = document.getElementById('alasan');
    const charCount = document.getElementById('char-count');
    
    alasanTextarea.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;
        
        if (count < 50) {
            charCount.className = 'text-red-600 font-bold';
        } else if (count < 100) {
            charCount.className = 'text-yellow-600 font-bold';
        } else {
            charCount.className = 'text-green-600 font-bold';
        }
    });

    // File preview for transkrip
    const transkripInput = document.getElementById('transkrip');
    const transkripFilename = document.getElementById('transkrip-filename');

    transkripInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            transkripFilename.textContent = '✓ ' + file.name;
            transkripFilename.classList.remove('hidden');
        }
    });

    // File preview for foto_formal
    const fotoFormalInput = document.getElementById('foto_formal');
    const fotoPreview = document.getElementById('foto-preview');
    const fotoPreviewImg = document.getElementById('foto-preview-img');

    fotoFormalInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                fotoPreviewImg.src = e.target.result;
                fotoPreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const alasan = alasanTextarea.value.trim();
        
        if (alasan.length < 50) {
            e.preventDefault();
            alert('Alasan harus minimal 50 karakter. Saat ini: ' + alasan.length + ' karakter.');
            alasanTextarea.focus();
            return false;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mengirim...';
    });
</script>
@endsection
