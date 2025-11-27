@extends('layouts.admin')

@section('title', 'Buat Beasiswa')

@section('content')
<div class="max-w-3xl">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Beasiswa</h1>
        <p class="text-gray-600 mt-1">Buat beasiswa baru dalam sistem</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.kelolaBeasiswa.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Nama Beasiswa --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Beasiswa</label>
                <input type="text" name="nama_beasiswa" value="{{ old('nama_beasiswa') }}" placeholder="Masukkan nama beasiswa" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('nama_beasiswa') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi beasiswa" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Three Column Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kuota</label>
                    <input type="number" name="kuota" value="{{ old('kuota', 0) }}" placeholder="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('kuota') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('tanggal_mulai') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('tanggal_selesai') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="ditutup" {{ old('status') === 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                </select>
                @error('status') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10.5 10.5a.5.5 0 0 1-.168.11l-5 1.667a.5.5 0 0 1-.65-.65l1.667-5a.5.5 0 0 1 .11-.168l10.5-10.5z"/>
                    </svg>
                    Simpan Beasiswa
                </button>
                <a href="{{ route('admin.kelolaBeasiswa.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
    </form>
</div>

{{-- @endsection --}}
