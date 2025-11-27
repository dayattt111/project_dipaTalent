{{-- resources/views/layouts/navAdmin.blade.php --}}
<div class="flex flex-col h-full bg-gradient-to-b from-slate-900 to-slate-800 text-white p-0">
  {{-- Header --}}
  <div class="px-6 py-5 border-b border-slate-700">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        </svg>
      </div>
      <div>
        <h1 class="text-lg font-bold">DipaTalent</h1>
        <p class="text-xs text-slate-400">Admin Panel</p>
      </div>
    </div>
  </div>

  {{-- Navigation Menu --}}
  <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-2">
    <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-3 mb-4">Menu</div>

    <a href="{{ route('admin.dashboard') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      </svg>
      <span class="text-sm font-medium">Dashboard</span>
    </a>

    <a href="{{ route('admin.kelolaBeasiswa.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.kelolaBeasiswa.*') ? 'bg-indigo-500 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.71l-5.223 2.206A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
      </svg>
      <span class="text-sm font-medium">Kelola Beasiswa</span>
    </a>

    <a href="{{ route('admin.verifikasiPendaftar.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.verifikasiPendaftar.*') ? 'bg-indigo-500 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M7 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm4-6a.999.999 0 0 0-.956.676l-1.661 5.207a.5.5 0 0 0 .961.276l1.661-5.207A.5.5 0 0 0 11 8z"/>
      </svg>
      <span class="text-sm font-medium">Verifikasi Pendaftaran</span>
    </a>

    <a href="{{ route('admin.verifikasiPrestasi.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.verifikasiPrestasi.*') ? 'bg-indigo-500 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M6.5 0a.5.5 0 0 0 0 1H7v5H.5a.5.5 0 0 0 0 1H7v2H.5a.5.5 0 0 0 0 1H7v4.5a.5.5 0 0 0 1 0V7h5v4.5a.5.5 0 0 0 1 0V7h5.5a.5.5 0 0 0 0-1H13V6h3.5a.5.5 0 0 0 0-1H13V0h-1v5H7V0H6.5z"/>
      </svg>
      <span class="text-sm font-medium">Verifikasi Prestasi</span>
    </a>

    <a href="{{ route('admin.metode.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.metode.*') ? 'bg-indigo-500 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.264-2.17 1.557l.134.327c.472 1.147-.175 2.462-1.256 2.94l-.327.134c-1.292.523-1.395 2.109-.524 2.847l.24.263a1.464 1.464 0 0 1 0 2.07l-.24.263c-.871.738-.768 2.324.524 2.847l.327.134c1.081.478 1.728 1.793 1.256 2.94l-.134.327c-.516 1.293 .887 2.255 2.17 1.557l.31-.17a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.264 2.17-1.557l-.134-.327a1.464 1.464 0 0 1 1.256-2.94l.327-.134c1.292-.523 1.395-2.109.524-2.847l-.24-.263a1.464 1.464 0 0 1 0-2.07l.24-.263c.871-.738.768-2.324-.524-2.847l-.327-.134c-1.081-.478-1.728-1.793-1.256-2.94l.134-.327c.516-1.293-.887-2.255-2.17-1.557l-.31.17a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
      </svg>
      <span class="text-sm font-medium">Atur Bobot SAW</span>
    </a>

    <a href="{{ route('admin.laporan.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.laporan.*') ? 'bg-indigo-500 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
      </svg>
      <span class="text-sm font-medium">Laporan</span>
    </a>

    <a href="{{ route('admin.users.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-indigo-500 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.5-6a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
      </svg>
      <span class="text-sm font-medium">Kelola Pengguna</span>
    </a>
  </nav>

  {{-- Footer --}}
  <div class="border-t border-slate-700 px-3 py-4 space-y-2">
    <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-3 mb-3">Akun</div>
    <form method="POST" action="{{ route('logout') }}" class="w-full">
      @csrf
      <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-red-600 hover:text-white transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 1 1-.708-.708L9.293 8 7.146 5.854a.5.5 0 1 1 .708-.708l3 3z"/>
        </svg>
        <span class="text-sm font-medium">Keluar</span>
      </button>
    </form>
  </div>
</div>
