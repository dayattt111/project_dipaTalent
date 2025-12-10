@extends('layouts.admin')

@section('content')
<div class="layout-content-container flex flex-col max-w-[960px] flex-1">

  <div class="flex flex-wrap justify-between gap-3 p-4">
    <p class="text-[#121317] tracking-light text-[32px] font-bold leading-tight min-w-72">
      Verifikasi Pendaftaran
    </p>
  </div>

  <form method="POST" action="{{ route('admin.verifikasiPendaftar.verifikasi', $pendaftaran->id) }}">
    @csrf

    <h3 class="text-[#121317] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">
      Detail Pendaftar
    </h3>

    <div class="p-4">
      <div class="flex items-stretch justify-between gap-4 rounded-lg">
        
        <div class="flex flex-[2_2_0px] flex-col gap-4">
          <div class="flex flex-col gap-1">
            <p class="text-[#121317] text-base font-bold leading-tight">{{ $pendaftaran->user->name }}</p>
            <p class="text-[#656d86] text-sm font-normal leading-normal">NIM: {{ $pendaftaran->user->nim ?? '-' }}</p>
          </div>

          <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 flex-row-reverse bg-[#f0f1f4] text-[#121317] text-sm font-medium leading-normal w-fit">
            <span class="truncate">{{ $pendaftaran->beasiswa->nama_beasiswa }}</span>
          </button>

          <!-- Poin Mahasiswa Card -->
          <div class="bg-gradient-to-r from-indigo-500 to-blue-600 rounded-lg p-4 text-white">
            <div class="flex items-center justify-between mb-3">
              <div>
                <p class="text-sm text-indigo-100 mb-1">Total Poin Mahasiswa</p>
                <p class="text-3xl font-bold">{{ number_format($skorSaw->nilai_akhir ?? 0, 0) }}</p>
              </div>
              <div class="text-center bg-white bg-opacity-20 rounded-lg px-3 py-2">
                <p class="text-xs text-indigo-100">Peringkat</p>
                <p class="text-2xl font-bold">#{{ $leaderboard->peringkat ?? '-' }}</p>
              </div>
            </div>
            <div class="border-t border-white border-opacity-20 pt-2 text-xs text-indigo-100">
              <p>Poin dihitung otomatis berdasarkan prestasi dan pencapaian mahasiswa</p>
            </div>
          </div>
        </div>

        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1"
          style='background-image: url("{{ $pendaftaran->foto ?? 'https://via.placeholder.com/300x200' }}");'>
        </div>

      </div>
    </div>

    <!-- Detail Breakdown Poin -->
    <div class="mx-4 mb-4 bg-gray-50 rounded-lg p-4">
      <h4 class="text-sm font-bold text-gray-900 mb-3">📊 Rincian Poin Mahasiswa</h4>
      <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        <div class="bg-white rounded-lg p-3 border border-gray-200">
          <p class="text-xs text-gray-600 mb-1">IPK</p>
          <p class="text-lg font-bold text-gray-900">{{ number_format($detailPoin['ipk'], 2) }}</p>
        </div>
        <div class="bg-white rounded-lg p-3 border border-gray-200">
          <p class="text-xs text-gray-600 mb-1">Prestasi Akademik</p>
          <p class="text-lg font-bold text-green-600">{{ $detailPoin['prestasi_akademik'] }} poin</p>
        </div>
        <div class="bg-white rounded-lg p-3 border border-gray-200">
          <p class="text-xs text-gray-600 mb-1">Prestasi Non-Akademik</p>
          <p class="text-lg font-bold text-blue-600">{{ $detailPoin['prestasi_non_akademik'] }} poin</p>
        </div>
        <div class="bg-white rounded-lg p-3 border border-gray-200">
          <p class="text-xs text-gray-600 mb-1">Organisasi</p>
          <p class="text-lg font-bold text-purple-600">{{ $detailPoin['organisasi'] }} aktif</p>
        </div>
        <div class="bg-white rounded-lg p-3 border border-gray-200">
          <p class="text-xs text-gray-600 mb-1">Sertifikasi</p>
          <p class="text-lg font-bold text-indigo-600">{{ $detailPoin['sertifikasi'] }} poin</p>
        </div>
      </div>
    </div>

    <div class="p-4 grid grid-cols-2">
      
      <div class="flex flex-col gap-1 border-t py-4 pr-2">
        <p class="text-[#656d86] text-sm">IPK</p>
        <input type="text" name="ipk" class="border p-2 rounded-lg text-sm"
               value="{{ old('ipk', $pendaftaran->ipk) }}">
      </div>

      <div class="flex flex-col gap-1 border-t py-4 pl-2">
        <p class="text-[#656d86] text-sm">Prestasi</p>
        <input type="text" name="prestasi" class="border p-2 rounded-lg text-sm"
               value="{{ old('prestasi', $pendaftaran->prestasi) }}">
      </div>

      <div class="flex flex-col gap-1 border-t py-4 pr-2">
        <p class="text-[#656d86] text-sm">Organisasi</p>
        <input type="text" name="organisasi" class="border p-2 rounded-lg text-sm"
               value="{{ old('organisasi', $pendaftaran->organisasi) }}">
      </div>

      <div class="flex flex-col gap-1 border-t py-4 pl-2">
        <p class="text-[#656d86] text-sm">Keterampilan</p>
        <input type="text" name="keterampilan" class="border p-2 rounded-lg text-sm"
               value="{{ old('keterampilan', $pendaftaran->keterampilan) }}">
      </div>

      <div class="flex flex-col gap-1 border-t py-4 pr-2">
        <p class="text-[#656d86] text-sm">Transkrip Nilai</p>
        <a href="{{ asset('storage/'.$pendaftaran->transkrip) }}" target="_blank"
           class="text-[#1e40ae] underline">Unduh</a>
      </div>

      <div class="flex flex-col gap-1 border-t py-4 pl-2">
        <p class="text-[#656d86] text-sm">Catatan Admin</p>
        <textarea name="catatan_admin" class="border rounded-lg p-2 text-sm text-[#121317]"
          placeholder="Tambahkan catatan...">{{ old('catatan_admin', $pendaftaran->catatan_admin) }}</textarea>
      </div>

      <input type="hidden" name="status" value="setujui">

    </div>

    <div class="flex justify-end px-4 py-3">
      <button class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-[#1e40ae] text-white text-sm font-bold">
        Setujui
      </button>
    </div>

  </form>

</div>
@endsection
