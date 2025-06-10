@extends('layouts.admin')

@section('title', '| Detail Pengguna')
@section('header', 'Detail Pengguna')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Detail Pengguna: {{ $user->name }}</h1>

        <div class="mb-4">
            <p class="text-gray-600"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="text-gray-600"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <p class="text-gray-600"><strong>Telepon:</strong> {{ $user->phone_number ?? '-' }}</p>
            <p class="text-gray-600"><strong>Alamat:</strong> {{ $user->address ?? '-' }}</p>
            <p class="text-gray-600"><strong>Terdaftar Sejak:</strong> {{ $user->created_at->format('d F Y, H:i') }}</p>
        </div>

        <div class="flex mt-6">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">
                Edit Pengguna
            </a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus pengguna ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Hapus Pengguna
                </button>
            </form>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-auto">
                Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection