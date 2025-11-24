@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-6">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Bobot Kriteria</h2>

    <form action="{{ route('admin.bobot.update', $kriteria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Nama Kriteria</label>
            <input type="text" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Bobot</label>
            <input type="number" step="0.01" name="bobot" value="{{ $kriteria->bobot }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tipe</label>
            <select name="tipe" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-400">
                <option value="benefit" {{ $kriteria->tipe=='benefit' ? 'selected' : '' }}>Benefit</option>
                <option value="cost" {{ $kriteria->tipe=='cost' ? 'selected' : '' }}>Cost</option>
            </select>
        </div>

        <button
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>

</div>
@endsection
