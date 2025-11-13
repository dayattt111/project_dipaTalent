{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="flex flex-col min-h-screen bg-gray-50">

    {{-- Fixed Top Navigation --}}
    {{-- <nav class="fixed top-0 left-0 w-full bg-white shadow z-50">
        <div class="flex items-center justify-between px-6 py-3">
            <div>
                <h1 class="text-[#121317] text-base font-semibold">DipaTalent Admin</h1>
                <p class="text-[#656d86] text-sm">Universitas Dipa Makassar</p>
            </div>
            <div class="flex gap-4">
                <a href="#" class="text-[#121317] text-sm font-medium hover:text-blue-600">Kelola Beasiswa</a>
                <a href="#" class="text-[#121317] text-sm font-medium hover:text-blue-600">Verifikasi</a>
                <a href="#" class="text-[#121317] text-sm font-medium hover:text-blue-600">Validasi</a>
                <a href="#" class="text-[#121317] text-sm font-medium hover:text-blue-600">Bobot SAW</a>
                <a href="#" class="text-[#121317] text-sm font-medium hover:text-blue-600">Laporan</a>
            </div>
        </div>
    </nav> --}}

    {{-- Main Content --}}
    <main class="flex-1 mt-24 px-6">
        <div class="layout-content-container flex flex-col max-w-[960px] mx-auto">
            
            <div class="flex flex-wrap justify-between gap-3 p-4">
                <p class="text-[#121217] tracking-light text-[32px] font-bold leading-tight min-w-72">
                    Kelola Beasiswa
                </p>
            </div>

            <div class="px-4 py-3 @container">
                <div class="flex overflow-hidden rounded-lg border border-[#dcdce5] bg-white">
                    <table class="flex-1">
                        <thead>
                            <tr class="bg-white">
                                <th class="px-4 py-3 text-left text-[#121217] w-[400px] text-sm font-medium leading-normal">Nama Mahasiswa</th>
                                <th class="px-4 py-3 text-left text-[#121217] w-[400px] text-sm font-medium leading-normal">Nama Beasiswa</th>
                                <th class="px-4 py-3 text-left text-[#121217] w-60 text-sm font-medium leading-normal">Status Dokumen</th>
                                <th class="px-4 py-3 text-left text-[#121217] w-60 text-[#656586] text-sm font-medium leading-normal">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-t-[#dcdce5]">
                                <td class="h-[72px] px-4 py-2 text-[#121217] text-sm font-normal">Budi Santoso</td>
                                <td class="h-[72px] px-4 py-2 text-[#656586] text-sm font-normal">Beasiswa Prestasi Akademik</td>
                                <td class="h-[72px] px-4 py-2">
                                    <button class="flex items-center justify-center h-8 px-4 rounded-lg bg-[#f0f1f4] text-[#121217] text-sm font-medium">
                                        Terverifikasi
                                    </button>
                                </td>
                                <td class="h-[72px] px-4 py-2 text-[#656586] text-sm font-bold">Verifikasi</td>
                            </tr>
                            <tr class="border-t border-t-[#dcdce5]">
                                <td class="h-[72px] px-4 py-2 text-[#121217] text-sm font-normal">Siti Rahayu</td>
                                <td class="h-[72px] px-4 py-2 text-[#656586] text-sm font-normal">Beasiswa Bakat Seni</td>
                                <td class="h-[72px] px-4 py-2">
                                    <button class="flex items-center justify-center h-8 px-4 rounded-lg bg-[#f0f1f4] text-[#121217] text-sm font-medium">
                                        Menunggu Verifikasi
                                    </button>
                                </td>
                                <td class="h-[72px] px-4 py-2 text-[#656586] text-sm font-bold">Verifikasi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Responsive Column Hide Rules --}}
                <style>
                    @container(max-width:120px){th:nth-child(1),td:nth-child(1){display:none}}
                    @container(max-width:240px){th:nth-child(2),td:nth-child(2){display:none}}
                    @container(max-width:360px){th:nth-child(3),td:nth-child(3){display:none}}
                    @container(max-width:480px){th:nth-child(4),td:nth-child(4){display:none}}
                </style>
            </div>
        </div>
    </main>
    
    {{-- Sidebar Admin --}}
    @include('layouts.navigation')
</div>
@endsection
