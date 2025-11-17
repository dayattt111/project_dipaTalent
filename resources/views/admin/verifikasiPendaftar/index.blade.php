{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="flex min-h-screen bg-gray-50">

    {{-- Main Content --}}
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4">
                <p class="text-[#121217] tracking-light text-[32px] font-bold leading-tight min-w-72">
                    Kelola Pendaftaran Beasiswa
                </p>
                <a href="{{ route('admin.pendaftaran.create') }}"
                    class="bg-[#1e40ae] text-white text-sm font-bold px-4 py-2 rounded-lg hover:bg-[#16348f]">
                        + Tambah Pendaftar
                </a>
            </div>
            <div class="px-4 py-3 @container">
              <div class="flex overflow-hidden rounded-lg border border-[#dcdce5] bg-white">
                <table class="flex-1">
                  <thead>
                    <tr class="bg-white">
                        <th class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-120 px-4 py-3 text-left text-[#121217] w-[400px] text-sm font-medium leading-normal">
                            Nim
                        </th>
                      <th class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-120 px-4 py-3 text-left text-[#121217] w-[400px] text-sm font-medium leading-normal">
                        Nama Mahasiswa
                      </th>
                      <th class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-240 px-4 py-3 text-left text-[#121217] w-[400px] text-sm font-medium leading-normal">
                        Nama Beasiswa
                      </th>
                      <th class="table-5336220f-7ace-4efa-803e-5a450cb68363-column-240 px-4 py-3 text-left text-[#121217] w-[400px] text-sm font-medium leading-normal">
                        Catatan
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
                @foreach ($pendaftaran as $data)
                <tr class="border-t border-t-[#dcdce5]">
                    <td class="px-4 py-2 text-[#121217] text-sm">{{ $data->user->nim }}</td>
                    <td class="px-4 py-2 text-[#121217] text-sm">{{ $data->user->name }}</td>
                    <td class="px-4 py-2 text-[#656586] text-sm">{{ $data->beasiswa->nama_beasiswa }}</td>
                    <td class="px-4 py-2 text-[#656586] text-sm">{{ $data->catatan_admin }}</td>

                    <td class="px-4 py-2 text-sm">
                        <button
                            class="flex items-center justify-center h-8 px-4 rounded-lg 
                            {{ $data->status === 'diterima' ? 'bg-green-100 text-green-800' : ($data->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ ucfirst($data->status) }}
                        </button>
                    </td>

                    <td class="px-4 py-2 text-sm font-bold">

                        {{-- Jika belum diverifikasi → buka form --}}
                        @if($data->status === 'menunggu')
                            <a href="{{ route('admin.verifikasiPendaftar.form', $data->id) }}"
                            class="text-[#1e40ae] hover:underline">
                            Verifikasi
                            </a>

                        {{-- Jika sudah diterima atau ditolak → tombol batal (popup) --}}
                        @else
                            <form action="{{ route('admin.verifikasiPendaftar.batal', $data->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:underline">
                                Batalkan
                            </button>
                        </form>

                        @endif

                            {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.pendaftaran.delete', $data->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-700 hover:underline" onclick="return confirm('Hapus pendaftar ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
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

{{-- Popup HAPUS --}}
<div id="popup-delete" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-xl shadow-lg w-[90%] max-w-md p-6 text-center">
    <h2 class="text-lg font-semibold text-[#121317] mb-4">Hapus Pendaftar?</h2>
    <p class="text-sm text-gray-600 mb-6">Data pendaftar akan dihapus permanen.</p>

    <div class="flex justify-center gap-4">
      <button onclick="closePopupDelete()"
              class="px-4 py-2 bg-gray-200 rounded-lg text-gray-800 text-sm font-medium hover:bg-gray-300">
        Batal
      </button>

      <form id="popup-delete-form" method="POST" action="">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-4 py-2 bg-red-600 rounded-lg text-white text-sm font-bold hover:bg-red-700">
          Hapus
        </button>
      </form>
    </div>
  </div>
</div>


</div>

  {{-- Popup Logic --}}
<script>
function openPopup(id) {
    const popup = document.getElementById('popup-modal');
    const title = document.getElementById('popup-title');
    const text = document.getElementById('popup-text');
    const form = document.getElementById('popup-form');

    title.innerText = 'Batalkan Verifikasi?';
    text.innerText = 'Status akan dikembalikan menjadi MENUNGGU.';

    // URL BENAR
    form.action = "{{ url('admin/batal') }}/" + id;

    popup.classList.remove('hidden');
}

function closePopup() {
    document.getElementById('popup-modal').classList.add('hidden');
}


function openPopupDelete(id) {
    const popup = document.getElementById('popup-delete');
    const form = document.getElementById('popup-delete-form');

    form.action = "{{ url('admin/pendaftaran/delete') }}/" + id;
    popup.classList.remove('hidden');
}

function closePopupDelete() {
    document.getElementById('popup-delete').classList.add('hidden');
}
</script>


</div>
@endsection
