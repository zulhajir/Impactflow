@extends('layouts.admin')

@section('title', '| Detail Kegiatan')
@section('header', 'Detail Kegiatan Sosial')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $activity->title }}</h1>
        <p class="text-gray-600 mb-4">Dibuat oleh: {{ $activity->user->name ?? 'N/A' }}</p>

        @if ($activity->image_url)
            <img src="{{ $activity->image_url }}" alt="{{ $activity->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
        @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500 text-lg mb-6 rounded-lg">Gambar Tidak Tersedia</div>
        @endif

        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Deskripsi:</h2>
            <p class="text-gray-800">{{ $activity->description }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-gray-600"><strong>Lokasi:</strong> {{ $activity->location }}</p>
                <p class="text-gray-600"><strong>Mulai:</strong> {{ $activity->start_date->format('d F Y, H:i') }}</p>
                <p class="text-gray-600"><strong>Selesai:</strong> {{ $activity->end_date->format('d F Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-600"><strong>Status:</strong> {{ $activity->status }}</p>
                <p class="text-gray-600"><strong>Target Peserta:</strong> {{ $activity->target_participants ?? 'Tidak Ada' }}</p>
                <p class="text-gray-600"><strong>Dana Dibutuhkan:</strong> {{ $activity->required_funds ? 'Rp ' . number_format($activity->required_funds, 2, ',', '.') : 'Tidak Ada' }}</p>
            </div>
        </div>

        <div class="flex mt-6">
            <a href="{{ route('admin.activities.edit', $activity->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">
                Edit Kegiatan
            </a>
            <a href="{{ route('admin.activities.participations.index', $activity->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded ml-2 text-sm">
                Partisipasi
            </a>
            <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus kegiatan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Hapus Kegiatan
                </button>
            </form>
            <a href="{{ route('admin.activities.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-auto">
                Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection