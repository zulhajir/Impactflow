<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImpactFlow @yield('title')</title>
    {{-- Ini akan otomatis menyertakan CSS yang dikompilasi oleh Vite (Tailwind CSS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles') {{-- Untuk CSS tambahan per halaman --}}
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">
    {{-- Header / Navigation Bar --}}
    @include('public._navbar')

    {{-- Main Content Area --}}
    <main class="min-h-screen">
        @if (session('success'))
            <div class="container mx-auto mt-6 px-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="container mx-auto mt-6 px-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif
        @yield('content') {{-- Konten utama dari halaman spesifik --}}
    </main>

    {{-- Footer --}}
    @include('public._footer')

    @stack('scripts') {{-- Untuk JavaScript tambahan per halaman --}}
</body>
</html>