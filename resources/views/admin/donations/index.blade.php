@extends('layouts.admin')

@section('title', '| Manajemen Donasi')
@section('header', 'Daftar Donasi')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Donasi</h1>
            <a href="{{ route('admin.donations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Donasi Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
        @endif

        @if ($donations->isEmpty())
            <p class="text-gray-600 text-center">Belum ada donasi yang terdaftar.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Donatur</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Kegiatan</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Jumlah</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Tanggal</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Metode</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Status</th>
                            <th class="py-2 px-4 border-b text-center text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donations as $donation)
                            <tr>
                                <td class="py-2 px-4 border-b text-gray-800">
                                    {{ $donation->is_anonymous ? 'Anonim' : ($donation->user->name ?? 'User Dihapus') }}
                                </td>
                                <td class="py-2 px-4 border-b text-gray-800">
                                    {{ $donation->activity->title ?? 'Umum/Organisasi' }}
                                </td>
                                <td class="py-2 px-4 border-b text-gray-800">
                                    {{ $donation->currency }} {{ number_format($donation->amount, 2, ',', '.') }}
                                </td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $donation->donation_date->format('d M Y') }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $donation->payment_method }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($donation->status == 'Completed') bg-green-200 text-green-800
                                        @elseif($donation->status == 'Pending') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ $donation->status }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ route('admin.donations.show', $donation->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Lihat</a>
                                    <a href="{{ route('admin.donations.edit', $donation->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Edit</a>
                                    <form action="{{ route('admin.donations.destroy', $donation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus donasi ini?');">
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
                {{ $donations->links() }}
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.donations.export') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Ekspor Data Donasi</a>
            </div>
        @endif
    </div>
@endsection