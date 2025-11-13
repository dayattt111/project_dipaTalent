{{-- layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f9fafb] text-gray-900">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-72 bg-white border-r">
            @include('layouts.navAdmin')
        </aside>

        {{-- Main content --}}
        <main class="flex-1 p-8 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>
