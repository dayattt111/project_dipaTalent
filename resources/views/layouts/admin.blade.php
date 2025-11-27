{{-- layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 text-gray-900 min-h-screen">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 fixed h-screen shadow-lg overflow-y-auto">
            @include('layouts.navAdmin')
        </aside>

        {{-- Main content --}}
        <main class="flex-1 ml-64 overflow-y-auto">
            <div class="p-6 md:p-8">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
