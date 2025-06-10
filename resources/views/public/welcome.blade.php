@extends('layouts.public')

@section('title', '| Beranda')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-24 text-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://via.placeholder.com/1920x1080?text=ImpactFlow+Hero" alt="Hero Background" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-black opacity-40"></div>
        </div>
        <div class="relative z-10 container mx-auto px-6">
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 animate-fade-in-down">
                Wujudkan Perubahan Nyata Bersama ImpactFlow
            </h1>
            <p class="text-xl md:text-2xl mb-10 max-w-3xl mx-auto animate-fade-in-up">
                Platform terdepan untuk menemukan, berpartisipasi, dan mengelola kegiatan sosial yang berdampak positif.
            </p>
            <a href="{{ route('public.activities.index') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-full text-lg shadow-lg transition duration-300 transform hover:scale-105 animate-bounce-in">
                Jelajahi Kegiatan Kami
            </a>
        </div>
    </section>

    {{-- About/Intro Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Apa Itu ImpactFlow?</h2>
            <p class="text-lg text-gray-600 max-w-4xl mx-auto leading-relaxed">
                ImpactFlow adalah jembatan yang menghubungkan Anda dengan berbagai inisiatif sosial yang peduli. Kami mempermudah proses pengelolaan kegiatan, mulai dari penggalangan dana, pendaftaran sukarelawan, hingga pelaporan dampak. Bergabunglah dengan kami untuk menciptakan dunia yang lebih baik.
            </p>
        </div>
    </section>

    {{-- Featured Activities Section (Optional: fetch from DB, limit 3) --}}
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Kegiatan Unggulan</h2>
            @php
                // Anda bisa mengambil kegiatan unggulan dari database di PublicController
                // Misalnya, $featuredActivities = \App\Models\Activity::where('is_featured', true)->take(3)->get();
                // Untuk contoh, kita akan pakai dummy data atau ambil 3 terbaru
                $featuredActivities = \App\Models\Activity::whereIn('status', ['Planned', 'Ongoing'])->latest()->take(3)->get();
            @endphp

            @if ($featuredActivities->isEmpty())
                <p class="text-gray-600 text-center">Belum ada kegiatan unggulan saat ini. <a href="{{ route('public.activities.index') }}" class="text-blue-500 hover:underline">Lihat semua kegiatan</a></p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featuredActivities as $activity)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            @if ($activity->image_url)
                                <img src="{{ $activity->image_url }}" alt="{{ $activity->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Gambar Tidak Tersedia</div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $activity->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $activity->description }}</p>
                                <p class="text-gray-700 text-sm mb-2"><strong class="font-medium">Lokasi:</strong> {{ $activity->location }}</p>
                                <p class="text-gray-700 text-sm mb-4"><strong class="font-medium">Tanggal:</strong> {{ $activity->start_date->format('d M Y') }}</p>
                                <a href="{{ route('public.activities.show', $activity->id) }}" class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-10">
                    <a href="{{ route('public.activities.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-md transition duration-300">
                        Lihat Semua Kegiatan
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Call to Action: Join/Donate --}}
    <section class="py-16 bg-blue-700 text-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold mb-6">Siap Beraksi?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Bergabunglah sebagai sukarelawan, dukung dengan donasi, atau mulai inisiati Anda sendiri.
            </p>
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-6">
                <a href="{{ route('public.activities.index') }}" class="bg-white text-blue-700 hover:bg-gray-200 font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105">
                    Cari Kegiatan
                </a>
                <a href="{{ route('public.donations.page') }}" class="bg-yellow-400 text-blue-900 hover:bg-yellow-500 font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105">
                    Berdonasi Sekarang
                </a>
            </div>
        </div>
    </section>
@endsection