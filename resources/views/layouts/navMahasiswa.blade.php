<!-- Mahasiswa Navigation -->
<nav class="sticky top-0 z-50 bg-white shadow-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center gap-2 sm:gap-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-base sm:text-lg">DT</span>
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900 leading-tight">DipaTalent</h1>
                    <p class="text-xs text-gray-500">Mahasiswa Portal</p>
                </div>
            </div>

            <!-- Navigation Links - Desktop -->
            <div class="hidden xl:flex items-center gap-0.5">
                <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M2 13.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6.5A1.5 1.5 0 0 0 13.5 5h-11A1.5 1.5 0 0 0 1 6.5v7z"/>
                        <path d="M2 4a1.5 1.5 0 0 1 1.5-1.5h11A1.5 1.5 0 0 1 16 4"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('mahasiswa.listBeasiswa') }}" class="nav-link {{ request()->routeIs('mahasiswa.listBeasiswa') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                    </svg>
                    Beasiswa
                </a>
                <a href="{{ route('mahasiswa.riwayatPendaftaran') }}" class="nav-link {{ request()->routeIs('mahasiswa.riwayatPendaftaran') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    Riwayat
                </a>
                <a href="{{ route('mahasiswa.prestasi') }}" class="nav-link {{ request()->routeIs('mahasiswa.prestasi') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M3 14s1 0 8-1t7-6-7-4-8 0H2c0-1 .25-7 7-7s6 7 6 7-4 3-8 4-8 1-8 1z"/>
                    </svg>
                    Prestasi
                </a>
                <a href="{{ route('mahasiswa.sertifikasi.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.sertifikasi.*') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                    Sertifikasi
                </a>
                <a href="{{ route('mahasiswa.organisasi.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.organisasi.*') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                    </svg>
                    Organisasi
                </a>
                <a href="{{ route('mahasiswa.leaderboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.leaderboard') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                    </svg>
                    Ranking
                </a>
                <a href="{{ route('mahasiswa.galeri') }}" class="nav-link {{ request()->routeIs('mahasiswa.galeri') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M2.5 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-11zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Galeri
                </a>
                <a href="{{ route('mahasiswa.perhitunganSaw') }}" class="nav-link {{ request()->routeIs('mahasiswa.perhitunganSaw') ? 'active' : '' }} px-2.5 py-2 rounded-lg text-xs font-medium transition-all whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="inline mr-1.5">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                    </svg>
                    SAW
                </a>
            </div>

            <!-- Right Side - User Menu & Mobile Toggle -->
            <div class="flex items-center gap-2 sm:gap-4">
                <!-- User Info & Dropdown -->
                <div class="relative group">
                    <button id="userMenuBtn" class="flex items-center gap-2 sm:gap-3 px-2 sm:px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-semibold text-gray-900 truncate max-w-[120px]">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->nim ?? 'N/A' }}</p>
                        </div>
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md flex-shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="hidden md:block text-gray-400">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="userDropdown" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm.567-8.713c.289.213.5.952.5 2.213 0 .979.111 1.917.652 2.972.541 1.055.964 1.855 1.213 2.011.095.066.192.068.287.021.386-.203.889-.482 1.579-1.38.557-.743 1.228-1.86 2.298-3.998C17.395 2.806 17 2 16 2c-.63 0-1.25.765-1.969 1.857-.381.564-.643 1.192-.907 1.663C12.956 4.888 12.508 4 11.5 4c-.591 0-.98.447-1.237 1.1-.181.434-.301.959-.464 1.58l-.068.288c-.219.899-.43 1.764-.606 2.128-.135.254-.293.599-.693.599-.37 0-.518-.27-.518-.897 0-.568.035-1.934.81-4.374.383-1.188.646-2.217.846-2.997C9.854 2.467 10.4 2 11 2l.023-.003c.484 0 .997.324 1.544 1.287zm-1.331 5.66c.156.416.246.989.234 1.953-.015 1.118-.112 1.913-.38 2.49-.268.577-.732.977-1.456 1.26-.724.283-1.72.315-2.958.315-1.237 0-2.234-.032-2.958-.315-.724-.283-1.188-.683-1.456-1.26-.268-.577-.365-1.372-.38-2.49-.012-.964.078-1.537.234-1.953.156-.416.394-.665.778-.977.384-.312 1.027-.607 1.849-.856 1.645-.498 3.83-.498 5.475 0 .822.249 1.465.544 1.849.856.384.312.622.561.778.977z"/>
                            </svg>
                            Profil Saya
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors border-b border-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M9.405 1.05c-.413-1.653-2.397-1.653-2.81 0l-.915 3.026a2.881 2.881 0 0 1-2.696 2.062c-1.745.122-2.745 2.201-1.338 3.552l2.26 2.183a2.88 2.88 0 0 1 .673 3.108l-.868 2.88c-.44 1.454 1.158 2.889 2.516 2.026l2.952-1.9a2.884 2.884 0 0 1 3.35 0l2.952 1.9c1.358.863 2.956-.572 2.516-2.026l-.868-2.88a2.88 2.88 0 0 1 .673-3.108l2.26-2.183c1.407-1.351.407-3.43-1.338-3.552a2.881 2.881 0 0 1-2.696-2.062l-.915-3.026z"/>
                            </svg>
                            Pengaturan
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                    <path d="M4 1a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v4.5a.5.5 0 0 1-1 0V2H5v12h7v-4.5a.5.5 0 0 1 1 0V15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V1z"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button id="mobileMenuToggle" class="xl:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="transition-transform duration-200">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="hidden">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden xl:hidden border-t border-gray-200 py-3 max-h-[calc(100vh-64px)] overflow-y-auto">
            <div class="space-y-1">
                <a href="{{ route('mahasiswa.dashboard') }}" class="mobile-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 13.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6.5A1.5 1.5 0 0 0 13.5 5h-11A1.5 1.5 0 0 0 1 6.5v7z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('mahasiswa.listBeasiswa') }}" class="mobile-link {{ request()->routeIs('mahasiswa.listBeasiswa') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3z"/>
                    </svg>
                    <span>Beasiswa</span>
                </a>
                <a href="{{ route('mahasiswa.riwayatPendaftaran') }}" class="mobile-link {{ request()->routeIs('mahasiswa.riwayatPendaftaran') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    </svg>
                    <span>Riwayat Pendaftaran</span>
                </a>
                <a href="{{ route('mahasiswa.prestasi') }}" class="mobile-link {{ request()->routeIs('mahasiswa.prestasi') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3 14s1 0 8-1t7-6-7-4-8 0H2c0-1 .25-7 7-7s6 7 6 7-4 3-8 4-8 1-8 1z"/>
                    </svg>
                    <span>Prestasi</span>
                </a>
                <a href="{{ route('mahasiswa.sertifikasi.index') }}" class="mobile-link {{ request()->routeIs('mahasiswa.sertifikasi.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    </svg>
                    <span>Sertifikasi</span>
                </a>
                <a href="{{ route('mahasiswa.organisasi.index') }}" class="mobile-link {{ request()->routeIs('mahasiswa.organisasi.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                    </svg>
                    <span>Organisasi</span>
                </a>
                <a href="{{ route('mahasiswa.leaderboard') }}" class="mobile-link {{ request()->routeIs('mahasiswa.leaderboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                    </svg>
                    <span>Leaderboard</span>
                </a>
                <a href="{{ route('mahasiswa.galeri') }}" class="mobile-link {{ request()->routeIs('mahasiswa.galeri') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-11z"/>
                    </svg>
                    <span>Galeri</span>
                </a>
                <a href="{{ route('mahasiswa.perhitunganSaw') }}" class="mobile-link {{ request()->routeIs('mahasiswa.perhitunganSaw') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                    </svg>
                    <span>Perhitungan SAW</span>
                </a>
            </div>
            
            <!-- Mobile User Menu -->
            <div class="border-t border-gray-200 mt-3 pt-3 md:hidden">
                <div class="px-4 py-2 text-xs text-gray-500 font-medium">AKUN</div>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    <span>Profil Saya</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.653-2.397-1.653-2.81 0l-.915 3.026a2.881 2.881 0 0 1-2.696 2.062c-1.745.122-2.745 2.201-1.338 3.552l2.26 2.183a2.88 2.88 0 0 1 .673 3.108l-.868 2.88c-.44 1.454 1.158 2.889 2.516 2.026l2.952-1.9a2.884 2.884 0 0 1 3.35 0l2.952 1.9c1.358.863 2.956-.572 2.516-2.026l-.868-2.88a2.88 2.88 0 0 1 .673-3.108l2.26-2.183c1.407-1.351.407-3.43-1.338-3.552a2.881 2.881 0 0 1-2.696-2.062l-.915-3.026z"/>
                    </svg>
                    <span>Pengaturan</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    .nav-link {
        @apply text-gray-700 hover:text-indigo-600 hover:bg-indigo-50;
    }

    .nav-link.active {
        @apply text-indigo-600 bg-indigo-50 font-semibold;
    }

    .mobile-link {
        @apply text-gray-700 hover:bg-gray-100;
    }

    .mobile-link.active {
        @apply bg-indigo-50 text-indigo-600 font-semibold;
    }

    /* Smooth transitions */
    #mobileMenu {
        transition: max-height 0.3s ease-in-out;
    }

    /* Prevent body scroll when mobile menu is open */
    body.menu-open {
        overflow: hidden;
    }

    @media (max-width: 1279px) {
        #mobileMenu:not(.hidden) {
            animation: slideDown 0.2s ease-out;
        }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Better dropdown on mobile */
    @media (max-width: 767px) {
        #userDropdown {
            position: fixed;
            right: 0.75rem;
            left: 0.75rem;
            width: auto;
        }
    }
</style>

<script>
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');

    mobileMenuToggle?.addEventListener('click', function() {
        const isHidden = mobileMenu.classList.contains('hidden');
        
        if (isHidden) {
            mobileMenu.classList.remove('hidden');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            document.body.classList.add('menu-open');
        } else {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.classList.remove('menu-open');
        }
    });

    // Close mobile menu when a link is clicked
    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.classList.remove('menu-open');
        });
    });

    // Close mobile menu on window resize if screen becomes large
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1280) {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.classList.remove('menu-open');
        }
    });

    // User dropdown for mobile
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');
    
    // Toggle dropdown on mobile
    if (window.innerWidth < 768) {
        userMenuBtn?.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('opacity-0');
            userDropdown.classList.toggle('invisible');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
                userDropdown.classList.add('opacity-0');
                userDropdown.classList.add('invisible');
            }
        });
    }

    // Close dropdowns on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.classList.remove('menu-open');
            userDropdown.classList.add('opacity-0');
            userDropdown.classList.add('invisible');
        }
    });
</script>
