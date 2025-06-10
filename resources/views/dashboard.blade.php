<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Saya - ImpactFlow</title>
    {{-- Menggunakan Vite untuk menyertakan Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 to-green-50 font-sans antialiased text-gray-800">
    {{-- Navbar for public users in dashboard --}}
    <nav class="bg-white p-4 shadow-sm sticky top-0 z-50 border-b border-blue-100">
        <div class="container mx-auto flex justify-between items-center flex-wrap">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300">ImpactFlow</a>

            {{-- Mobile Menu Toggle --}}
            <div class="block lg:hidden">
                <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-blue-500">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
            </div>

            {{-- Desktop Menu and Mobile Collapsible Menu --}}
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block pt-6 lg:pt-0" id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-300" href="{{ route('public.activities.index') }}">Kegiatan</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-300" href="{{ route('public.contents.index') }}">Berita</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-300" href="{{ route('public.media.index') }}">Galeri</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-300" href="{{ route('public.donations.page') }}">Donasi</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-300" href="{{ route('public.about') }}">Tentang Kami</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-300" href="{{ route('public.contact') }}">Kontak</a>
                    </li>
                    <li class="mr-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-block py-2 px-4 bg-indigo-500 hover:bg-indigo-600 text-white font-bold rounded mr-2 transition-colors duration-300">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition-colors duration-300">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="inline-block py-2 px-4 text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-300">Login</a>
                            <a href="{{ route('register') }}" class="inline-block py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded transition-colors duration-300">Daftar</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        document.getElementById('nav-toggle').onclick = function() {
            document.getElementById('nav-content').classList.toggle('hidden');
        }
    </script>
    {{-- End Navbar --}}

    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Halo, <span class="text-blue-700">{{ Auth::user()->name }}</span>!</h1>
            <p class="text-gray-700 mb-8">Selamat datang di dashboard pribadi Anda di ImpactFlow. Di sini Anda bisa melihat rangkuman keterlibatan dan kontribusi Anda.</p>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Link to Admin Dashboard for Admin/Manager roles (if applicable) --}}
            @if (Auth::user()->hasRole(['admin', 'manager']))
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-md" role="alert">
                    <p class="font-bold">Akses Admin</p>
                    <p>Anda memiliki hak akses Admin/Manager. <a href="{{ route('admin.dashboard') }}" class="font-bold underline text-blue-600 hover:text-blue-800">Pergi ke Dashboard Admin</a>.</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                {{-- Keterlibatan dalam Kegiatan --}}
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <h2 class="text-2xl font-semibold text-teal-600 mb-4">Keterlibatan Kegiatan Anda</h2>
                    @if(Auth::user()->participations->isEmpty())
                        <p class="text-gray-600 mb-4">Anda belum terlibat dalam kegiatan apa pun.</p>
                        <a href="{{ route('public.activities.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition-colors duration-300 shadow-md transform hover:scale-105">Jelajahi Kegiatan</a>
                    @else
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            @foreach(Auth::user()->participations as $participation)
                                <li>
                                    <span class="font-semibold">{{ $participation->activity->title ?? 'Kegiatan Tidak Ditemukan' }}</span>
                                    sebagai <span class="font-bold text-blue-600">{{ ucfirst($participation->type) }}</span>
                                    (Status:
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($participation->status == 'Registered') bg-gray-200 text-gray-800
                                        @elseif($participation->status == 'Attended' || $participation->status == 'Completed') bg-green-200 text-green-800
                                        @elseif($participation->status == 'Assigned') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ $participation->status }}
                                    </span>
                                    )
                                    <a href="{{ route('public.activities.show', $participation->activity->id) }}" class="text-blue-500 hover:text-blue-700 underline text-sm ml-2">[Lihat Detail]</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Riwayat Donasi --}}
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <h2 class="text-2xl font-semibold text-purple-600 mb-4">Riwayat Donasi Anda</h2>
                    @if(Auth::user()->donations->isEmpty())
                        <p class="text-gray-600 mb-4">Anda belum melakukan donasi apa pun.</p>
                        <a href="{{ route('public.donations.page') }}" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-full transition-colors duration-300 shadow-md transform hover:scale-105">Ayo Berdonasi!</a>
                    @else
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            @foreach(Auth::user()->donations as $donation)
                                <li>
                                    <span class="font-semibold">{{ $donation->currency }} {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                    untuk <span class="font-bold">{{ $donation->activity->title ?? 'Umum/Organisasi' }}</span>
                                    (Status:
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($donation->status == 'Completed') bg-green-200 text-green-800
                                        @elseif($donation->status == 'Pending') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ $donation->status }}
                                    </span>
                                    ) pada {{ $donation->donation_date->format('d M Y') }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            {{-- Aksi Cepat --}}
            <div class="mt-8 text-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-6">
                    <a href="{{ route('public.activities.index') }}" class="inline-block bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-full shadow-md transform transition duration-300 hover:scale-105">
                        Temukan Kegiatan Baru
                    </a>
                    <a href="{{ route('public.donations.page') }}" class="inline-block bg-gradient-to-r from-teal-500 to-green-500 hover:from-teal-600 hover:to-green-600 text-white font-bold py-3 px-6 rounded-full shadow-md transform transition duration-300 hover:scale-105">
                        Lakukan Donasi
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Footer --}}
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-between items-center">
                <div class="w-full md:w-1/3 text-center md:text-left mb-6 md:mb-0">
                    <h3 class="text-2xl font-bold mb-2">ImpactFlow</h3>
                    <p class="text-gray-400 text-sm">Platform manajemen kegiatan sosial Anda.</p>
                </div>
                <div class="w-full md:w-1/3 text-center mb-6 md:mb-0">
                    <h4 class="text-lg font-semibold mb-3">Tautan Cepat</h4>
                    <ul class="text-gray-400 text-sm">
                        <li><a href="{{ route('public.activities.index') }}" class="hover:text-white transition-colors duration-300">Kegiatan</a></li>
                        <li><a href="{{ route('public.contents.index') }}" class="hover:text-white transition-colors duration-300">Berita</a></li>
                        <li><a href="{{ route('public.media.index') }}" class="hover:text-white transition-colors duration-300">Galeri</a></li>
                        <li><a href="{{ route('public.donations.page') }}" class="hover:text-white transition-colors duration-300">Donasi</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3 text-center md:text-right">
                    <h4 class="text-lg font-semibold mb-3">Kontak Kami</h4>
                    <ul class="text-gray-400 text-sm">
                        <li>Email: info@impactflow.org</li>
                        <li>Telepon: +62 812 3456 7890</li>
                        <li>Alamat: Jl. Contoh No. 123, Kota Anda</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-500 text-xs">
                © {{ date('Y') }} ImpactFlow. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>