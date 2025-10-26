<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="mt-2">Ini adalah halaman dashboard Anda sebagai Mahasiswa. Lihat informasi akademik Anda di bawah.</p>
                </div>
            </div>

            <!-- Bagian Info Akademik Mahasiswa -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Info 1: Jadwal Kuliah -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jadwal Kuliah</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Lihat jadwal mata kuliah Anda untuk semester ini.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4 inline-block">Lihat Jadwal &rarr;</a>
                    </div>
                </div>

                <!-- Info 2: Transkrip Nilai -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Transkrip Nilai</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Cek nilai dan Indeks Prestasi (IP) Anda.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4 inline-block">Lihat Nilai &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Info 3: Pengumuman -->
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Pengumuman Penting</h3>
                    <ul class="list-disc list-inside mt-2 text-gray-600 dark:text-gray-400">
                        <li>Batas akhir pembayaran UKT: 30 Oktober 2025.</li>
                        <li>Perwalian semester depan dimulai 1 November 2025.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
