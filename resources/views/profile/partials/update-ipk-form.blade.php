@if (session('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<form method="post" action="{{ route('profile.updateIpk') }}" class="space-y-6">

    @csrf

    <div>
        <label for="ipk" class="block text-sm font-semibold text-gray-700 mb-2">IPK (Indeks Prestasi Kumulatif)</label>
        <input id="ipk" name="ipk" type="number" step="0.01" min="0" max="4" 
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('ipk') border-red-500 @enderror" 
               value="{{ old('ipk', $user->ipk) }}" 
               placeholder="Contoh: 3.75"
               required>
        <p class="mt-1 text-xs text-gray-500">Masukkan IPK Anda (skala 0.00 - 4.00)</p>
        @error('ipk')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

        <!-- Status Validasi -->
        <div class="mt-4">
            @if($user->ipk)
                <div class="flex items-center gap-3 p-3 rounded-lg 
                    @if($user->ipk_status === 'valid') bg-green-50 border border-green-200
                    @elseif($user->ipk_status === 'invalid') bg-red-50 border border-red-200
                    @else bg-yellow-50 border border-yellow-200
                    @endif">
                    <div class="flex-1">
                        <p class="font-semibold text-sm
                            @if($user->ipk_status === 'valid') text-green-800
                            @elseif($user->ipk_status === 'invalid') text-red-800
                            @else text-yellow-800
                            @endif">
                            Status: 
                            @if($user->ipk_status === 'valid')
                                ✓ Tervalidasi
                            @elseif($user->ipk_status === 'invalid')
                                ✗ Ditolak
                            @else
                                ⏳ Menunggu Validasi
                            @endif
                        </p>
                        
                        @if($user->ipk_status === 'valid' && $user->ipk_verified_at)
                            <p class="text-xs text-green-600 mt-1">
                                Divalidasi pada {{ \Carbon\Carbon::parse($user->ipk_verified_at)->format('d M Y, H:i') }}
                            </p>
                        @endif

                        @if($user->ipk_catatan_admin)
                            <p class="text-sm mt-2 
                                @if($user->ipk_status === 'valid') text-green-700
                                @elseif($user->ipk_status === 'invalid') text-red-700
                                @else text-yellow-700
                                @endif">
                                <strong>Catatan Admin:</strong> {{ $user->ipk_catatan_admin }}
                            </p>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-sm text-gray-500">IPK belum diisi. Silakan masukkan IPK Anda.</p>
            @endif
        </div>

    <div class="flex items-center gap-4 pt-4">
        <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            Simpan IPK
        </button>

        @if($user->ipk_status === 'valid')
            <p class="text-sm text-yellow-600 font-medium">
                ℹ️ Mengubah IPK akan mereset status validasi
            </p>
            @endif
        </div>
    </form>
</section>
