@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-6">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Pendaftar Baru</h2>

    <form action="{{ route('admin.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- PILIH USER -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Pilih User</label>
            <select id="userSelect" name="user_id" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih User --</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- NIM AUTO -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">NIM</label>
            <input id="nimField" name="nim" type="text"
                class="w-full rounded-lg border-gray-300 bg-gray-100 text-gray-700"
                readonly>
        </div>

        <!-- PILIH BEASISWA -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Pilih Beasiswa</label>
            <select name="beasiswa_id" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Pilih Beasiswa --</option>
                @foreach ($beasiswa as $bs)
                    <option value="{{ $bs->id }}">{{ $bs->nama_beasiswa }}</option>
                @endforeach
            </select>
        </div>

        <!-- IPK -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">IPK</label>
            <input type="number" step="0.01" max="4" name="ipk"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Prestasi -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Prestasi</label>
            <textarea name="prestasi"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 h-24"></textarea>
        </div>

        <!-- Organisasi -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Organisasi</label>
            <textarea name="organisasi"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 h-24"></textarea>
        </div>

        <!-- Keterampilan -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Keterampilan</label>
            <textarea name="keterampilan"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 h-24"></textarea>
        </div>

        <!-- Transkrip -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Upload Transkrip</label>
            <input type="file" name="transkrip"
                class="w-full block text-gray-700 border-gray-300 rounded-lg focus:ring-blue-500" required>
        </div>

        <!-- Foto -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-1">Upload Foto</label>
            <input type="file" name="foto"
                class="w-full block text-gray-700 border-gray-300 rounded-lg focus:ring-blue-500" required>
        </div>

        <div class="flex justify-between">
            <button type="submit"
                class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>

            <a href="{{ route('admin.verifikasiPendaftar.index') }}"
                class="px-5 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                Batal
            </a>
        </div>

    </form>
</div>

{{-- AJAX UNTUK AMBIL NIM USER --}}
<script>
document.getElementById('userSelect').addEventListener('change', function () {
    let userId = this.value;

    if (userId) {
        fetch(`/admin/get-user/${userId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('nimField').value = data.nim ?? '';
            })
            .catch(err => console.error('Error:', err));
    } else {
        document.getElementById('nimField').value = '';
    }
});
</script>

@endsection
