@extends('layouts.public')

@section('title', '| ' . $content->title)

@section('content')
    <div class="container mx-auto p-6">
        <a href="{{ route('public.contents.index', ['type' => $content->type]) }}" class="text-blue-500 hover:underline mb-6 inline-block text-lg">&larr; Kembali ke Daftar {{ $content->type == 'news' ? 'Berita' : 'Konten' }}</a>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $content->title }}</h1>
            <p class="text-gray-600 text-sm mb-4">
                Ditulis oleh: {{ $content->user->name ?? 'Admin' }} | Publikasi: {{ $content->published_at?->format('d F Y, H:i') ?? 'N/A' }}
            </p>

            @if ($content->image_url)
                <img src="{{ $content->image_url }}" alt="{{ $content->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
            @endif

            <div class="prose max-w-none text-gray-800 leading-relaxed">
                {!! nl2br(e($content->body)) !!}
            </div>

            @if ($content->file_url)
                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">File Laporan:</h2>
                    <a href="{{ $content->file_url }}" target="_blank" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-full inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L14.414 5A2 2 0 0115 6.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 10V6h.5a1 1 0 011 1v6a1 1 0 01-1 1H6zm-1 0a1 1 0 01-1-1V7a1 1 0 011-1h.5a.5.5 0 00.5-.5V4.5a.5.5 0 00-.5-.5H6a2 2 0 00-2 2v10a2 2 0 002 2h7a2 2 0 002-2V6.414A.5.5 0 0014.414 6H12.5a.5.5 0 01-.5-.5V4.5a.5.5 0 00-.5-.5H6a2 2 0 00-2 2z" clip-rule="evenodd"></path></svg>
                        Unduh Dokumen
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection