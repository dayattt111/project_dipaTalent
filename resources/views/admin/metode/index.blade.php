@extends('layouts.admin')

@section('title', 'Atur Bobot SAW')

@section('content')
<div class="max-w-7xl">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Atur Bobot SAW</h1>
        <p class="text-gray-600 mt-1">Kelola bobot kriteria untuk metode SAW. Total bobot harus selalu <span class="font-semibold">100%</span></p>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Kriteria</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Bobot (%)</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tipe</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @php
                        $totalBobot = 0;
                    @endphp

                    @foreach($kriterias as $k)
                        @php
                            $totalBobot += $k->bobot;
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $k->nama_kriteria }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($k->bobot * 100, 2) }}%</td>
                            <td class="px-6 py-4 text-sm capitalize text-gray-700">{{ $k->tipe }}</td>
                            <td class="px-6 py-4 text-sm text-right">
                                <a href="{{ route('admin.metode.edit', $k->id) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 hover:bg-blue-200 rounded-lg text-xs font-medium transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10.5 10.5a.5.5 0 0 1-.168.11l-5 1.667a.5.5 0 0 1-.65-.65l1.667-5a.5.5 0 0 1 .11-.168l10.5-10.5z"/>
                                    </svg>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                {{-- Footer: total bobot --}}
                <tfoot class="bg-gray-50 border-t border-gray-200">
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-sm font-semibold text-gray-900">Total Bobot</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ number_format($totalBobot * 100, 2) }}%</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Info Box --}}
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-blue-800">
            <strong>Info:</strong> Ubah bobot kriteria sesuai dengan kebutuhan penilaian. Sistem akan secara otomatis menyesuaikan data normalisasi dan skor ketika bobot diubah.
        </p>
    </div>
</div>

@endsection
