<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Pengunjung</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
        .gradient-primary {
            background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 50%, #cffafe 100%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo & Menu -->
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <span class="text-xl font-bold bg-gradient-to-r from-sky-600 to-cyan-600 bg-clip-text text-transparent">DIPA Talent</span>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:ml-10 sm:flex">
                            <a href="{{ route('umum.dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('umum.dashboard') ? 'border-b-2 border-sky-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('umum.leaderboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('umum.leaderboard') ? 'border-b-2 border-sky-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                                Leaderboard
                            </a>
                            <a href="{{ route('umum.beasiswa') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('umum.beasiswa*') ? 'border-b-2 border-sky-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                                Beasiswa
                            </a>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <p class="text-center text-gray-500 text-sm">&copy; 2025 DIPA Talent. Platform Beasiswa & Prestasi Mahasiswa.</p>
            </div>
        </footer>
    </div>
</body>
</html>
