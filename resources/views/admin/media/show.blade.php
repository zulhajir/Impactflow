@extends('layouts.admin')

@section('title', '| Detail Album')
@section('header', 'Detail Album Galeri')

@section('medai')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Album: {{ $album->title }}</h1>
            <a href="{{ route('admin.media.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali ke Daftar Album
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-6">
            <p class="text-gray-600 mb-2"><strong>Judul Album:</strong> <span class="text-gray-800">{{ $album->title }}</span></p>
            <p class="text-gray-600 mb-2"><strong>Deskripsi:</strong> <span class="text-gray-800">{{ $album->description ?? 'Tidak ada deskripsi.' }}</span></p>
            <p class="text-gray-600 mb-2"><strong>Dipublikasikan:</strong>
                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $album->is_published ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                    {{ $album->is_published ? 'Ya' : 'Tidak' }}
                </span>
            </p>
            @if ($album->thumbnail_url)
                <div class="mt-4">
                    <p class="text-gray-600 mb-2"><strong>Gambar Sampul:</strong></p>
                    <img src="{{ $album->thumbnail_url }}" alt="Thumbnail Album {{ $album->title }}" class="max-w-xs h-auto rounded-md shadow-sm">
                </div>
            @endif
            <p class="text-gray-600 mt-2"><strong>Dibuat pada:</strong> {{ $album->created_at->format('d M Y, H:i') }}</p>
            <p class="text-gray-600"><strong>Terakhir Diperbarui:</strong> {{ $album->updated_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="flex items-center justify-start gap-4 mb-8">
            <a href="{{ route('admin.media.edit', $album->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                Edit Album
            </a>
            <a href="{{ route('admin.media.items.index', $album->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Kelola Item Media
            </a>
            <form action="{{ route('admin.media.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus album ini beserta semua isinya? Aksi ini tidak dapat dibatalkan.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Hapus Album
                </button>
            </form>
        </div>

        <hr class="my-6">

        {{-- Section for displaying media items within the album --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Item Media dalam Album Ini</h2>

        @if ($album->mediaItems->isEmpty())
            <p class="text-gray-600 text-center">Belum ada item media dalam album ini.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($album->mediaItems as $item)
                    <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                        @if (Str::startsWith($item->file_url, ['http://', 'https://']))
                            <img src="{{ $item->file_url }}" alt="{{ $item->caption }}" class="w-full h-40 object-cover">
                        @else
                            {{-- Assuming internal storage for media files, adjust path as needed --}}
                            <img src="{{ asset('storage/' . $item->file_url) }}" alt="{{ $item->caption }}" class="w-full h-40 object-cover">
                        @endif
                        <div class="p-3">
                            <p class="text-gray-800 font-semibold text-sm truncate">{{ $item->caption ?? 'Tanpa Caption' }}</p>
                            <p class="text-gray-500 text-xs mt-1">{{ $item->type === 'image' ? 'Gambar' : 'Video' }}</p>
                            <div class="mt-2 flex justify-between items-center text-xs">
                                <a href="{{ route('admin.media.items.edit', ['album' => $album->id, 'item' => $item->id]) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                <form action="{{ route('admin.media.items.destroy', ['album' => $album->id, 'item' => $item->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item media ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{-- Assuming pagination for media items within an album if $album->mediaItems is paginated --}}
                {{-- {{ $album->mediaItems->links() }} --}}
            </div>
        @endif
    </div>
@endsection