@extends('layouts.admin')

@section('title', 'Edit Beasiswa')

@section('content')
<div class="max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">Edit Beasiswa</h1>

    <form action="{{ route('admin.kelolaBeasiswa.update', $beasiswa->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Nama Beasiswa</label>
            <input type="text" name="nama_beasiswa" value="{{ old('nama_beasiswa', $beasiswa->nama_beasiswa) }}" class="w-full border rounded px-3 py-2">
            @error('nama_beasiswa') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded px-3 py-2">{{ old('deskripsi', $beasiswa->deskripsi) }}</textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Kuota</label>
                <input type="number" name="kuota" value="{{ old('kuota', $beasiswa->kuota) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $beasiswa->tanggal_mulai?->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $beasiswa->tanggal_selesai?->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="mb-3 mt-4">
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="aktif" {{ $beasiswa->status=='aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $beasiswa->status=='nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                <option value="ditutup" {{ $beasiswa->status=='ditutup' ? 'selected' : '' }}>Ditutup</option>
            </select>
        </div>

        <div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            <a href="{{ route('admin.kelolaBeasiswa.index') }}" class="ml-2 text-sm text-gray-600">Batal</a>
        </div>
    </form>
</div>

@endsection
