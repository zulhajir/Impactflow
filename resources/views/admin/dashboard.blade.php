@extends('layouts.admin')

@section('title', '| Dashboard')
@section('header', 'Dashboard Admin')

@section('content')
    <div class="space-y-6">
        {{-- Welcome Card --}}
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-8 rounded-lg shadow-xl text-white">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Selamat Datang di Dashboard Admin, {{ Auth::user()->name }}!</h1>
            <p class="text-lg text-blue-100">Ini adalah panel manajemen pusat Anda untuk ImpactFlow. Semua ada di sini.</p>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            {{-- Activities Summary Card --}}
            <div class="bg-white p-6 rounded-lg shadow-md border-b-4 border-blue-500 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Kegiatan</h3>
                    {{-- Mengambil jumlah langsung dari model --}}
                    <p class="text-3xl font-bold text-blue-600 mt-1">{{ \App\Models\Activity::count() }}</p>
                </div>
                <div class="text-blue-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
            </div>

            {{-- Users Summary Card --}}
            <div class="bg-white p-6 rounded-lg shadow-md border-b-4 border-green-500 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
                    {{-- Mengambil jumlah langsung dari model --}}
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ \App\Models\User::count() }}</p>
                </div>
                <div class="text-green-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a1 1 0 01-1-1v-1a6 6 0 0112 0v1a1 1 0 01-1 1h-1"></path></svg>
                </div>
            </div>

            {{-- Donations Summary Card --}}
            <div class="bg-white p-6 rounded-lg shadow-md border-b-4 border-purple-500 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Donasi</h3>
                    {{-- Mengambil jumlah langsung dari model --}}
                    <p class="text-3xl font-bold text-purple-600 mt-1">{{ \App\Models\Donation::count() }}</p>
                </div>
                <div class="text-purple-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>

            {{-- Contents Summary Card --}}
            <div class="bg-white p-6 rounded-lg shadow-md border-b-4 border-yellow-500 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Konten</h3>
                    {{-- Mengambil jumlah langsung dari model --}}
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ \App\Models\Content::count() }}</p>
                </div>
                <div class="text-yellow-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>

            {{-- Media Summary Card --}}
            <div class="bg-white p-6 rounded-lg shadow-md border-b-4 border-teal-500 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Item Media</h3>
                    {{-- Mengambil jumlah langsung dari model --}}
                    <p class="text-3xl font-bold text-teal-600 mt-1">{{ \App\Models\Media::count() }}</p>
                </div>
                <div class="text-teal-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>

        </div>

        {{-- Quick Links / Navigation --}}
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Akses Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('admin.activities.index') }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium py-3 px-4 rounded-lg flex items-center transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Kelola Kegiatan
                </a>
                <a href="{{ route('admin.donations.index') }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-medium py-3 px-4 rounded-lg flex items-center transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Kelola Donasi
                </a>
                <a href="{{ route('admin.contents.index') }}" class="bg-purple-100 hover:bg-purple-200 text-purple-800 font-medium py-3 px-4 rounded-lg flex items-center transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Kelola Konten
                </a>
                <a href="{{ route('admin.media.index') }}" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-medium py-3 px-4 rounded-lg flex items-center transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Kelola Galeri
                </a>
                <a href="{{ route('admin.users.index') }}" class="bg-red-100 hover:bg-red-200 text-red-800 font-medium py-3 px-4 rounded-lg flex items-center transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a1 1 0 01-1-1v-1a6 6 0 0112 0v1a1 1 0 01-1 1h-1"></path></path></svg>
                    Kelola Pengguna
                </a>
                <a href="{{ route('admin.settings.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg flex items-center transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.827 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.827 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.827-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.827-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Pengaturan Website
                </a>
            </div>
        </div>
    </div>
@endsection