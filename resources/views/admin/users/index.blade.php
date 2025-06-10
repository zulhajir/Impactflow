@extends('layouts.admin')

@section('title', '| Manajemen Pengguna')
@section('header', 'Manajemen Pengguna')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Manajemen Pengguna</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($users->isEmpty())
            <p class="text-gray-600 text-center">Belum ada pengguna terdaftar (selain Anda).</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Nama</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Email</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Role</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Terdaftar Sejak</th>
                            <th class="py-2 px-4 border-b text-center text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">
                                    <form action="{{ route('admin.users.change-role', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <select name="role" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Lihat</a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus pengguna ini?');">
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
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection