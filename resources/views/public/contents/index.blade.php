@extends('layouts.public')

@section('title')
    @if($type == 'news') | Berita
    @elseif($type == 'announcement') | Pengumuman
    @else | Konten @endif
@endsection

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            @if($type == 'news') Berita Terbaru
            @elseif($type == 'announcement') Pengumuman
            @else Konten Kami @endif
        </h1>

        @if ($contents->isEmpty())
            <p class="text-gray-600 text-center text-lg">Belum ada konten jenis ini yang tersedia saat ini.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($contents as $content)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        @if ($content->image_url)
                            <img src="{{ $content->image_url }}" alt="{{ $content->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">Gambar Tidak Tersedia</div>
                        @endif
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $content->title }}</h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $content->excerpt }}</p>
                            <p class="text-gray-700 text-sm mb-2"><strong class="font-medium">Publikasi:</strong> {{ $content->published_at?->format('d M Y') ?? 'Draft' }}</p>
                            <a href="{{ route('public.contents.show', $content->slug) }}" class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $contents->links() }}
            </div>
        @endif
    </div>
@endsection