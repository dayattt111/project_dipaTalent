@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Kelola Pengguna</h1>
    <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Buat Pengguna</a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
@endif

<div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full divide-y">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">NIM</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Role</th>
                <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y">
            @foreach($users as $user)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $user->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->nim }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->role }}</td>
                <td class="px-6 py-4 text-sm text-right">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-block px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pengguna ini?')">
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
    {{ $users->links() }}
</div>

@endsection
