@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-6">
    <h2 class="text-2xl font-bold mb-6">Atur Bobot SAW (Input Awal)</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.bobot.store') }}" method="POST">
        @csrf

        @foreach ($kriterias as $kriteria)
            <div class="mb-4">
                <label class="block font-semibold mb-1">{{ $kriteria['nama'] }}</label>
                <input
                    type="number"
                    name="bobot[{{ $loop->index }}]"
                    value="{{ old('bobot.' . $loop->index) }}"
                    step="0.01"
                    class="w-full border p-3 rounded"
                    placeholder="Masukkan bobot (misal: 20)"
                    required
                >
                <input type="hidden" name="nama_kriteria[{{ $loop->index }}]" value="{{ $kriteria['nama'] }}">
                <input type="hidden" name="tipe[{{ $loop->index }}]" value="benefit">
            </div>
        @endforeach

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Bobot
        </button>
    </form>
</div>
@endsection
