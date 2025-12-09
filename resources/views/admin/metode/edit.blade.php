@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-6">

    {{-- Judul dan deskripsi --}}
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Edit Bobot Kriteria</h2>
        <p class="text-gray-600 mt-1">
            Ubah bobot kriteria di bawah ini. Sistem akan otomatis menyesuaikan kriteria lain agar total tetap <span class="font-semibold">100%</span>.
        </p>
    </div>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Preview Total Bobot --}}
    <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-700 font-medium">Total Bobot Semua Kriteria</p>
                <p class="text-xs text-gray-500 mt-1">Harus selalu 100%</p>
            </div>
            <div class="text-right">
                <p id="totalBobotDisplay" class="text-3xl font-bold text-blue-600">100.00%</p>
                <p id="totalBobotStatus" class="text-xs font-medium text-green-600">✓ Valid</p>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.metode.update', $kriteria->id) }}" method="POST" id="editForm">
        @csrf

        {{-- Kriteria yang sedang diedit --}}
        <div class="bg-yellow-50 border-2 border-yellow-300 rounded-lg p-5 mb-6">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
                <h3 class="text-lg font-bold text-gray-800">Kriteria yang Diedit</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}"
                           class="w-full border-gray-300 border rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Bobot (%)</label>
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <input type="number" step="0.01" min="0" max="100" id="bobotInput" value="{{ old('bobot', $kriteria->bobot * 100) }}"
                                   class="w-full border-2 border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-semibold text-blue-600 text-lg"
                                   placeholder="Masukkan bobot (0-100)">
                            <span class="text-2xl font-bold text-blue-600">%</span>
                        </div>
                        <input type="range" id="bobotSlider" min="0" max="100" step="0.01" value="{{ old('bobot', $kriteria->bobot * 100) }}"
                               class="w-full h-2 bg-blue-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                        <input type="hidden" name="bobot_decimal" id="bobotDecimal" value="{{ old('bobot', $kriteria->bobot) }}">
                        <p class="text-xs text-gray-500">Anda bisa mengetik angka langsung atau menggunakan slider di bawah</p>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tipe</label>
                    <select name="tipe" class="w-full border-gray-300 border rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="benefit" {{ old('tipe', $kriteria->tipe)=='benefit'?'selected':'' }}>Benefit (Semakin tinggi semakin baik)</option>
                        <option value="cost" {{ old('tipe', $kriteria->tipe)=='cost'?'selected':'' }}>Cost (Semakin rendah semakin baik)</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Kriteria Lainnya (Auto-adjust) --}}
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 mb-6">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-lg font-bold text-gray-800">Kriteria Lainnya (Otomatis Disesuaikan)</h3>
            </div>

            @php
                $otherKriterias = App\Models\BobotKriteria::where('id', '!=', $kriteria->id)->get();
            @endphp

            @if($otherKriterias->count() > 0)
                <div class="space-y-3">
                    @foreach($otherKriterias as $other)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $other->nama_kriteria }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ $other->tipe }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Bobot Baru:</p>
                            <p class="text-lg font-bold text-gray-900 other-bobot" data-id="{{ $other->id }}">{{ number_format($other->bobot * 100, 2) }}%</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Tidak ada kriteria lain</p>
            @endif
        </div>

        {{-- Info Alert --}}
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div class="text-sm text-blue-800">
                <p class="font-semibold mb-1">Cara Kerja Auto-Adjust:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>Geser slider atau ubah nilai bobot untuk kriteria yang sedang diedit</li>
                    <li>Sistem akan otomatis membagi sisa bobot ke kriteria lainnya secara merata</li>
                    <li>Total bobot akan selalu 100%</li>
                </ul>
            </div>
        </div>

        {{-- Tombol submit --}}
        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all duration-150 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Update Kriteria & Bobot
            </button>
            <a href="{{ route('admin.metode.index') }}" 
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition-colors duration-150">
                Batal
            </a>
        </div>
    </form>

</div>

<script>
    const bobotSlider = document.getElementById('bobotSlider');
    const bobotInput = document.getElementById('bobotInput');
    const bobotDecimal = document.getElementById('bobotDecimal');
    const totalBobotDisplay = document.getElementById('totalBobotDisplay');
    const totalBobotStatus = document.getElementById('totalBobotStatus');
    const otherBobotElements = document.querySelectorAll('.other-bobot');

    const otherCount = {{ $otherKriterias->count() }};

    function updateBobot(source = 'slider') {
        let currentBobot;
        
        if (source === 'input') {
            // Dari input text
            currentBobot = parseFloat(bobotInput.value);
            if (isNaN(currentBobot)) currentBobot = 0;
            
            // Validasi range
            currentBobot = Math.max(0, Math.min(100, currentBobot));
            
            // Update slider
            bobotSlider.value = currentBobot;
            bobotInput.value = currentBobot.toFixed(2);
        } else {
            // Dari slider
            currentBobot = parseFloat(bobotSlider.value);
            bobotInput.value = currentBobot.toFixed(2);
        }
        
        const currentDecimal = currentBobot / 100;
        bobotDecimal.value = currentDecimal.toFixed(4);

        // Hitung sisa bobot untuk kriteria lain
        const remaining = 100 - currentBobot;
        
        // Update total display
        totalBobotDisplay.textContent = '100.00%';
        
        // Validasi total
        if (currentBobot >= 0 && currentBobot <= 100) {
            totalBobotStatus.innerHTML = '<span class="text-green-600">✓ Valid</span>';
            bobotInput.classList.remove('border-red-500');
            bobotInput.classList.add('border-gray-300');
        } else {
            totalBobotStatus.innerHTML = '<span class="text-red-600">✗ Invalid</span>';
            bobotInput.classList.remove('border-gray-300');
            bobotInput.classList.add('border-red-500');
        }

        // Bagikan sisa bobot ke kriteria lain
        if (otherCount > 0) {
            const sharePerKriteria = remaining / otherCount;
            
            otherBobotElements.forEach(element => {
                element.textContent = sharePerKriteria.toFixed(2) + '%';
            });
        }
    }

    // Event listeners
    bobotSlider.addEventListener('input', function() {
        updateBobot('slider');
    });
    
    bobotInput.addEventListener('input', function() {
        updateBobot('input');
    });

    // Prevent submit jika enter di input
    bobotInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.blur();
        }
    });

    // Initial update
    updateBobot('slider');
</script>

@endsection
