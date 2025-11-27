@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-semibold mb-4">Edit Pengguna</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2">
            @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">NIM (opsional)</label>
            <input type="text" name="nim" value="{{ old('nim', $user->nim) }}" class="w-full border rounded px-3 py-2">
            @error('nim') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2">
            @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Password (kosongkan bila tidak diubah)</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2">
                @error('password') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Role</label>
            <select name="role" class="w-full border rounded px-3 py-2">
                <option value="mahasiswa" {{ $user->role=='mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="umum" {{ $user->role=='umum' ? 'selected' : '' }}>Umum</option>
            </select>
        </div>

        <div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="ml-2 text-sm text-gray-600">Batal</a>
        </div>
    </form>
</div>

@endsection
