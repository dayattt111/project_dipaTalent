<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informasi IPK') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Perbarui IPK Anda. Data akan divalidasi oleh admin sebelum digunakan untuk perhitungan SAW.') }}
        </p>
    </header>

    @if (session('success'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('profile.updateIpk') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="ipk" :value="__('IPK (0.00 - 4.00)')" />
            <x-text-input id="ipk" name="ipk" type="number" step="0.01" min="0" max="4" class="mt-1 block w-full" 
                :value="old('ipk', $user->ipk)" required />
            <x-input-error class="mt-2" :messages="$errors->get('ipk')" />
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
                                Divalidasi pada {{ $user->ipk_verified_at->format('d M Y, H:i') }}
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

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan IPK') }}</x-primary-button>

            @if($user->ipk_status === 'valid')
                <p class="text-sm text-gray-600">
                    ℹ️ Mengubah IPK akan mereset status validasi.
                </p>
            @endif
        </div>
    </form>
</section>
