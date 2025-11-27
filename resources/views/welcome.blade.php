<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DIPA Talent - Platform Beasiswa & Prestasi</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Figtree', sans-serif;
            }
            .gradient-primary {
                background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 50%, #cffafe 100%);
            }
            .gradient-hero {
                background: linear-gradient(135deg, #0369a1 0%, #0284c7 50%, #0ea5e9 100%);
            }
            .gradient-text {
                background: linear-gradient(135deg, #0369a1 0%, #0284c7 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .hover-lift {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .hover-lift:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 25px -5px rgba(2, 132, 199, 0.15);
            }
            .floating {
                animation: floating 3s ease-in-out infinite;
            }
            @keyframes floating {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold gradient-text">DIPA Talent</span>
                    </div>

                    <!-- Nav Links -->
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#fitur" class="text-gray-600 hover:text-sky-600 transition font-medium">Fitur</a>
                        <a href="#keunggulan" class="text-gray-600 hover:text-sky-600 transition font-medium">Keunggulan</a>
                        <a href="#testimoni" class="text-gray-600 hover:text-sky-600 transition font-medium">Testimoni</a>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex items-center gap-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg bg-sky-50 text-sky-600 font-semibold hover:bg-sky-100 transition">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-gray-700 font-semibold hover:text-sky-600 transition">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-sky-500 to-cyan-600 text-white font-semibold hover:shadow-lg transition">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 gradient-primary overflow-hidden">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="space-y-4">
                        <div class="inline-block px-4 py-2 bg-sky-100 rounded-full">
                            <span class="text-sky-700 font-semibold text-sm">✨ Platform Inovatif untuk Talenta Muda</span>
                        </div>
                        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight">
                            Raih Beasiswa <span class="gradient-text">Impianmu</span>
                        </h1>
                        <p class="text-xl text-gray-700 leading-relaxed">
                            Platform terpadu untuk mahasiswa berbakat mencari beasiswa, showcase prestasi, dan berkompetisi dengan sistem ranking yang transparan dan adil.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-sky-500 to-cyan-600 text-white font-bold rounded-lg hover:shadow-xl transition inline-block text-center">
                                Mulai Sekarang →
                            </a>
                        @endif
                        <a href="#keunggulan" class="px-8 py-4 bg-white border-2 border-sky-300 text-sky-600 font-bold rounded-lg hover:bg-sky-50 transition inline-block text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                    <div class="flex gap-8 pt-4">
                        <div>
                            <p class="text-3xl font-bold text-sky-600">10+</p>
                            <p class="text-gray-600">Program Beasiswa</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-sky-600">1000+</p>
                            <p class="text-gray-600">Mahasiswa Terdaftar</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-sky-600">5000+</p>
                            <p class="text-gray-600">Total Prestasi</p>
                        </div>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="relative hidden md:block">
                    <div class="absolute inset-0 bg-gradient-to-r from-sky-400 to-cyan-400 rounded-3xl transform rotate-6 opacity-10"></div>
                    <div class="relative bg-gradient-to-br from-sky-400 to-cyan-500 rounded-3xl p-8 text-white space-y-6 floating">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Prestasi Terbaik</p>
                                <p class="text-sm opacity-80">Showcase kemampuanmu</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Kompetisi Sehat</p>
                                <p class="text-sm opacity-80">Bersaing dengan adil</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 3.062v6.372a3.066 3.066 0 01-2.812 3.062 3.066 3.066 0 01-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 01-1.745-.723 3.066 3.066 0 01-2.812-3.062V6.517a3.066 3.066 0 012.812-3.062zM9 2a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Verifikasi Terpercaya</p>
                                <p class="text-sm opacity-80">Proses transparansi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fitur Section -->
        <section id="fitur" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Semua yang kamu butuhkan untuk mencari beasiswa dan menampilkan prestasi dalam satu platform</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="hover-lift p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100">
                        <div class="w-14 h-14 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 9a2 2 0 11-4 0 2 2 0 014 0zM14 9a2 2 0 11-4 0 2 2 0 014 0zM15.27 15.89A6 6 0 112.05 8.07"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Dashboard Pribadi</h3>
                        <p class="text-gray-600">Monitor aplikasi beasiswa, prestasi, dan ranking realtime dalam satu dashboard yang intuitif</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="hover-lift p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100">
                        <div class="w-14 h-14 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5m-11-4v4m8-4v4M3.5 9.5h13"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Aplikasi Beasiswa</h3>
                        <p class="text-gray-600">Ajukan aplikasi ke berbagai program beasiswa dengan form yang lengkap dan upload dokumen mudah</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="hover-lift p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100">
                        <div class="w-14 h-14 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Showcase Prestasi</h3>
                        <p class="text-gray-600">Unggah dan tampilkan prestasi akademik maupun non-akademik dengan sertifikat terverifikasi</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="hover-lift p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100">
                        <div class="w-14 h-14 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2H3a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V5a1 1 0 10-2 0v10a1 1 0 01-1 1H3a1 1 0 01-1-1V5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Leaderboard SAW</h3>
                        <p class="text-gray-600">Sistem ranking berbasis algoritma SAW yang transparan dan objektif untuk kompetisi adil</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="hover-lift p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100">
                        <div class="w-14 h-14 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Analytics Mendalam</h3>
                        <p class="text-gray-600">Laporan komprehensif tentang beasiswa, prestasi, dan performa ranking dengan visualisasi menarik</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="hover-lift p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100">
                        <div class="w-14 h-14 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/><path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Galeri Prestasi</h3>
                        <p class="text-gray-600">Lihat galeri prestasi mahasiswa lain untuk inspirasi dan melihat benchmark pencapaian</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keunggulan Section -->
        <section id="keunggulan" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-sky-50 to-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Mengapa Pilih DIPA Talent?</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Platform terpercaya dengan fitur lengkap untuk mengakselerasi karir akademik dan profesional Anda</p>
                </div>

                <div class="space-y-12">
                    <!-- Keunggulan 1 -->
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="space-y-4">
                            <h3 class="text-2xl font-bold text-gray-900">✅ Sistem Penilaian Transparan</h3>
                            <p class="text-gray-600 text-lg">Menggunakan algoritma SAW (Simple Additive Weighting) yang terbukti objektif dalam mengevaluasi kandidat beasiswa. Setiap kriteria memiliki bobot yang jelas dan dapat dipertanggungjawabkan.</p>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Kriteria penilaian yang jelas</li>
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Bobot setiap kriteria transparan</li>
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Update scoring real-time</li>
                            </ul>
                        </div>
                        <div class="bg-gradient-to-br from-sky-100 to-cyan-100 rounded-2xl p-8 h-64 flex items-center justify-center">
                            <svg class="w-32 h-32 text-sky-600 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Keunggulan 2 -->
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="bg-gradient-to-br from-sky-100 to-cyan-100 rounded-2xl p-8 h-64 flex items-center justify-center order-2 md:order-1">
                            <svg class="w-32 h-32 text-sky-600 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 000-2H6V3a1 1 0 01-1-1zm0 0a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 2a1 1 0 000 2h10a1 1 0 100-2H5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="space-y-4 order-1 md:order-2">
                            <h3 class="text-2xl font-bold text-gray-900">📅 Kalender Beasiswa Terstruktur</h3>
                            <p class="text-gray-600 text-lg">Kelola jadwal aplikasi beasiswa dengan tampilan kalender yang terorganisir. Jangan lewatkan deadline dengan sistem notifikasi otomatis dan reminder yang tepat waktu.</p>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Kalender deadline terintegrasi</li>
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Notifikasi otomatis sebelum deadline</li>
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Riwayat lengkap aplikasi</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Keunggulan 3 -->
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="space-y-4">
                            <h3 class="text-2xl font-bold text-gray-900">🎓 Manajemen Prestasi Profesional</h3>
                            <p class="text-gray-600 text-lg">Unggah, kelola, dan showcase semua prestasi Anda dengan interface yang user-friendly. Sistem verifikasi memastikan kredibilitas setiap pencapaian yang ditampilkan.</p>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Upload sertifikat digital</li>
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Verifikasi admin otomatis</li>
                                <li class="flex gap-3"><span class="text-sky-600">•</span> Galeri prestasi yang menarik</li>
                            </ul>
                        </div>
                        <div class="bg-gradient-to-br from-sky-100 to-cyan-100 rounded-2xl p-8 h-64 flex items-center justify-center">
                            <svg class="w-32 h-32 text-sky-600 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoni Section -->
        <section id="testimoni" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Suara dari Mahasiswa</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Dengarkan pengalaman mahasiswa yang telah sukses memanfaatkan platform DIPA Talent</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Testimoni 1 -->
                    <div class="hover-lift bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-full"></div>
                            <div>
                                <p class="font-bold text-gray-900">Andi Wijaya</p>
                                <p class="text-sm text-gray-600">Mahasiswa Teknik Informatika</p>
                            </div>
                        </div>
                        <div class="flex gap-1 mb-4">
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                        </div>
                        <p class="text-gray-600">Platform ini sangat membantu saya menemukan beasiswa yang sesuai. Sistem penilaian yang transparan membuat saya lebih termotivasi untuk meningkatkan prestasi. Alhamdulillah sekarang saya mendapat beasiswa Prestasi Akademik!</p>
                    </div>

                    <!-- Testimoni 2 -->
                    <div class="hover-lift bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-full"></div>
                            <div>
                                <p class="font-bold text-gray-900">Siti Nurhaliza</p>
                                <p class="text-sm text-gray-600">Mahasiswa Psikologi</p>
                            </div>
                        </div>
                        <div class="flex gap-1 mb-4">
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                        </div>
                        <p class="text-gray-600">Fitur showcase prestasi di DIPA Talent memudahkan saya mendokumentasikan semua pencapaian. Galeri prestasi juga memberikan inspirasi dari prestasi mahasiswa lain. Sangat berguna untuk persiapan melamar kerja!</p>
                    </div>

                    <!-- Testimoni 3 -->
                    <div class="hover-lift bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-full"></div>
                            <div>
                                <p class="font-bold text-gray-900">Reza Pratama</p>
                                <p class="text-sm text-gray-600">Mahasiswa Bisnis</p>
                            </div>
                        </div>
                        <div class="flex gap-1 mb-4">
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                            <span class="text-yellow-400">★</span>
                        </div>
                        <p class="text-gray-600">Leaderboard SAW di DIPA Talent membuat kompetisi lebih sehat dan adil. Saya bisa melihat posisi saya secara real-time dan tahu apa yang perlu ditingkatkan. Dashboard yang intuitif membuat segalanya menjadi mudah diakses.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-sky-500 to-cyan-600 rounded-3xl p-12 text-center text-white">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">Siap Raih Kesempatan Emas?</h2>
                    <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan mahasiswa berbakat yang telah mendapatkan beasiswa impian mereka melalui DIPA Talent</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-sky-600 font-bold rounded-lg hover:bg-gray-100 transition inline-block">
                                Daftar Sekarang
                            </a>
                        @endif
                        @if (Route::has('login'))
                            @guest
                                <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition inline-block">
                                    Sudah Punya Akun? Masuk
                                </a>
                            @endguest
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <h3 class="text-white font-bold mb-4">DIPA Talent</h3>
                        <p class="text-sm">Platform terpadu untuk mahasiswa berbakat mencari beasiswa dan showcase prestasi.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Fitur</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">Dashboard</a></li>
                            <li><a href="#" class="hover:text-white transition">Beasiswa</a></li>
                            <li><a href="#" class="hover:text-white transition">Prestasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Bantuan</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                            <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
                            <li><a href="#" class="hover:text-white transition">Panduan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Legal</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">Privacy</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms</a></li>
                            <li><a href="#" class="hover:text-white transition">Cookies</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-8 text-center text-sm">
                    <p>&copy; 2025 DIPA Talent. Semua hak cipta dilindungi. Dibuat dengan ❤️ untuk mahasiswa Indonesia.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
