@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Profile Settings</h1>
            <p class="text-gray-600 mt-2">Kelola informasi profil dan keamanan akun Anda</p>
        </div>

        <!-- Success Message -->
        @if(session('success') || session('status') === 'profile-updated')
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') ?? 'Profil berhasil diperbarui!' }}</span>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Information Card -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            Informasi Profil
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Update informasi profil dan email Anda</p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                @if(auth()->user()->role === 'mahasiswa')
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Data IPK
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Update Indeks Prestasi Kumulatif</p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-ipk-form')
                    </div>
                </div>
                @endif

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-orange-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            Keamanan Password
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Pastikan akun Anda menggunakan password yang kuat</p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-red-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-red-200 bg-gradient-to-r from-red-50 to-pink-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Hapus Akun
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Hapus akun Anda secara permanen</p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <!-- Sidebar Profile Preview -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-8">
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-600 h-32"></div>
                    <div class="px-6 pb-6 -mt-16">
                        <!-- Profile Photo -->
                        <div class="flex justify-center mb-4">
                            @if(auth()->user()->photo_profile)
                                @php
                                    $photoUrl = filter_var(auth()->user()->photo_profile, FILTER_VALIDATE_URL) 
                                        ? auth()->user()->photo_profile 
                                        : Storage::url(auth()->user()->photo_profile);
                                @endphp
                                <img src="{{ $photoUrl }}" 
                                     alt="{{ auth()->user()->name }}" 
                                     class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-lg"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4F46E5&color=fff&size=256'">
                            @else
                                <div class="w-32 h-32 rounded-full border-4 border-white bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg">
                                    <span class="text-4xl font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- User Info -->
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ auth()->user()->email }}</p>
                            
                            @if(auth()->user()->nim)
                            <p class="text-sm text-gray-500 mt-1">NIM: {{ auth()->user()->nim }}</p>
                            @endif

                            <!-- Role Badge -->
                            <div class="mt-3 flex justify-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                    {{ auth()->user()->role === 'admin' ? 'bg-purple-100 text-purple-800' : 
                                       (auth()->user()->role === 'mahasiswa' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </div>

                            @if(auth()->user()->role === 'mahasiswa' && auth()->user()->ipk)
                            <div class="mt-4 p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg border border-green-200">
                                <p class="text-xs text-gray-600 font-medium">IPK Saat Ini</p>
                                <p class="text-3xl font-bold text-green-600 mt-1">{{ number_format(auth()->user()->ipk, 2) }}</p>
                            </div>
                            @endif

                            <!-- Account Status -->
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Status Email</span>
                                    @if(auth()->user()->email_verified_at)
                                        <span class="inline-flex items-center text-green-600 font-medium">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-yellow-600 font-medium">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            Belum Terverifikasi
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Bergabung</span>
                                    <span class="text-gray-900 font-medium">{{ auth()->user()->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
