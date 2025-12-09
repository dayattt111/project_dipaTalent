<!-- Mahasiswa Navigation -->
<nav class="sticky top-0 z-50 bg-white shadow-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg">DT</span>
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-xl font-bold text-gray-900">DipaTalent</h1>
                    <p class="text-xs text-gray-500">Mahasiswa Portal</p>
                </div>
            </div>

            <!-- Navigation Links - Desktop -->
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="inline mr-2">
                        <path d="M2 13.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6.5A1.5 1.5 0 0 0 13.5 5h-11A1.5 1.5 0 0 0 1 6.5v7z"/>
                        <path d="M2 4a1.5 1.5 0 0 1 1.5-1.5h11A1.5 1.5 0 0 1 16 4"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('mahasiswa.listBeasiswa') }}" class="nav-link {{ request()->routeIs('mahasiswa.listBeasiswa') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="inline mr-2">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                    </svg>
                    Beasiswa
                </a>
                <a href="{{ route('mahasiswa.riwayatPendaftaran') }}" class="nav-link {{ request()->routeIs('mahasiswa.riwayatPendaftaran') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="inline mr-2">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    Riwayat
                </a>
                <a href="{{ route('mahasiswa.prestasi') }}" class="nav-link {{ request()->routeIs('mahasiswa.prestasi') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="inline mr-2">
                        <path d="M3 14s1 0 8-1t7-6-7-4-8 0H2c0-1 .25-7 7-7s6 7 6 7-4 3-8 4-8 1-8 1z"/>
                    </svg>
                    Prestasi
                </a>
                <a href="{{ route('mahasiswa.sertifikasi.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.sertifikasi.*') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="inline mr-2">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                    Sertifikasi
                </a>
                <a href="{{ route('mahasiswa.leaderboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.leaderboard') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="inline mr-2">
                        <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                    </svg>
                    Leaderboard
                </a>
                <a href="{{ route('mahasiswa.galeri') }}" class="nav-link {{ request()->routeIs('mahasiswa.galeri') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="inline mr-2">
                        <path d="M2.5 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-11zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Galeri
                </a>
            </div>

            <!-- Right Side - User Menu & Mobile Toggle -->
            <div class="flex items-center gap-4">
                <!-- User Info & Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->nim ?? 'N/A' }}</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
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
                <button id="mobileMenuToggle" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden border-t border-gray-200 py-4 space-y-2">
            <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">Dashboard</a>
            <a href="{{ route('mahasiswa.listBeasiswa') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">Beasiswa</a>
            <a href="{{ route('mahasiswa.riwayatPendaftaran') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">Riwayat</a>
            <a href="{{ route('mahasiswa.prestasi') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">Prestasi</a>
            <a href="{{ route('mahasiswa.leaderboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">Leaderboard</a>
            <a href="{{ route('mahasiswa.galeri') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">Galeri</a>
        </div>
    </div>
</nav>

<style>
    .nav-link {
        @apply text-gray-700 hover:text-indigo-600 hover:bg-indigo-50;
    }

    .nav-link.active {
        @apply text-indigo-600 bg-indigo-50;
    }

    #mobileMenuToggle.active svg {
        transform: rotate(180deg);
    }
</style>

<script>
    document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
        this.classList.toggle('active');
    });

    // Close mobile menu when a link is clicked
    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.add('hidden');
            document.getElementById('mobileMenuToggle').classList.remove('active');
        });
    });
</script>
