@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Prestasi Mahasiswa</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.verifikasiPrestasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Pilih User -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="user_id">Nama Mahasiswa</label>
            <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->nim ?? '-' }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Jenis Prestasi -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="jenis">Jenis Prestasi</label>
            <select name="jenis" id="jenis" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Jenis --</option>
                <option value="akademik" {{ old('jenis') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                <option value="non-akademik" {{ old('jenis') == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
            </select>
        </div>

        <!-- Nama Prestasi -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="nama_prestasi">Nama Prestasi</label>
            <input type="text" name="nama_prestasi" id="nama_prestasi" class="w-full border rounded px-3 py-2" value="{{ old('nama_prestasi') }}">
        </div>

        <!-- Tingkat Prestasi -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="tingkat">Tingkat</label>
            <input type="text" name="tingkat" id="tingkat" class="w-full border rounded px-3 py-2" placeholder="Lokal/Nasional/Internasional" value="{{ old('tingkat') }}">
        </div>

        <!-- Tahun Prestasi -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="tahun">Tahun</label>
            <input type="number" name="tahun" id="tahun" class="w-full border rounded px-3 py-2" value="{{ old('tahun') }}">
        </div>

        <!-- File Sertifikat -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="file_sertifikat">Upload Sertifikat / Dokumen</label>
            <input type="file" name="file_sertifikat" id="file_sertifikat" class="w-full">
            <small class="text-gray-500">Format: PDF, JPG, JPEG, PNG</small>
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Prestasi
            </button>
            <a href="{{ route('admin.verifikasiPrestasi.index') }}" class="ml-2 text-gray-700 hover:underline">Kembali</a>
        </div>
    </form>
</div>
@endsection
