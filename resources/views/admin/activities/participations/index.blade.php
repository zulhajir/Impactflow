@extends('layouts.admin')

@section('title', '| Partisipasi Kegiatan')
@section('header', 'Partisipasi Kegiatan: ' . $activity->title)

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Partisipasi Kegiatan: <span class="text-blue-600">{{ $activity->title }}</span></h1>
            <a href="{{ route('admin.activities.show', $activity->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Kembali ke Detail Kegiatan
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

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada masalah saat menambahkan partisipasi.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-4 text-gray-700">Tambah Partisipasi Baru:</h2>
        <form action="{{ route('admin.activities.participations.store', $activity->id) }}" method="POST" class="mb-8 p-4 border rounded-lg bg-gray-50">
            @csrf
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Pengguna:</label>
                <select id="user_id" name="user_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Pilih Pengguna --</option>
                    @foreach ($usersNotParticipating as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Partisipasi:</label>
                <select id="type" name="type" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="participant" {{ old('type') == 'participant' ? 'selected' : '' }}>Peserta</option>
                    <option value="volunteer" {{ old('type') == 'volunteer' ? 'selected' : '' }}>Sukarelawan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status Pendaftaran:</label>
                <select id="status" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="Registered" {{ old('status') == 'Registered' ? 'selected' : '' }}>Terdaftar</option>
                    <option value="Attended" {{ old('status') == 'Attended' ? 'selected' : '' }}>Hadir (Peserta)</option>
                    <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    <option value="Assigned" {{ old('status') == 'Assigned' ? 'selected' : '' }}>Ditugaskan (Sukarelawan)</option>
                    <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Selesai (Sukarelawan)</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="assigned_task" class="block text-gray-700 text-sm font-bold mb-2">Tugas Ditugaskan (khusus Sukarelawan):</label>
                <input type="text" id="assigned_task" name="assigned_task" value="{{ old('assigned_task') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="hours_volunteered" class="block text-gray-700 text-sm font-bold mb-2">Jam Sukarela (khusus Sukarelawan):</label>
                <input type="number" id="hours_volunteered" name="hours_volunteered" value="{{ old('hours_volunteered') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Catatan (Opsional):</label>
                <textarea id="notes" name="notes" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('notes') }}</textarea>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Tambah Partisipasi
            </button>
        </form>

        <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftar Partisipasi:</h2>
        @if ($participations->isEmpty())
            <p class="text-gray-600 text-center">Belum ada partisipasi untuk kegiatan ini.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Nama Pengguna</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Email</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Tipe</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Status</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600">Tugas/Catatan</th>
                            <th class="py-2 px-4 border-b text-center text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participations as $participation)
                            <tr>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $participation->user->name ?? 'User Dihapus' }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ $participation->user->email ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">{{ ucfirst($participation->type) }}</td>
                                <td class="py-2 px-4 border-b text-gray-800">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($participation->status == 'Registered') bg-blue-200 text-blue-800
                                        @elseif($participation->status == 'Attended' || $participation->status == 'Completed') bg-green-200 text-green-800
                                        @elseif($participation->status == 'Assigned') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ $participation->status }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b text-gray-800">
                                    @if($participation->type == 'volunteer')
                                        Tugas: {{ $participation->assigned_task ?? '-' }} <br>
                                        Jam: {{ $participation->hours_volunteered ?? '-' }}
                                    @else
                                        Catatan: {{ $participation->notes ?? '-' }}
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    {{-- Form untuk update status --}}
                                    <form action="{{ route('admin.activities.participations.update', ['activity' => $activity->id, 'participation' => $participation->id]) }}" method="POST" class="inline-block mr-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                                            <option value="Registered" {{ $participation->status == 'Registered' ? 'selected' : '' }}>Terdaftar</option>
                                            <option value="Attended" {{ $participation->status == 'Attended' ? 'selected' : '' }}>Hadir (Peserta)</option>
                                            <option value="Cancelled" {{ $participation->status == 'Cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                            <option value="Assigned" {{ $participation->status == 'Assigned' ? 'selected' : '' }}>Ditugaskan (Sklw)</option>
                                            <option value="Completed" {{ $participation->status == 'Completed' ? 'selected' : '' }}>Selesai (Sklw)</option>
                                        </select>
                                    </form>

                                    {{-- Tombol hapus partisipasi --}}
                                    <form action="{{ route('admin.activities.participations.destroy', ['activity' => $activity->id, 'participation' => $participation->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus partisipasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.activities.participations.export', $activity->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Ekspor Data Partisipasi</a>
            </div>
        @endif
    </div>
@endsection