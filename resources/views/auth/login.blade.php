<x-guest-layout>
    <!-- Form Title -->
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Kembali</h2>
        <p class="text-gray-600">Masuk ke akun DIPA Talent Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="email" class="block mt-2 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-sky-500 focus:ring-sky-500 transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="password" class="block mt-2 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-sky-500 focus:ring-sky-500 transition-colors"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-2 border-gray-300 text-sky-600 focus:ring-sky-500 transition" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-sky-600 hover:text-sky-700 transition" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit" class="w-full py-3 px-4 mt-8 bg-gradient-to-r from-sky-500 to-cyan-600 text-white font-bold rounded-lg hover:shadow-lg transition-all duration-200 transform hover:scale-105">
            {{ __('Masuk') }}
        </button>

        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-semibold text-sky-600 hover:text-sky-700 transition">
                    Daftar di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
