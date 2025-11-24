@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-6">

    {{-- Judul dan deskripsi --}}
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Bobot Kriteria</h2>
        <p class="text-gray-600 mt-1">
            Berikut adalah bobot kriteria untuk metode SAW. Total bobot harus selalu <span class="font-semibold">1.0 (100%)</span>.
            Anda dapat mengedit bobot setiap kriteria, dan kriteria lainnya akan disesuaikan secara otomatis.
        </p>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr class="text-left text-gray-700 uppercase text-sm">
                    <th class="border-b p-3">No</th>
                    <th class="border-b p-3">Nama Kriteria</th>
                    <th class="border-b p-3">Bobot</th>
                    <th class="border-b p-3">Tipe</th>
                    <th class="border-b p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $totalBobot = 0;
                @endphp

                @foreach($kriterias as $k)
                    @php
                        $totalBobot += $k->bobot;
                    @endphp
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="border-b p-3">{{ $loop->iteration }}</td>
                        <td class="border-b p-3 font-medium">{{ $k->nama_kriteria }}</td>
                        <td class="border-b p-3">{{ number_format($k->bobot, 2) }}</td>
                        <td class="border-b p-3 capitalize">{{ $k->tipe }}</td>
                        <td class="border-b p-3">
                            <a href="{{ route('admin.metode.edit', $k->id) }}"
                               class="px-3 py-1 bg-blue-600 rounded text-white text-sm hover:bg-blue-700 transition-colors duration-150">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            {{-- Footer: total bobot --}}
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="2" class="font-semibold p-3 text-right">Total Bobot:</td>
                    <td colspan="3" class="font-bold p-3 text-gray-800">
                        {{ number_format($totalBobot, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- Catatan --}}
    <p class="mt-4 text-gray-500 text-sm">
        Pastikan total bobot selalu <span class="font-semibold">1.0</span>. Mengubah satu kriteria akan menyesuaikan kriteria lainnya.
    </p>

</div>
@endsection
