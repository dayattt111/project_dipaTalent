<x-guest-layout>
    <!-- Form Title -->
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Bergabunglah dengan Kami</h2>
        <p class="text-gray-600">Buat akun DIPA Talent untuk memulai perjalanan Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="name" class="block mt-2 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-sky-500 focus:ring-sky-500 transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- NIM -->
        <div>
            <x-input-label for="nim" :value="__('NIM')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="nim" class="block mt-2 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-sky-500 focus:ring-sky-500 transition-colors" type="text" name="nim" :value="old('nim')" required autocomplete="off" placeholder="Contoh: 2021001234" />
            <x-input-error :messages="$errors->get('nim')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="email" class="block mt-2 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-sky-500 focus:ring-sky-500 transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="password" class="block mt-2 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-sky-500 focus:ring-sky-500 transition-colors"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            <p class="mt-2 text-xs text-gray-500">Minimal 8 karakter dengan kombinasi huruf, angka, dan simbol</p>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-sky-500 focus:ring-sky-500 transition-colors"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Terms & Conditions -->
        <div class="flex items-start gap-3 pt-2">
            <input type="checkbox" id="terms" required class="mt-1 rounded border-2 border-gray-300 text-sky-600 focus:ring-sky-500 transition cursor-pointer">
            <label for="terms" class="text-sm text-gray-600 cursor-pointer">
                Saya setuju dengan <a href="#" class="font-semibold text-sky-600 hover:text-sky-700">Syarat dan Ketentuan</a> serta <a href="#" class="font-semibold text-sky-600 hover:text-sky-700">Kebijakan Privasi</a>
            </label>
        </div>

        <!-- Register Button -->
        <button type="submit" class="w-full py-3 px-4 mt-6 bg-gradient-to-r from-sky-500 to-cyan-600 text-white font-bold rounded-lg hover:shadow-lg transition-all duration-200 transform hover:scale-105">
            {{ __('Daftar') }}
        </button>

        <!-- Login Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-semibold text-sky-600 hover:text-sky-700 transition">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
