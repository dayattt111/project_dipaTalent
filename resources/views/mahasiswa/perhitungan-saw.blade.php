@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Perhitungan Metode SAW</h1>
                    <p class="text-gray-600 mt-2">Simple Additive Weighting - Detail Perhitungan Ranking Mahasiswa</p>
                </div>
                <button onclick="exportToExcel()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg flex items-center gap-2 transition-all shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export ke Excel
                </button>
            </div>
        </div>

        <!-- Rumus SAW -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-indigo-100">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Rumus Metode SAW
            </h2>
            
            <div class="space-y-4">
                <!-- Rumus Normalisasi -->
                <div class="bg-indigo-50 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">1. Normalisasi Matriks (Benefit)</h3>
                    <div class="bg-white rounded p-4 font-mono text-sm border border-indigo-200">
                        <div class="text-center">
                            <span class="text-lg">r<sub>ij</sub> = </span>
                            <span class="text-lg border-t-2 border-gray-800 px-2">x<sub>ij</sub></span>
                            <span class="text-lg mx-2">/</span>
                            <span class="text-lg">Max(x<sub>ij</sub>)</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        <strong>r<sub>ij</sub></strong> = nilai normalisasi alternatif ke-i pada kriteria ke-j<br>
                        <strong>x<sub>ij</sub></strong> = nilai alternatif ke-i pada kriteria ke-j<br>
                        <strong>Max(x<sub>ij</sub>)</strong> = nilai maksimum dari semua alternatif pada kriteria ke-j
                    </p>
                </div>

                <!-- Rumus Preferensi -->
                <div class="bg-green-50 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">2. Perhitungan Nilai Preferensi (V<sub>i</sub>)</h3>
                    <div class="bg-white rounded p-4 font-mono text-sm border border-green-200">
                        <div class="text-center">
                            <span class="text-lg">V<sub>i</sub> = Σ (w<sub>j</sub> × r<sub>ij</sub>)</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        <strong>V<sub>i</sub></strong> = nilai preferensi alternatif ke-i<br>
                        <strong>w<sub>j</sub></strong> = bobot kriteria ke-j<br>
                        <strong>r<sub>ij</sub></strong> = nilai normalisasi alternatif ke-i pada kriteria ke-j
                    </p>
                </div>

                <!-- Rumus Konversi Poin -->
                <div class="bg-purple-50 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">3. Konversi ke Poin</h3>
                    <div class="bg-white rounded p-4 font-mono text-sm border border-purple-200">
                        <div class="text-center">
                            <span class="text-lg">Poin = V<sub>i</sub> × 1000</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        Nilai preferensi (0-1) dikonversi ke skala poin (0-1000) untuk kemudahan interpretasi
                    </p>
                </div>
            </div>
        </div>

        <!-- Bobot Kriteria -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-indigo-100">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                </svg>
                Bobot Kriteria
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="bobotTable">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Kriteria</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Bobot (%)</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Desimal</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Tipe</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">IPK (Indeks Prestasi Kumulatif)</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">25.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">0.25</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Benefit</span>
                            </td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Prestasi Akademik</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">22.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">0.22</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Benefit</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Keaktifan Organisasi</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">15.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">0.15</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Benefit</span>
                            </td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">4</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Keterampilan & Sertifikasi</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">17.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">0.17</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Benefit</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">5</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Prestasi Non-Akademik</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">21.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">0.21</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Benefit</span>
                            </td>
                        </tr>
                        <tr class="bg-indigo-100 font-bold">
                            <td colspan="2" class="px-6 py-4 text-sm text-gray-900">TOTAL BOBOT</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">100.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">1.00</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel 1: Nilai Asli -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-indigo-100">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Tabel 1: Nilai Asli Alternatif
            </h2>
            <p class="text-sm text-gray-600 mb-4">Matriks keputusan dengan nilai asli dari setiap mahasiswa pada masing-masing kriteria</p>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="nilaiAsliTable">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th rowspan="2" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider border-r border-gray-300">No</th>
                            <th rowspan="2" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider border-r border-gray-300">Nama Mahasiswa</th>
                            <th rowspan="2" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-r border-gray-300">NIM</th>
                            <th colspan="5" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b border-gray-300">Kriteria</th>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-blue-100">C1<br><span class="text-[10px] font-normal">IPK</span></th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-green-100">C2<br><span class="text-[10px] font-normal">Prestasi Akademik</span></th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-yellow-100">C3<br><span class="text-[10px] font-normal">Organisasi</span></th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-purple-100">C4<br><span class="text-[10px] font-normal">Sertifikasi</span></th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-pink-100">C5<br><span class="text-[10px] font-normal">Prestasi Non-Akademik</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($dataPerhitungan as $index => $data)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r border-gray-200">A{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r border-gray-200">{{ $data['mahasiswa']->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-700 border-r border-gray-200">{{ $data['mahasiswa']->nim }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-blue-50 font-semibold">{{ number_format($data['nilai_asli']['ipk'], 2) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-green-50 font-semibold">{{ $data['nilai_asli']['prestasi_akademik'] }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-yellow-50 font-semibold">{{ $data['nilai_asli']['organisasi'] }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-purple-50 font-semibold">{{ $data['nilai_asli']['sertifikasi'] }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-pink-50 font-semibold">{{ $data['nilai_asli']['prestasi_non_akademik'] }}</td>
                        </tr>
                        @endforeach
                        <tr class="bg-yellow-100 font-bold">
                            <td colspan="3" class="px-6 py-4 text-sm text-gray-900 text-right border-r border-gray-300">Nilai Maksimum:</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-blue-200">{{ number_format($maxValues['ipk'], 2) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-green-200">{{ $maxValues['prestasi_akademik'] }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-yellow-200">{{ $maxValues['organisasi'] }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-purple-200">{{ $maxValues['sertifikasi'] }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-pink-200">{{ $maxValues['prestasi_non_akademik'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel 2: Normalisasi -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-indigo-100">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
                Tabel 2: Matriks Normalisasi
            </h2>
            <p class="text-sm text-gray-600 mb-4">Nilai normalisasi dihitung dengan: r<sub>ij</sub> = x<sub>ij</sub> / Max(x<sub>ij</sub>)</p>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="normalisasiTable">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th rowspan="2" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider border-r border-gray-300">No</th>
                            <th rowspan="2" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider border-r border-gray-300">Nama Mahasiswa</th>
                            <th colspan="5" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b border-gray-300">Nilai Normalisasi (r<sub>ij</sub>)</th>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-blue-100">R1<br><span class="text-[10px] font-normal">IPK</span></th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-green-100">R2<br><span class="text-[10px] font-normal">Prestasi Akademik</span></th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-yellow-100">R3<br><span class="text-[10px] font-normal">Organisasi</span></th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-purple-100">R4<br><span class="text-[10px] font-normal">Sertifikasi</span></th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider bg-pink-100">R5<br><span class="text-[10px] font-normal">Prestasi Non-Akademik</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($dataPerhitungan as $index => $data)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r border-gray-200">A{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r border-gray-200">{{ $data['mahasiswa']->name }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-blue-50 font-mono">{{ number_format($data['normalisasi']['ipk'], 4) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-green-50 font-mono">{{ number_format($data['normalisasi']['prestasi_akademik'], 4) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-yellow-50 font-mono">{{ number_format($data['normalisasi']['organisasi'], 4) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-purple-50 font-mono">{{ number_format($data['normalisasi']['sertifikasi'], 4) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center text-gray-900 bg-pink-50 font-mono">{{ number_format($data['normalisasi']['prestasi_non_akademik'], 4) }}</td>
                        </tr>
                        @endforeach>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel 3: Perhitungan Nilai Akhir -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-indigo-100">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Tabel 3: Perhitungan Nilai Preferensi
            </h2>
            <p class="text-sm text-gray-600 mb-4">V<sub>i</sub> = (R1 × 0.25) + (R2 × 0.22) + (R3 × 0.15) + (R4 × 0.17) + (R5 × 0.21)</p>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="preferensiTable">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Perhitungan Detail</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Nilai Preferensi (V<sub>i</sub>)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($dataPerhitungan as $index => $data)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">A{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $data['mahasiswa']->name }}</td>
                            <td class="px-6 py-4 text-xs text-gray-700 font-mono">
                                ({{ number_format($data['normalisasi']['ipk'], 4) }} × 0.25) + 
                                ({{ number_format($data['normalisasi']['prestasi_akademik'], 4) }} × 0.22) + 
                                ({{ number_format($data['normalisasi']['organisasi'], 4) }} × 0.15) + 
                                ({{ number_format($data['normalisasi']['sertifikasi'], 4) }} × 0.17) + 
                                ({{ number_format($data['normalisasi']['prestasi_non_akademik'], 4) }} × 0.21)
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-lg font-bold text-indigo-600">{{ number_format($data['nilai_akhir'], 4) }}</span>
                            </td>
                        </tr>
                        @endforeach>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel 4: Hasil Akhir & Ranking -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-2xl p-6 mb-8">
            <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                Tabel 4: Hasil Akhir & Ranking
            </h2>
            <p class="text-white text-sm mb-4 opacity-90">Ranking mahasiswa berdasarkan poin tertinggi (konversi dari nilai preferensi × 1000)</p>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-purple-500" id="rankingTable">
                    <thead class="bg-purple-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Ranking</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Alternatif</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Nilai Preferensi (V<sub>i</sub>)</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Poin</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($dataPerhitungan as $index => $data)
                        <tr class="hover:bg-indigo-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($data['ranking'] == 1)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-yellow-400 text-yellow-900">
                                        🏆 #{{ $data['ranking'] }}
                                    </span>
                                @elseif($data['ranking'] == 2)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gray-300 text-gray-900">
                                        🥈 #{{ $data['ranking'] }}
                                    </span>
                                @elseif($data['ranking'] == 3)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-orange-400 text-orange-900">
                                        🥉 #{{ $data['ranking'] }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-700">
                                        #{{ $data['ranking'] }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">A{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $data['mahasiswa']->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-700">{{ $data['mahasiswa']->nim }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-sm font-mono text-indigo-600 font-semibold">{{ number_format($data['nilai_akhir'], 4) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-4 py-1 rounded-lg text-lg font-bold bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-md">
                                    {{ $data['poin'] }} poin
                                </span>
                            </td>
                        </tr>
                        @endforeach>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kesimpulan -->
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-6">
            <div class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="text-lg font-bold text-green-900 mb-2">Kesimpulan</h3>
                    <p class="text-green-800 mb-2">
                        Berdasarkan perhitungan metode SAW dengan 5 kriteria (IPK, Prestasi Akademik, Keaktifan Organisasi, Keterampilan & Sertifikasi, dan Prestasi Non-Akademik), 
                        diperoleh ranking mahasiswa sebagai berikut:
                    </p>
                    <ul class="list-disc list-inside text-green-800 space-y-1">
                        @foreach($dataPerhitungan as $data)
                        <li>
                            <strong>Peringkat {{ $data['ranking'] }}:</strong> {{ $data['mahasiswa']->name }} dengan nilai preferensi <strong>{{ number_format($data['nilai_akhir'], 4) }}</strong> ({{ $data['poin'] }} poin)
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function exportToExcel() {
    const wb = XLSX.utils.book_new();
    
    // Sheet 1: Bobot Kriteria
    const bobotData = [
        ['BOBOT KRITERIA METODE SAW'],
        [],
        ['No', 'Kriteria', 'Bobot (%)', 'Desimal', 'Tipe'],
        ['1', 'IPK (Indeks Prestasi Kumulatif)', '25.00%', '0.25', 'Benefit'],
        ['2', 'Prestasi Akademik', '22.00%', '0.22', 'Benefit'],
        ['3', 'Keaktifan Organisasi', '15.00%', '0.15', 'Benefit'],
        ['4', 'Keterampilan & Sertifikasi', '17.00%', '0.17', 'Benefit'],
        ['5', 'Prestasi Non-Akademik', '21.00%', '0.21', 'Benefit'],
        ['', 'TOTAL BOBOT', '100.00%', '1.00', '']
    ];
    const ws1 = XLSX.utils.aoa_to_sheet(bobotData);
    XLSX.utils.book_append_sheet(wb, ws1, 'Bobot Kriteria');
    
    // Sheet 2: Nilai Asli
    const nilaiAsliData = [
        ['TABEL NILAI ASLI ALTERNATIF'],
        [],
        ['No', 'Nama Mahasiswa', 'NIM', 'C1 (IPK)', 'C2 (Prestasi Akademik)', 'C3 (Organisasi)', 'C4 (Sertifikasi)', 'C5 (Prestasi Non-Akademik)']
    ];
    @foreach($dataPerhitungan as $index => $data)
    nilaiAsliData.push([
        'A{{ $index + 1 }}',
        '{{ $data['mahasiswa']->name }}',
        '{{ $data['mahasiswa']->nim }}',
        {{ $data['nilai_asli']['ipk'] }},
        {{ $data['nilai_asli']['prestasi_akademik'] }},
        {{ $data['nilai_asli']['organisasi'] }},
        {{ $data['nilai_asli']['sertifikasi'] }},
        {{ $data['nilai_asli']['prestasi_non_akademik'] }}
    ]);
    @endforeach
    nilaiAsliData.push([
        '', 'Nilai Maksimum', '',
        {{ $maxValues['ipk'] }},
        {{ $maxValues['prestasi_akademik'] }},
        {{ $maxValues['organisasi'] }},
        {{ $maxValues['sertifikasi'] }},
        {{ $maxValues['prestasi_non_akademik'] }}
    ]);
    const ws2 = XLSX.utils.aoa_to_sheet(nilaiAsliData);
    XLSX.utils.book_append_sheet(wb, ws2, 'Nilai Asli');
    
    // Sheet 3: Normalisasi
    const normalisasiData = [
        ['TABEL MATRIKS NORMALISASI'],
        ['Rumus: rij = xij / Max(xij)'],
        [],
        ['No', 'Nama Mahasiswa', 'R1 (IPK)', 'R2 (Prestasi Akademik)', 'R3 (Organisasi)', 'R4 (Sertifikasi)', 'R5 (Prestasi Non-Akademik)']
    ];
    @foreach($dataPerhitungan as $index => $data)
    normalisasiData.push([
        'A{{ $index + 1 }}',
        '{{ $data['mahasiswa']->name }}',
        {{ number_format($data['normalisasi']['ipk'], 4) }},
        {{ number_format($data['normalisasi']['prestasi_akademik'], 4) }},
        {{ number_format($data['normalisasi']['organisasi'], 4) }},
        {{ number_format($data['normalisasi']['sertifikasi'], 4) }},
        {{ number_format($data['normalisasi']['prestasi_non_akademik'], 4) }}
    ]);
    @endforeach
    const ws3 = XLSX.utils.aoa_to_sheet(normalisasiData);
    XLSX.utils.book_append_sheet(wb, ws3, 'Normalisasi');
    
    // Sheet 4: Nilai Preferensi
    const preferensiData = [
        ['TABEL PERHITUNGAN NILAI PREFERENSI'],
        ['Rumus: Vi = (R1 × 0.25) + (R2 × 0.22) + (R3 × 0.15) + (R4 × 0.17) + (R5 × 0.21)'],
        [],
        ['No', 'Nama Mahasiswa', 'Perhitungan', 'Nilai Preferensi (Vi)']
    ];
    @foreach($dataPerhitungan as $index => $data)
    preferensiData.push([
        'A{{ $index + 1 }}',
        '{{ $data['mahasiswa']->name }}',
        `({{ number_format($data['normalisasi']['ipk'], 4) }} × 0.25) + ({{ number_format($data['normalisasi']['prestasi_akademik'], 4) }} × 0.22) + ({{ number_format($data['normalisasi']['organisasi'], 4) }} × 0.15) + ({{ number_format($data['normalisasi']['sertifikasi'], 4) }} × 0.17) + ({{ number_format($data['normalisasi']['prestasi_non_akademik'], 4) }} × 0.21)`,
        {{ number_format($data['nilai_akhir'], 4) }}
    ]);
    @endforeach
    const ws4 = XLSX.utils.aoa_to_sheet(preferensiData);
    XLSX.utils.book_append_sheet(wb, ws4, 'Nilai Preferensi');
    
    // Sheet 5: Ranking
    const rankingData = [
        ['HASIL AKHIR & RANKING'],
        ['Poin = Vi × 1000'],
        [],
        ['Ranking', 'Alternatif', 'Nama Mahasiswa', 'NIM', 'Nilai Preferensi (Vi)', 'Poin']
    ];
    @foreach($dataPerhitungan as $index => $data)
    rankingData.push([
        {{ $data['ranking'] }},
        'A{{ $index + 1 }}',
        '{{ $data['mahasiswa']->name }}',
        '{{ $data['mahasiswa']->nim }}',
        {{ number_format($data['nilai_akhir'], 4) }},
        {{ $data['poin'] }}
    ]);
    @endforeach
    const ws5 = XLSX.utils.aoa_to_sheet(rankingData);
    XLSX.utils.book_append_sheet(wb, ws5, 'Ranking');
    
    // Export
    XLSX.writeFile(wb, 'Perhitungan_SAW_' + new Date().getTime() + '.xlsx');
}
</script>
@endsection
