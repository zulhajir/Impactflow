@extends('layouts.public')

@section('title', '| Kegiatan')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Kegiatan Sosial Kami</h1>

        @if ($activities->isEmpty())
            <p class="text-gray-600 text-center text-lg">Belum ada kegiatan yang tersedia saat ini.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($activities as $activity)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        @if ($activity->image_url)
                            <img src="{{ $activity->image_url }}" alt="{{ $activity->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">Tidak ada gambar</div>
                        @endif
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $activity->title }}</h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $activity->description }}</p>
                            <p class="text-gray-700 text-sm mb-2"><strong class="font-medium">Lokasi:</strong> {{ $activity->location }}</p>
                            <p class="text-gray-700 text-sm mb-2"><strong class="font-medium">Tanggal:</strong> {{ $activity->start_date->format('d M Y') }}</p>
                            <p class="text-gray-700 text-sm mb-4"><strong class="font-medium">Status:</strong>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($activity->status == 'Planned') bg-blue-200 text-blue-800
                                    @else bg-green-200 text-green-800 @endif">
                                    {{ $activity->status }}
                                </span>
                            </p>
                            <a href="{{ route('public.activities.show', $activity->id) }}" class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
@endsection