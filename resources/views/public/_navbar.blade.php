<nav class="bg-white p-4 shadow-sm sticky top-0 z-50">
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
    // Script untuk toggle menu mobile
    document.getElementById('nav-toggle').onclick = function() {
        document.getElementById('nav-content').classList.toggle('hidden');
    }
</script>