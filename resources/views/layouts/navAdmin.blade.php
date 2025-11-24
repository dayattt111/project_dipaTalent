{{-- resources/views/layouts/navigation.blade.php --}}
<div class="flex flex-col w-80 bg-white p-4 min-h-screen justify-between">
  <div class="flex flex-col gap-4">
    <div class="flex flex-col">
      <h1 class="text-[#121217] text-base font-medium">DipaTalent Admin</h1>
      <p class="text-[#656586] text-sm">Universitas Dipa Makassar</p>
    </div>

    {{-- MENU --}}
    <div class="flex flex-col gap-2">
      
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-dropdown-link :href="route('logout')"
              onclick="event.preventDefault(); this.closest('form').submit();">
              {{-- {{ __('Log Out') }} --}}
              Logou
          </x-dropdown-link>
      </form>

      <a href="{{ route('admin.dashboard') }}"
         class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#f0f0f4] {{ request()->routeIs('admin.dashboard') ? 'bg-[#f0f0f4]' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="..."/></svg>
        <span class="text-sm font-medium text-[#121217]">Kelola Beasiswa</span>
      </a>

      <a href="{{ route('admin.verifikasiPendaftar.index') }}"
         class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#f0f0f4] {{ request()->routeIs('admin.verifikasiPendaftar.*') ? 'bg-[#f0f0f4]' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="..."/></svg>
        <span class="text-sm font-medium text-[#121217]">Verifikasi Pendaftaran</span>
      </a>

      <a href="{{ route('admin.verifikasiPrestasi.index') }}"
         class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#f0f0f4] {{ request()->routeIs('admin.validasiPrestasi.index') ? 'bg-[#f0f0f4]' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="..."/></svg>
        <span class="text-sm font-medium text-[#121217]">Validasi Prestasi</span>
      </a>

      <a href="{{ route('admin.metode.index') }}"
         class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#f0f0f4] {{ request()->routeIs('admin.saw.index') ? 'bg-[#f0f0f4]' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="..."/></svg>
        <span class="text-sm font-medium text-[#121217]">Atur Bobot SAW</span>
      </a>

      <a href="{{ route('admin.laporan.index') }}"
         class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#f0f0f4] {{ request()->routeIs('admin.laporan.index') ? 'bg-[#f0f0f4]' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="..."/></svg>
        <span class="text-sm font-medium text-[#121217]">Laporan</span>
      </a>

    </div>
  </div>

  {{-- Tombol bawah --}}
  <button class="w-full h-10 bg-[#1e1eae] text-white rounded-lg font-bold text-sm">
    Tambah Beasiswa Baru
  </button>
</div>
