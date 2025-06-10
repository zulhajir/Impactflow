@extends('layouts.admin')

@section('title', '| Item Album: ' . $album->title)
@section('header', 'Item Album: ' . $album->title)

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Item Album: <span class="text-blue-600">{{ $album->title }}</span></h1>
            <a href="{{ route('admin.media.show', $album->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Kembali ke Detail Album
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada masalah saat menambahkan item media.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-4 text-gray-700">Tambah Item Media Baru:</h2>
        <form action="{{ route('admin.media.items.store', $album->id) }}" method="POST" class="mb-8 p-4 border rounded-lg bg-gray-50">
            @csrf
            <div class="mb-4">
                <label for="media_url" class="block text-gray-700 text-sm font-bold mb-2">URL Gambar/Video:</label>
                <input type="url" id="media_url" name="media_url" value="{{ old('media_url') }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                {{-- Di masa depan, ini bisa diganti dengan input file upload --}}
            </div>
            <div class="mb-4">
                <label for="caption" class="block text-gray-700 text-sm font-bold mb-2">Keterangan (Opsional):</label>
                <input type="text" id="caption" name="caption" value="{{ old('caption') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Media:</label>
                <select id="type" name="type" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Gambar</option>
                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                </select>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Tambah Item Media
            </button>
        </form>

        <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftar Item Media:</h2>
        @if ($items->isEmpty())
            <p class="text-gray-600 text-center">Belum ada item media dalam album ini.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($items as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if ($item->type == 'image')
                            <img src="{{ $item->media_url }}" alt="{{ $item->caption }}" class="w-full h-48 object-cover">
                        @elseif ($item->type == 'video')
                            <div class="w-full h-48 flex items-center justify-center bg-black text-white">Video Preview</div>
                            {{-- Anda bisa menyematkan video langsung jika mau, misal dari YouTube/Vimeo --}}
                        @endif
                        <div class="p-4">
                            <p class="text-sm font-semibold text-gray-800 line-clamp-1">{{ $item->caption ?? 'Tanpa Keterangan' }}</p>
                            <p class="text-xs text-gray-600">{{ ucfirst($item->type) }}</p>
                            <form action="{{ route('admin.media.items.destroy', ['album' => $album->id, 'item' => $item->id]) }}" method="POST" class="mt-2" onsubmit="return confirm('Anda yakin ingin menghapus item ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection