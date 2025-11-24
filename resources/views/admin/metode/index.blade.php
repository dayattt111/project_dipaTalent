@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-6">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Bobot Kriteria</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border p-3">No</th>
                <th class="border p-3">Nama Kriteria</th>
                <th class="border p-3">Bobot</th>
                <th class="border p-3">Tipe</th>
                <th class="border p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($kriterias as $k)
                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $loop->iteration }}</td>
                    <td class="border p-3">{{ $k->nama_kriteria }}</td>
                    <td class="border p-3">{{ $k->bobot }}</td>
                    <td class="border p-3 capitalize">{{ $k->tipe }}</td>
                    <td class="border p-3">
                        <a href="{{ route('admin.metode.edit', $k->id) }}"
                           class="px-3 py-1 bg-blue-600 rounded text-white text-sm hover:bg-blue-700">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
