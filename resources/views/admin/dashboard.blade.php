{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="flex min-h-screen bg-gray-50">

    {{-- Main Content --}}
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4"><p class="text-[#121217] tracking-light text-[32px] font-bold leading-tight min-w-72">Kelola Beasiswa</p></div>
            <div class="px-4 py-3 @container">
              <div class="flex overflow-hidden rounded-lg border border-[#dcdce5] bg-white">
                <table class="flex-1">
                  <thead>
                    <tr class="bg-white">
                      <th class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-120 px-4 py-3 text-left text-[#121217] w-[400px] text-sm font-medium leading-normal">
                        Nama Mahasiswa
                      </th>
                      <th class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-240 px-4 py-3 text-left text-[#121217] w-[400px] text-sm font-medium leading-normal">
                        Nama Beasiswa
                      </th>
                      <th class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-360 px-4 py-3 text-left text-[#121217] w-60 text-sm font-medium leading-normal">
                        Status Dokumen
                      </th>
                      <th class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-480 px-4 py-3 text-left text-[#121217] w-60 text-[#656586] text-sm font-medium leading-normal">
                        Aksi
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="border-t border-t-[#dcdce5]">
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-120 h-[72px] px-4 py-2 w-[400px] text-[#121217] text-sm font-normal leading-normal">
                        Budi Santoso
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-240 h-[72px] px-4 py-2 w-[400px] text-[#656586] text-sm font-normal leading-normal">
                        Beasiswa Prestasi Akademik
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-360 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f0f0f4] text-[#121217] text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Terverifikasi</span>
                        </button>
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-480 h-[72px] px-4 py-2 w-60 text-[#656586] text-sm font-bold leading-normal tracking-[0.015em]">
                        Verifikasi
                      </td>
                    </tr>
                    <tr class="border-t border-t-[#dcdce5]">
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-120 h-[72px] px-4 py-2 w-[400px] text-[#121217] text-sm font-normal leading-normal">
                        Siti Rahayu
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-240 h-[72px] px-4 py-2 w-[400px] text-[#656586] text-sm font-normal leading-normal">
                        Beasiswa Bakat Seni
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-360 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f0f0f4] text-[#121217] text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Menunggu Verifikasi</span>
                        </button>
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-480 h-[72px] px-4 py-2 w-60 text-[#656586] text-sm font-bold leading-normal tracking-[0.015em]">
                        Verifikasi
                      </td>
                    </tr>
                    <tr class="border-t border-t-[#dcdce5]">
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-120 h-[72px] px-4 py-2 w-[400px] text-[#121217] text-sm font-normal leading-normal">
                        Ahmad Fadil
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-240 h-[72px] px-4 py-2 w-[400px] text-[#656586] text-sm font-normal leading-normal">
                        Beasiswa Olahraga
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-360 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f0f0f4] text-[#121217] text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Terverifikasi</span>
                        </button>
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-480 h-[72px] px-4 py-2 w-60 text-[#656586] text-sm font-bold leading-normal tracking-[0.015em]">
                        Verifikasi
                      </td>
                    </tr>
                    <tr class="border-t border-t-[#dcdce5]">
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-120 h-[72px] px-4 py-2 w-[400px] text-[#121217] text-sm font-normal leading-normal">
                        Dewi Lestari
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-240 h-[72px] px-4 py-2 w-[400px] text-[#656586] text-sm font-normal leading-normal">
                        Beasiswa Kepemimpinan
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-360 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f0f0f4] text-[#121217] text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Menunggu Verifikasi</span>
                        </button>
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-480 h-[72px] px-4 py-2 w-60 text-[#656586] text-sm font-bold leading-normal tracking-[0.015em]">
                        Verifikasi
                      </td>
                    </tr>
                    <tr class="border-t border-t-[#dcdce5]">
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-120 h-[72px] px-4 py-2 w-[400px] text-[#121217] text-sm font-normal leading-normal">
                        Rizki Pratama
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-240 h-[72px] px-4 py-2 w-[400px] text-[#656586] text-sm font-normal leading-normal">
                        Beasiswa Riset
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-360 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f0f0f4] text-[#121217] text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Terverifikasi</span>
                        </button>
                      </td>
                      <td class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-480 h-[72px] px-4 py-2 w-60 text-[#656586] text-sm font-bold leading-normal tracking-[0.015em]">
                        Verifikasi
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <style>
                @container(max-width:120px){.table-5336220f-7ace-4efa-803e-5a450cb68363-column-120{display: none;}}
                @container(max-width:240px){.table-5336220f-7ace-4efa-803e-5a450cb68363-column-240{display: none;}}
                @container(max-width:360px){.table-5336220f-7ace-4efa-803e-5a450cb68363-column-360{display: none;}}
                @container(max-width:480px){.table-5336220f-7ace-4efa-803e-5a450cb68363-column-480{display: none;}}
              </style>
            </div>
          </div>
          
    {{-- Sidebar Admin --}}
    @include('layouts.navigation')

</div>
@endsection
