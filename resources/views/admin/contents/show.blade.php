@extends('layouts.admin')

@section('title', '| Detail Konten')
@section('header', 'Detail Konten')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Detail Konten: {{ $content->title }}</h1>
        <p class="text-gray-600 text-sm mb-4">Dibuat oleh: {{ $content->user->name ?? 'N/A' }}</p>

        <div class="mb-4">
            <p class="text-gray-600"><strong>Tipe Konten:</strong> {{ ucfirst(str_replace('_', ' ', $content->type)) }}</p>
            @if ($content->activity)
                <p class="text-gray-600"><strong>Kegiatan Terkait:</strong> {{ $content->activity->title }}</p>
            @endif
            @if ($content->published_at)
                <p class="text-gray-600"><strong>Publikasi:</strong> {{ $content->published_at->format('d F Y, H:i') }}</p>
            @endif
            @if ($content->report_date)
                <p class="text-gray-600"><strong>Tanggal Laporan:</strong> {{ $content->report_date->format('d F Y, H:i') }}</p>
            @endif
            <p class="text-gray-600"><strong>Status Publikasi:</strong>
                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $content->is_published ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                    {{ $content->is_published ? 'Ya' : 'Tidak' }}
                </span>
            </p>
        </div>

        @if ($content->image_url && in_array($content->type, ['news', 'announcement']))
            <img src="{{ $content->image_url }}" alt="{{ $content->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
        @endif

        @if ($content->excerpt)
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Ringkasan:</h2>
                <p class="text-gray-800">{{ $content->excerpt }}</p>
            </div>
        @endif

        @if ($content->body)
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Isi Konten/Laporan:</h2>
                <div class="prose max-w-none text-gray-800 leading-relaxed">
                    {!! nl2br(e($content->body)) !!}
                </div>
            </div>
        @endif

        @if ($content->file_url)
            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">File Laporan:</h2>
                <a href="{{ $content->file_url }}" target="_blank" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-full inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L14.414 5A2 2 0 0115 6.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 10V6h.5a1 1 0 011 1v6a1 1 0 01-1 1H6zm-1 0a1 1 0 01-1-1V7a1 1 0 011-1h.5a.5.5 0 00.5-.5V4.5a.5.5 0 00-.5-.5H6a2 2 0 00-2 2v10a2 2 0 002 2h7a2 2 0 002-2V6.414A.5.5 0 0014.414 6H12.5a.5.5 0 01-.5-.5V4.5a.5.5 0 00-.5-.5H6a2 2 0 00-2 2z" clip-rule="evenodd"></path></svg>
                    Unduh Dokumen
                </a>
            </div>
        @endif

        <div class="flex mt-6">
            <a href="{{ route('admin.contents.edit', $content->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">
                Edit Konten
            </a>
            <form action="{{ route('admin.contents.destroy', $content->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus konten ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Hapus Konten
                </button>
            </form>
            <a href="{{ route('admin.contents.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-auto">
                Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection