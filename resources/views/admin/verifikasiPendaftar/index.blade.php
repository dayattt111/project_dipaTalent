@extends('layouts.admin')

@section('title', 'Verifikasi Pendaftaran')

@section('content')
<div class="max-w-7xl">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Verifikasi Pendaftaran</h1>
            <p class="text-gray-600 mt-1">Kelola verifikasi pendaftaran beasiswa mahasiswa</p>
        </div>
        <a href="{{ route('admin.pendaftaran.create') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Tambah Pendaftar
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">NIM</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Mahasiswa</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Beasiswa</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Catatan</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($pendaftaran as $data)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $data->user->nim ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $data->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ optional($data->beasiswa)->nama_beasiswa ?? optional($data->beasiswa)->judul ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $data->catatan_admin ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $data->status_admin === 'verified' ? 'bg-green-100 text-green-800' : ($data->status_admin === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $data->status_admin ?? 'pending')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            <a href="{{ route('admin.verifikasiPendaftar.form', $data->id) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 hover:bg-blue-200 rounded-lg text-xs font-medium transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                </svg>
                                Lihat
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Empty State --}}
    @if(count($pendaftaran) === 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-400 mb-3">
            <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
        </svg>
        <p class="text-gray-600">Tidak ada pendaftaran untuk diverifikasi</p>
    </div>
    @endif
</div>

@endsection

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
