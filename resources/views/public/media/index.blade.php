@extends('layouts.public')

@section('title', '| Galeri')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Galeri Kegiatan Kami</h1>

        @if ($albums->isEmpty())
            <p class="text-gray-600 text-center text-lg">Belum ada album galeri yang tersedia saat ini.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($albums as $album)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        @if ($album->thumbnail_url)
                            <img src="{{ $album->thumbnail_url }}" alt="{{ $album->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">Tidak ada gambar sampul</div>
                        @endif
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $album->title }}</h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $album->description }}</p>
                            <a href="{{ route('public.media.show', $album->id) }}" class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                                Lihat Album ({{ $album->items->count() }} Foto)
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $albums->links() }}
            </div>
        @endif
    </div>
@endsection