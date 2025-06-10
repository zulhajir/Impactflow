@extends('layouts.admin')

@section('title', '| Edit Album')
@section('header', 'Edit Album')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Album: {{ $album->title }}</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.media.update', $album->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul Album:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $album->title) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Album (Opsional):</label>
                <textarea id="description" name="description" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $album->description) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="thumbnail_url" class="block text-gray-700 text-sm font-bold mb-2">URL Gambar Sampul (Opsional):</label>
                <input type="url" id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url', $album->thumbnail_url) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Gunakan URL gambar dari hosting eksternal untuk saat ini.</p>
            </div>
            <div class="mb-6">
                <label for="is_published" class="inline-flex items-center">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $album->is_published) ? 'checked' : '' }} class="form-checkbox">
                    <span class="ml-2 text-gray-700">Publikasikan Album</span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui Album
                </button>
                <a href="{{ route('admin.media.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection