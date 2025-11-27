<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
            .gradient-text {
                background: linear-gradient(135deg, #0369a1 0%, #0284c7 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .gradient-button {
                background: linear-gradient(135deg, #0369a1 0%, #0284c7 50%, #0ea5e9 100%);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen gradient-primary relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-sky-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

            <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
                <!-- Header with logo -->
                <div class="mb-8">
                    <a href="/" class="flex items-center gap-3 justify-center group">
                        <div class="w-12 h-12 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold gradient-text">DIPA Talent</span>
                    </a>
                </div>

                <!-- Form Container -->
                <div class="w-full sm:max-w-md">
                    <div class="bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-2xl border border-blue-100">
                        <!-- Form Header -->
                        <div class="px-6 py-8 sm:px-10">
                            {{ $slot }}
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <div class="mt-6 text-center">
                        <p class="text-gray-600 text-sm">
                            Kembali ke <a href="/" class="font-semibold text-sky-600 hover:text-sky-700 transition">halaman utama</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes blob {
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
        </style>
    </body>
</html>
