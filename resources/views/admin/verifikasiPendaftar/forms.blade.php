@extends('layouts.admin')

@section('content')
<div class="layout-content-container flex flex-col max-w-[960px] flex-1">

  <div class="flex flex-wrap justify-between gap-3 p-4">
    <p class="text-[#121317] tracking-light text-[32px] font-bold leading-tight min-w-72">Verifikasi Pendaftaran</p>
  </div>

  <h3 class="text-[#121317] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Detail Pendaftar</h3>

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
      </div>

      <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1"
        style='background-image: url("{{ $pendaftaran->foto ?? 'https://via.placeholder.com/300x200' }}");'>
      </div>
    </div>
  </div>

  <div class="p-4 grid grid-cols-2">
    <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pr-2">
      <p class="text-[#656d86] text-sm font-normal leading-normal">IPK</p>
      <p class="text-[#121317] text-sm font-normal leading-normal">{{ $pendaftaran->ipk ?? '-' }}</p>
    </div>

    <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pl-2">
      <p class="text-[#656d86] text-sm font-normal leading-normal">Prestasi</p>
      <p class="text-[#121317] text-sm font-normal leading-normal">{{ $pendaftaran->prestasi ?? '-' }}</p>
    </div>

    <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pr-2">
      <p class="text-[#656d86] text-sm font-normal leading-normal">Pengalaman Organisasi</p>
      <p class="text-[#121317] text-sm font-normal leading-normal">{{ $pendaftaran->organisasi ?? '-' }}</p>
    </div>

    <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pl-2">
      <p class="text-[#656d86] text-sm font-normal leading-normal">Keterampilan Khusus</p>
      <p class="text-[#121317] text-sm font-normal leading-normal">{{ $pendaftaran->keterampilan ?? '-' }}</p>
    </div>

    <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pr-2">
      <p class="text-[#656d86] text-sm font-normal leading-normal">Transkrip Nilai</p>
      <a href="{{ asset('storage/'.$pendaftaran->transkrip) }}" target="_blank" class="text-[#1e40ae] underline">Unduh</a>
    </div>

    <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pl-2">
      <p class="text-[#656d86] text-sm font-normal leading-normal">Catatan Admin</p>
      <textarea name="catatan_admin" class="border rounded-lg p-2 text-sm text-[#121317]" placeholder="Tambahkan catatan..."></textarea>
    </div>
  </div>

  <div class="flex justify-stretch">
    <div class="flex flex-1 gap-3 flex-wrap px-4 py-3 justify-end">
      <form method="POST" action="{{ route('admin.verifikasiPendaftaran.submit', $pendaftaran->id) }}">
        @csrf
        <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#1e40ae] text-white text-sm font-bold leading-normal tracking-[0.015em]">
          <span class="truncate">Setujui</span>
        </button>
      </form>

      <a href="{{ route('admin.dashboard') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#f0f1f4] text-[#121317] text-sm font-bold leading-normal tracking-[0.015em]">
        <span class="truncate">Tolak</span>
      </a>
    </div>
  </div>
</div>
@endsection
