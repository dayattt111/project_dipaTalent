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
          {{-- <tbody>
            @foreach ($pendaftaran as $data)
            <tr class="border-t border-t-[#dcdce5]">
              <td class="px-4 py-2 text-[#121217] text-sm">{{ $data->user->name }}</td>
              <td class="px-4 py-2 text-[#656586] text-sm">{{ $data->beasiswa->nama_beasiswa }}</td>
              <td class="px-4 py-2 text-sm">
                <button
                  class="flex items-center justify-center h-8 px-4 rounded-lg 
                  {{ $data->status === 'diterima' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                  {{ ucfirst($data->status) }}
                </button>
              </td>
<td class="px-4 py-2 text-sm text-blue-600 font-bold">
  @if($data->status !== 'diterima')
    <a href="{{ route('admin.verifikasiPendaftar.form', $data->id) }}" 
       class="hover:underline text-[#1e40ae]">
       Verifikasi
    </a>
  @else
    <form method="POST" action="{{ route('admin.verifikasiPendaftar.verifikasi', $data->id) }}">
      @csrf
      <button type="submit" class="text-red-600 hover:underline">Batalkan</button>
    </form>
  @endif
</td>
            </tr>
            @endforeach
          </tbody> --}}

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

  {{-- Popup Modal --}}
  <div id="popup-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-[90%] max-w-md p-6 text-center">
      <h2 id="popup-title" class="text-lg font-semibold text-[#121317] mb-4"></h2>
      <p id="popup-text" class="text-sm text-gray-600 mb-6"></p>

      <div class="flex justify-center gap-4">
        <button onclick="closePopup()" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-800 text-sm font-medium hover:bg-gray-300">
          Batal
        </button>

        <form id="popup-form" method="POST" action="">
          @csrf
          <button type="submit" class="px-4 py-2 bg-[#1e40ae] rounded-lg text-white text-sm font-bold hover:bg-[#16348f]">
            Lanjutkan
          </button>
        </form>
      </div>
    </div>
  </div>

</div>

  {{-- Popup Logic --}}
  <script>
    function openPopup(id, status) {
      const popup = document.getElementById('popup-modal');
      const title = document.getElementById('popup-title');
      const text = document.getElementById('popup-text');
      const form = document.getElementById('popup-form');

      if (status === 'diterima') {
        title.innerText = 'Batalkan Verifikasi?';
        text.innerText = 'Apakah Anda yakin ingin membatalkan verifikasi pendaftar ini?';
      } else {
        title.innerText = 'Verifikasi Pendaftar';
        text.innerText = 'Apakah Anda yakin ingin memverifikasi pendaftar ini?';
      }

      form.action = `{{ url('admin/verifikasi-pendaftar') }}/${id}`; // ganti sesuai route
      popup.classList.remove('hidden');
    }

    function closePopup() {
      document.getElementById('popup-modal').classList.add('hidden');
    }
  </script>

</div>
@endsection
