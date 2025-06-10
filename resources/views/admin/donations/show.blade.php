@extends('layouts.admin')

@section('title', '| Detail Donasi')
@section('header', 'Detail Donasi')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Detail Donasi</h1>

        <div class="mb-4">
            <p class="text-gray-600"><strong>Donatur:</strong> {{ $donation->is_anonymous ? 'Anonim' : ($donation->user->name ?? 'User Dihapus') }}</p>
            <p class="text-gray-600"><strong>Email Donatur:</strong> {{ $donation->is_anonymous ? '-' : ($donation->user->email ?? '-') }}</p>
            <p class="text-gray-600"><strong>Untuk Kegiatan:</strong> {{ $donation->activity->title ?? 'Umum/Organisasi' }}</p>
            <p class="text-gray-600"><strong>Jumlah:</strong> {{ $donation->currency }} {{ number_format($donation->amount, 2, ',', '.') }}</p>
            <p class="text-gray-600"><strong>Tanggal Donasi:</strong> {{ $donation->donation_date->format('d F Y, H:i') }}</p>
            <p class="text-gray-600"><strong>Metode Pembayaran:</strong> {{ $donation->payment_method }}</p>
            <p class="text-gray-600"><strong>Status:</strong>
                <span class="px-2 py-1 rounded-full text-sm font-semibold
                    @if($donation->status == 'Completed') bg-green-200 text-green-800
                    @elseif($donation->status == 'Pending') bg-yellow-200 text-yellow-800
                    @else bg-red-200 text-red-800 @endif">
                    {{ $donation->status }}
                </span>
            </p>
        </div>

        <div class="flex mt-6">
            <a href="{{ route('admin.donations.edit', $donation->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">
                Edit Donasi
            </a>
            <form action="{{ route('admin.donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus donasi ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Hapus Donasi
                </button>
            </form>
            <a href="{{ route('admin.donations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-auto">
                Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection