@extends('layouts.admin')

@section('title', '| Manajemen Kegiatan')
@section('header', 'Daftar Kegiatan Sosial')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-end mb-6">
            <a href="{{ route('admin.activities.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Kegiatan Baru
            </a>
        </div>

        @if ($activities->isEmpty())
            <p class="text-gray-600 text-center">Belum ada kegiatan yang terdaftar.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Judul</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Lokasi</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Tanggal Mulai</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Status</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Dibuat Oleh</th>
                            <th class="py-2 px-4 border-b text-center text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $activity->title }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $activity->location }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $activity->start_date->format('d M Y') }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $activity->status }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $activity->user->name ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ route('admin.activities.show', $activity->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Lihat</a>
                                    <a href="{{ route('admin.activities.edit', $activity->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Edit</a>
                                    <a href="{{ route('admin.activities.participations.index', $activity->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded ml-2 text-sm">
                                        Partisipasi
                                    </a>
                                    <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus kegiatan ini?');">
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
                {{ $activities->links() }}
            </div>
        @endif
    </div>
@endsection