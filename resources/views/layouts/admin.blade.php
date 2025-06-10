<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ImpactFlow @yield('title')</title>
    {{-- Ini akan otomatis menyertakan CSS yang dikompilasi oleh Vite (Tailwind CSS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen bg-gray-100">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="px-6 py-4 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold">ImpactFlow Admin</a>
            </div>
            <nav class="flex-grow">
                @include('admin._sidebar') {{-- Menginclude sidebar navigasi --}}
            </nav>
            <div class="px-6 py-4 border-t border-gray-700 text-sm">
                <p>Logged in as: {{ Auth::user()->name }}</p>
                <p class="text-gray-400">({{ ucfirst(Auth::user()->role) }})</p>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Top Bar / Header --}}
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm">
                <div class="text-xl font-semibold text-gray-800">
                    @yield('header') {{-- Judul halaman spesifik --}}
                </div>
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-gray-900 mr-4">Lihat Website</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Logout</button>
                    </form>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                @if (session('info'))
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('info') }}</span>
                    </div>
                @endif

                @yield('content') {{-- Konten utama dari halaman spesifik --}}
            </main>
        </div>
    </div>
</body>
</html>