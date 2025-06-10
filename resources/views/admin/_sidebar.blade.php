<ul class="flex flex-col py-4 space-y-1">
    <li class="px-5">
        <div class="flex flex-row items-center h-8">
            <div class="text-sm font-light tracking-wide text-gray-400">Utama</div>
        </div>
    </li>
    <li>
        <a href="{{ route('admin.dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
        </a>
    </li>
    <li class="px-5">
        <div class="flex flex-row items-center h-8">
            <div class="text-sm font-light tracking-wide text-gray-400">Manajemen Data</div>
        </div>
    </li>
    <li>
        <a href="{{ route('admin.activities.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Kegiatan</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.donations.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Donasi</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.contents.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Konten (Berita/Laporan)</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.media.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Galeri (Media)</span>
        </a>
    </li>
    <li class="px-5">
        <div class="flex flex-row items-center h-8">
            <div class="text-sm font-light tracking-wide text-gray-400">Sistem</div>
        </div>
    </li>
    <li>
        <a href="{{ route('admin.users.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a1 1 0 01-1-1v-1a6 6 0 0112 0v1a1 1 0 01-1 1h-1"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Pengguna</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.settings.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.827 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.827 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.827-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.827-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Pengaturan</span>
        </a>
    </li>
</ul>