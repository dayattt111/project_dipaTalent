@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
            <p class="text-gray-600 mt-2">Selamat datang kembali, {{ Auth::user()->name }}!</p>
            <div class="flex items-center gap-2 mt-3 text-sm text-gray-500">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <span id="current-time">{{ $currentDateTime }}</span>
            </div>
        </div>

        <!-- Main Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Beasiswa -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Total Beasiswa</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalBeasiswa }}</p>
                    <div class="mt-3 flex items-center gap-3 text-xs">
                        <span class="text-green-600 font-semibold">{{ $beasiswaAktif }} Aktif</span>
                        <span class="text-gray-400">|</span>
                        <span class="text-gray-600">{{ $beasiswaDitutup }} Ditutup</span>
                    </div>
                </div>
            </div>

            <!-- Total Pendaftar -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Total Pendaftar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalPendaftar }}</p>
                    <div class="mt-3 flex items-center gap-2 text-xs">
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded font-semibold">{{ $pendaftarDiterima }} Diterima</span>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded font-semibold">{{ $pendaftarProses }} Proses</span>
                    </div>
                </div>
            </div>

            <!-- Total Prestasi -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Total Prestasi</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalPrestasi }}</p>
                    <div class="mt-3 flex items-center gap-3 text-xs">
                        <span class="text-green-600 font-semibold">{{ $prestasiValid }} Valid</span>
                        <span class="text-gray-400">|</span>
                        <span class="text-yellow-600 font-semibold">{{ $prestasiPending }} Pending</span>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                    <div class="mt-3 flex items-center gap-2 text-xs">
                        <span class="text-purple-600 font-semibold">{{ $totalMahasiswa }} Mahasiswa</span>
                        <span class="text-gray-400">|</span>
                        <span class="text-gray-600">{{ $totalUmum }} Umum</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SAW Info Card -->
        <div class="bg-gradient-to-br from-sky-400 to-cyan-500 rounded-xl p-6 mb-8 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-2">⚖️ Bobot Kriteria SAW</h3>
                    <p class="text-sky-100 text-sm">Total bobot kriteria yang telah dikonfigurasi untuk perhitungan ranking</p>
                </div>
                <div class="text-right">
                    <p class="text-5xl font-bold">{{ $totalBobotSAW }}</p>
                    <p class="text-sky-100 text-sm mt-1">Kriteria Aktif</p>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <!-- Prestasi by Tingkat Chart -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">📈 Prestasi Berdasarkan Tingkat</h3>
                <div style="position: relative; height: 250px;">
                    <canvas id="prestasiTingkatChart"></canvas>
                </div>
            </div>

            <!-- Prestasi by Jenis Chart -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">🎯 Prestasi Berdasarkan Jenis</h3>
                <div style="position: relative; height: 250px;">
                    <canvas id="prestasiJenisChart"></canvas>
                </div>
            </div>

        </div>

        <!-- Pendaftaran Trend Chart -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-900 mb-4">📊 Tren Pendaftaran Beasiswa (6 Bulan Terakhir)</h3>
            <div style="position: relative; height: 300px;">
                <canvas id="pendaftaranTrendChart"></canvas>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Recent Pendaftaran -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">🆕 Pendaftaran Terbaru</h3>
                @if($recentPendaftaran->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentPendaftaran as $pendaftaran)
                        <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition border border-gray-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                {{ substr($pendaftaran->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-900 text-sm truncate">{{ $pendaftaran->user->name }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ $pendaftaran->beasiswa->nama_beasiswa }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $pendaftaran->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold flex-shrink-0
                                {{ $pendaftaran->status == 'diterima' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $pendaftaran->status == 'proses' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $pendaftaran->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($pendaftaran->status) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p>Belum ada pendaftaran</p>
                    </div>
                @endif
            </div>

            <!-- Recent Prestasi -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">⭐ Prestasi Terbaru</h3>
                @if($recentPrestasi->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentPrestasi as $prestasi)
                        <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition border border-gray-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-900 text-sm truncate">{{ $prestasi->nama_prestasi }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ $prestasi->user->name }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $prestasi->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex flex-col items-end gap-1 flex-shrink-0">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $prestasi->tingkat == 'internasional' ? 'bg-purple-100 text-purple-700' : '' }}
                                    {{ $prestasi->tingkat == 'nasional' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $prestasi->tingkat == 'provinsi' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $prestasi->tingkat == 'kabupaten' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $prestasi->tingkat == 'kampus' ? 'bg-sky-100 text-sky-700' : '' }}">
                                    {{ ucfirst($prestasi->tingkat) }}
                                </span>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $prestasi->status == 'valid' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $prestasi->status == 'menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $prestasi->status == 'invalid' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($prestasi->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p>Belum ada prestasi</p>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Update time every second
    function updateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
    }
    setInterval(updateTime, 1000);

    // Chart colors
    const colors = {
        blue: 'rgb(59, 130, 246)',
        green: 'rgb(34, 197, 94)',
        yellow: 'rgb(234, 179, 8)',
        red: 'rgb(239, 68, 68)',
        purple: 'rgb(168, 85, 247)',
        cyan: 'rgb(6, 182, 212)',
        orange: 'rgb(249, 115, 22)',
    };

    // Prestasi by Tingkat Chart
    const prestasiTingkatCtx = document.getElementById('prestasiTingkatChart').getContext('2d');
    new Chart(prestasiTingkatCtx, {
        type: 'bar',
        data: {
            labels: ['Internasional', 'Nasional', 'Provinsi', 'Kabupaten', 'Kampus'],
            datasets: [{
                label: 'Jumlah Prestasi',
                data: [
                    {{ $prestasiByTingkat['internasional'] }},
                    {{ $prestasiByTingkat['nasional'] }},
                    {{ $prestasiByTingkat['provinsi'] }},
                    {{ $prestasiByTingkat['kabupaten'] }},
                    {{ $prestasiByTingkat['kampus'] }}
                ],
                backgroundColor: [
                    colors.purple,
                    colors.red,
                    colors.blue,
                    colors.green,
                    colors.cyan
                ],
                borderRadius: 8,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Prestasi by Jenis Chart
    const prestasiJenisCtx = document.getElementById('prestasiJenisChart').getContext('2d');
    new Chart(prestasiJenisCtx, {
        type: 'doughnut',
        data: {
            labels: ['Akademik', 'Non-Akademik'],
            datasets: [{
                data: [
                    {{ $prestasiByJenis['akademik'] }},
                    {{ $prestasiByJenis['non_akademik'] }}
                ],
                backgroundColor: [
                    colors.blue,
                    colors.yellow
                ],
                borderColor: '#fff',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Pendaftaran Trend Chart
    const pendaftaranTrendCtx = document.getElementById('pendaftaranTrendChart').getContext('2d');
    new Chart(pendaftaranTrendCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($pendaftaranPerBulan, 'bulan')) !!},
            datasets: [{
                label: 'Jumlah Pendaftaran',
                data: {!! json_encode(array_column($pendaftaranPerBulan, 'jumlah')) !!},
                borderColor: colors.green,
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: colors.green,
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

@endsection
