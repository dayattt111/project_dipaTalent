@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-6">

    {{-- Judul dan deskripsi --}}
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Edit Bobot Kriteria</h2>
        <p class="text-gray-600 mt-1">
            Ubah bobot dan atribut kriteria di bawah ini. Pastikan total bobot semua kriteria tetap <span class="font-semibold">1.0 (100%)</span>.
        </p>
    </div>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.metode.update', $kriteria->id) }}" method="POST" class="space-y-4">
        @csrf

        {{-- Nama Kriteria --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama Kriteria</label>
            <input type="text" name="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}"
                   class="w-full border-gray-300 border rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Bobot --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Bobot</label>
            <input type="number" step="0.01" name="bobot" value="{{ old('bobot', $kriteria->bobot) }}"
                   class="w-full border-gray-300 border rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            <p class="text-gray-500 text-sm mt-1">
                Pastikan total bobot semua kriteria tetap <span class="font-semibold">1.0</span>.
            </p>
        </div>

        {{-- Tipe --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Tipe</label>
            <select name="tipe" class="w-full border-gray-300 border rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="benefit" {{ old('tipe', $kriteria->tipe)=='benefit'?'selected':'' }}>Benefit</option>
                <option value="cost" {{ old('tipe', $kriteria->tipe)=='cost'?'selected':'' }}>Cost</option>
            </select>
        </div>

        {{-- Atribut 1 --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Atribut 1</label>
            <input type="text" name="atribut1" value="{{ old('atribut1', $kriteria->atribut1) }}"
                   class="w-full border-gray-300 border rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Atribut 2 --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Atribut 2</label>
            <input type="text" name="atribut2" value="{{ old('atribut2', $kriteria->atribut2) }}"
                   class="w-full border-gray-300 border rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Tombol submit --}}
        <div class="pt-4">
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow transition-colors duration-150">
                Update Kriteria
            </button>
        </div>
    </form>

</div>
@endsection
