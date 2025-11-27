@extends('layouts.admin')

@section('title', 'Kelola Beasiswa')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Kelola Beasiswa</h1>
        <a href="{{ route('admin.kelolaBeasiswa.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Beasiswa</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full divide-y">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nama Beasiswa</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Kuota</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Periode</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @foreach($beasiswas as $beasiswa)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration + ($beasiswas->currentPage()-1)*$beasiswas->perPage() }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $beasiswa->nama_beasiswa }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $beasiswa->kuota }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $beasiswa->tanggal_mulai->format('d M Y') }} - {{ $beasiswa->tanggal_selesai->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $beasiswa->status }}</td>
                    <td class="px-6 py-4 text-sm text-right">
                        <a href="{{ route('admin.kelolaBeasiswa.edit', $beasiswa->id) }}" class="inline-block px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded">Edit</a>
                        <form action="{{ route('admin.kelolaBeasiswa.destroy', $beasiswa->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus beasiswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $beasiswas->links() }}
    </div>
</div>

@endsection
