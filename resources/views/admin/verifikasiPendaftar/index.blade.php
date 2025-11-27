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
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $data->status === 'diterima' ? 'bg-green-100 text-green-800' : ($data->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($data->status ?? 'menunggu') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            @if($data->status === 'menunggu')
                            <a href="{{ route('admin.verifikasiPendaftar.form', $data->id) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 hover:bg-blue-200 rounded-lg text-xs font-medium transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10.5 10.5a.5.5 0 0 1-.168.11l-5 1.667a.5.5 0 0 1-.65-.65l1.667-5a.5.5 0 0 1 .11-.168l10.5-10.5z"/>
                                </svg>
                                Verifikasi
                            </a>
                            @else
                            <form action="{{ route('admin.verifikasiPendaftar.batal', $data->id) }}" method="POST" class="inline" onsubmit="return confirm('Batalkan verifikasi?')">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-amber-100 text-amber-800 hover:bg-amber-200 rounded-lg text-xs font-medium transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    </svg>
                                    Batalkan
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.pendaftaran.delete', $data->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pendaftar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 hover:bg-red-200 rounded-lg text-xs font-medium transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
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
