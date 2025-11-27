<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DipaTalent') }} - Mahasiswa</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #f0f4f8 0%, #d9e8f5 100%);
                min-height: 100vh;
            }

            .page-transition {
                animation: fadeIn 0.3s ease-in;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: #4f46e5;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #4338ca;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        @include('layouts.navMahasiswa')

        <!-- Page Content -->
        <main class="page-transition">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Brand -->
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">DT</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">DipaTalent</h3>
                                <p class="text-xs text-gray-500">Mahasiswa Portal</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">Platform beasiswa dan prestasi untuk mahasiswa Indonesia.</p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-4">Menu Cepat</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('mahasiswa.dashboard') }}" class="text-gray-600 hover:text-indigo-600 transition">Dashboard</a></li>
                            <li><a href="{{ route('mahasiswa.listBeasiswa') }}" class="text-gray-600 hover:text-indigo-600 transition">Beasiswa</a></li>
                            <li><a href="{{ route('mahasiswa.leaderboard') }}" class="text-gray-600 hover:text-indigo-600 transition">Leaderboard</a></li>
                            <li><a href="{{ route('mahasiswa.galeri') }}" class="text-gray-600 hover:text-indigo-600 transition">Galeri</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-4">Hubungi Kami</h4>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>📧 support@dipatalent.id</p>
                            <p>📞 +62 812-3456-7890</p>
                            <p>🏢 Jl. Contoh No. 123, Jakarta</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 mt-8 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-sm text-gray-600">© 2025 DipaTalent. Semua hak dilindungi.</p>
                        <div class="flex gap-6 mt-4 md:mt-0 text-sm">
                            <a href="#" class="text-gray-600 hover:text-indigo-600 transition">Kebijakan Privasi</a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600 transition">Syarat & Ketentuan</a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600 transition">Bantuan</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
