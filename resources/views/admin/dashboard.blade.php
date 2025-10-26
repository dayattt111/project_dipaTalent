<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="mt-2">Anda login sebagai Admin. Di sini Anda bisa mengelola data pengguna, mahasiswa, dan konten.</p>
                </div>
            </div>

            <!-- Bagian Widget Statistik Admin -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Widget 1: Jumlah Pengguna -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Pengguna</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">150</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4 inline-block">Kelola Pengguna &rarr;</a>
                    </div>
                </div>

                <!-- Widget 2: Jumlah Mahasiswa -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Mahasiswa</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">85</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4 inline-block">Kelola Mahasiswa &rarr;</a>
                    </div>
                </div>

                <!-- Widget 3: Laporan Baru -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Pengaturan Sistem</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Lihat dan ubah pengaturan global website.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4 inline-block">Buka Pengaturan &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
