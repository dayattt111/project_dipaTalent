@extends('layouts.admin')

@section('content')
<div class="layout-content-container flex flex-col max-w-[960px] flex-1">
    <div class="flex flex-wrap justify-between gap-3 p-4">
        <p class="text-[#121317] tracking-light text-[32px] font-bold leading-tight min-w-72">
            Verifikasi Pendaftaran
        </p>
    </div>

    <h3 class="text-[#121317] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">
        Detail Pendaftar
    </h3>

    <div class="p-4">
        <div class="flex items-stretch justify-between gap-4 rounded-lg">
            <div class="flex flex-[2_2_0px] flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <p class="text-[#121317] text-base font-bold leading-tight">{{ $pendaftaran->user->name }}</p>
                    <p class="text-[#656d86] text-sm font-normal leading-normal">NIM: {{ $pendaftaran->user->nim }}</p>
                </div>
                <button class="flex items-center justify-center h-8 px-4 bg-[#f0f1f4] text-[#121317] text-sm font-medium leading-normal rounded-lg">
                    {{ $pendaftaran->beasiswa->nama_beasiswa }}
                </button>
            </div>
            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1"
                 style="background-image: url('{{ asset('storage/'.$pendaftaran->user->foto ?? 'default.jpg') }}');">
            </div>
        </div>
    </div>

    <div class="p-4 grid grid-cols-2">
        <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pr-2">
            <p class="text-[#656d86] text-sm">IPK</p>
            <p class="text-[#121317] text-sm">{{ $pendaftaran->ipk ?? '-' }}</p>
        </div>

        <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pl-2">
            <p class="text-[#656d86] text-sm">Prestasi</p>
            <p class="text-[#121317] text-sm">{{ $pendaftaran->prestasi ?? '-' }}</p>
        </div>

        <div class="flex flex-col gap-1 border-t border-solid border-t-[#dcdee5] py-4 pr-2">
            <p class="text-[#656d86] text-sm">Catatan Admin</p>
            <textarea class="border rounded-lg p-2 text-sm w-full" placeholder="Tambahkan catatan..."></textarea>
        </div>
    </div>

    <div class="flex justify-stretch">
        <div class="flex flex-1 gap-3 flex-wrap px-4 py-3 justify-end">
            <form method="POST" action="{{ route('admin.verifikasiPendaftar.verifikasi', $pendaftaran->id) }}">
                @csrf
                <button type="submit" class="h-10 px-4 bg-[#1e40ae] text-white text-sm font-bold rounded-lg">
                    Setujui
                </button>
            </form>
            <a href="{{ route('admin.dashboard') }}"
               class="h-10 px-4 bg-[#f0f1f4] text-[#121317] text-sm font-bold rounded-lg flex items-center">
               Kembali
            </a>
        </div>
    </div>
</div>
@endsection
