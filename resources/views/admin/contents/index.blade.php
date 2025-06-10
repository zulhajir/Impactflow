@extends('layouts.admin')

@section('title', '| Manajemen Konten')
@section('header', 'Manajemen Konten')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Konten</h1>
            <a href="{{ route('admin.contents.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Konten Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($contents->isEmpty())
            <p class="text-gray-600 text-center">Belum ada konten yang terdaftar.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Judul</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Tipe</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Publikasi</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Dibuat Oleh</th>
                            <th class="py-2 px-4 border-b text-center text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $content)
                            <tr>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $content->title }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ ucfirst(str_replace('_', ' ', $content->type)) }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $content->is_published ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ $content->is_published ? 'Ya' : 'Tidak' }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $content->user->name ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ route('admin.contents.show', $content->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Lihat</a>
                                    <a href="{{ route('admin.contents.edit', $content->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Edit</a>
                                    <form action="{{ route('admin.contents.destroy', $content->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus konten ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $contents->links() }}
            </div>
        @endif
    </div>
@endsection