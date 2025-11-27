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

            <!-- Step 2: Data Akademik -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex items-start gap-3 mb-6">
                    <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Data Akademik</h2>
                        <p class="text-sm text-gray-600">Lengkapi informasi akademik Anda</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="ipk" class="block text-sm font-medium text-gray-700 mb-2">
                            IPK <span class="text-red-500">*</span>
                            <span id="ipk-status" class="text-xs text-gray-500"></span>
                        </label>
                        <input type="number" id="ipk" name="ipk" step="0.01" min="0" max="4" value="{{ old('ipk') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('ipk') ? 'border-red-500' : '' }}" placeholder="3.50" required>
                        @error('ipk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">💡 Unggah transkrip di bawah untuk auto-populate nilai IPK</p>
                    </div>
                    <div>
                        <label for="prestasi_akademik" class="block text-sm font-medium text-gray-700 mb-2">Prestasi Akademik <span class="text-red-500">*</span></label>
                        <input type="text" id="prestasi_akademik" name="prestasi_akademik" value="{{ old('prestasi_akademik') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('prestasi_akademik') ? 'border-red-500' : '' }}" placeholder="Misalnya: Juara 1 Kompetisi Sains" required>
                        @error('prestasi_akademik')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Step 3: Pengalaman & Keterampilan -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex items-start gap-3 mb-6">
                    <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Pengalaman & Keterampilan</h2>
                        <p class="text-sm text-gray-600">Tuliskan pengalaman dan keterampilan Anda</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="organisasi" class="block text-sm font-medium text-gray-700 mb-2">Keaktifan Organisasi <span class="text-red-500">*</span></label>
                        <textarea id="organisasi" name="organisasi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('organisasi') ? 'border-red-500' : '' }}" placeholder="Sebutkan organisasi yang Anda ikuti dan peran Anda di dalamnya" required>{{ old('organisasi') }}</textarea>
                        @error('organisasi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="keterampilan" class="block text-sm font-medium text-gray-700 mb-2">Keterampilan <span class="text-red-500">*</span></label>
                        <textarea id="keterampilan" name="keterampilan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('keterampilan') ? 'border-red-500' : '' }}" placeholder="Tuliskan keterampilan yang Anda miliki (misalnya: Public Speaking, Leadership, Programming, dsb)" required>{{ old('keterampilan') }}</textarea>
                        @error('keterampilan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Step 4: Dokumen Pendukung -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex items-start gap-3 mb-6">
                    <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">4</div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Dokumen Pendukung</h2>
                        <p class="text-sm text-gray-600">Upload dokumen yang mendukung aplikasi Anda</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="transkrip" class="block text-sm font-medium text-gray-700 mb-2">Transkrip Nilai (PDF) <span class="text-red-500">*</span></label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors {{ $errors->has('transkrip') ? 'border-red-400 bg-red-50' : '' }}" onclick="document.getElementById('transkrip').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-400 mb-2">
                                <path d="M4 1a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V1zm2 0a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6z"/>
                            </svg>
                            <p class="text-gray-600 font-medium">Klik untuk memilih file</p>
                            <p class="text-sm text-gray-500 mt-1">atau drag & drop file PDF di sini</p>
                        </div>
                        <input type="file" id="transkrip" name="transkrip" accept="application/pdf" class="hidden" required>
                        <p class="text-xs text-gray-500 mt-2">Format: PDF, Ukuran maksimal: 5MB</p>
                        @error('transkrip')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto Diri (JPG/PNG) <span class="text-red-500">*</span></label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors {{ $errors->has('foto') ? 'border-red-400 bg-red-50' : '' }}" onclick="document.getElementById('foto').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-400 mb-2">
                                <path d="M.5 1a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h15a.5.5 0 0 0 .5-.5V1.5a.5.5 0 0 0-.5-.5H.5zm1 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                <path d="m3 5 2-2 3 3-2 5 3-1 2-6 3 1v5l-6-1-4-5z"/>
                            </svg>
                            <p class="text-gray-600 font-medium">Klik untuk memilih file</p>
                            <p class="text-sm text-gray-500 mt-1">atau drag & drop file gambar di sini</p>
                        </div>
                        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png" class="hidden" required>
                        <p class="text-xs text-gray-500 mt-2">Format: JPG atau PNG, Ukuran maksimal: 3MB</p>
                        @error('foto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Catatan Penting -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6">
                <h3 class="font-semibold text-blue-900 mb-2">Catatan Penting</h3>
                <ul class="text-blue-800 text-sm space-y-1">
                    <li>• Pastikan semua data yang Anda isi adalah benar dan sesuai dengan dokumen asli</li>
                    <li>• Dokumen yang diunggah akan diverifikasi oleh admin dan tim seleksi</li>
                    <li>• Keputusan penerimaan akan diberitahukan melalui email dalam waktu 7-14 hari kerja</li>
                    <li>• Anda dapat mengecek status aplikasi di dashboard Anda</li>
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

<!-- Script untuk PDF Parsing dan Auto-select Beasiswa -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    // Set PDF.js worker
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    // Auto-select beasiswa dari query parameter
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const beasiswaId = urlParams.get('beasiswa_id') || urlParams.get('beasiswa');
        
        if (beasiswaId) {
            const radio = document.querySelector(`input[type="radio"][value="${beasiswaId}"]`);
            if (radio) {
                radio.checked = true;
                // Scroll to the selected beasiswa with smooth animation
                setTimeout(() => {
                    radio.closest('label').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }
        }
    });

    const transkripInput = document.getElementById('transkrip');
    const ipkInput = document.getElementById('ipk');
    const ipkStatus = document.getElementById('ipk-status');

    transkripInput.addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        try {
            ipkStatus.textContent = '⏳ Menganalisis...';
            ipkStatus.className = 'text-xs text-blue-500';

            const arrayBuffer = await file.arrayBuffer();
            const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
            let fullText = '';

            // Extract text from all pages
            for (let i = 1; i <= Math.min(pdf.numPages, 3); i++) {
                const page = await pdf.getPage(i);
                const textContent = await page.getTextContent();
                const text = textContent.items.map(item => item.str).join(' ');
                fullText += text + ' ';
            }

            // Pattern matching untuk IPK
            const ipkPatterns = [
                /IPK\s*[:=]?\s*([\d,\.]+)/gi,
                /Indeks Prestasi\s*[:=]?\s*([\d,\.]+)/gi,
                /Indeks Prestasi Kumulatif\s*[:=]?\s*([\d,\.]+)/gi,
                /([\d,\.]+)\s*(?:adalah\s+)?IPK/gi,
            ];

            let extractedIPK = null;
            for (const pattern of ipkPatterns) {
                const match = fullText.match(pattern);
                if (match) {
                    const valueMatch = match[0].match(/([\d,\.]+)/);
                    if (valueMatch) {
                        extractedIPK = valueMatch[1].replace(',', '.');
                        break;
                    }
                }
            }

            if (extractedIPK && extractedIPK >= 0 && extractedIPK <= 4) {
                ipkInput.value = parseFloat(extractedIPK).toFixed(2);
                ipkStatus.textContent = '✅ IPK terdeteksi: ' + parseFloat(extractedIPK).toFixed(2);
                ipkStatus.className = 'text-xs text-green-500';
            } else {
                ipkStatus.textContent = '⚠️ IPK tidak ditemukan, silakan isi manual';
                ipkStatus.className = 'text-xs text-orange-500';
            }
        } catch (error) {
            console.error('Error parsing PDF:', error);
            ipkStatus.textContent = '❌ Error membaca PDF, silakan isi manual';
            ipkStatus.className = 'text-xs text-red-500';
        }
    });

    // Drag and drop support
    const transkripDiv = transkripInput.parentElement;
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        transkripDiv.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        transkripDiv.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        transkripDiv.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        transkripDiv.classList.add('border-indigo-500', 'bg-indigo-50');
    }

    function unhighlight(e) {
        transkripDiv.classList.remove('border-indigo-500', 'bg-indigo-50');
    }

    transkripDiv.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        transkripInput.files = files;

        // Trigger change event
        const event = new Event('change', { bubbles: true });
        transkripInput.dispatchEvent(event);
    }
</script>
@endsection
