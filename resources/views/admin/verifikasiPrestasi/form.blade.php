@extends('layouts.admin')

@section('title', 'Detail Prestasi')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-semibold mb-4">Detail Prestasi</h1>

    <div class="bg-white shadow rounded p-6 mb-4">
        <div class="flex items-start gap-6">
            <div class="flex-1">
                <h2 class="text-lg font-bold">{{ $prestasi->nama_prestasi }}</h2>
                <p class="text-sm text-gray-600">{{ ucfirst($prestasi->jenis) }} — {{ $prestasi->tingkat ?? '-' }} — {{ $prestasi->tahun ?? '-' }}</p>
                <p class="mt-3 text-gray-700">{{ $prestasi->user->name }} (NIM: {{ $prestasi->user->nim ?? '-' }})</p>
            </div>
            @if($prestasi->file_sertifikat)
            <div>
                <a href="{{ route('admin.verifikasiPrestasi.bukti', $prestasi->id) }}" target="_blank" class="px-3 py-2 bg-gray-100 rounded text-sm">Lihat Dokumen</a>
            </div>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.verifikasiPrestasi.updateStatus', $prestasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white shadow rounded p-6">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="menunggu" {{ $prestasi->status=='menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="valid" {{ $prestasi->status=='valid' ? 'selected' : '' }}>Valid</option>
                    <option value="invalid" {{ $prestasi->status=='invalid' ? 'selected' : '' }}>Invalid</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Catatan Admin</label>
                <textarea name="catatan_admin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="4">{{ old('catatan_admin', $prestasi->catatan_admin ?? '') }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Kirim Validasi</button>
            </div>
        </div>
    </form>
</div>

@endsection
