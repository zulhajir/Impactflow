@extends('layouts.public')

@section('title', '| ' . $activity->title)

@section('content')
    <div class="container mx-auto p-6">
        <a href="{{ route('public.activities.index') }}" class="text-blue-500 hover:underline mb-6 inline-block text-lg">&larr; Kembali ke Daftar Kegiatan</a>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $activity->title }}</h1>

            @if ($activity->image_url)
                <img src="{{ $activity->image_url }}" alt="{{ $activity->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
            @else
                <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-500 text-lg mb-6 rounded-lg">Gambar Tidak Tersedia</div>
            @endif

            <div class="mb-6">
                <p class="text-lg text-gray-700 leading-relaxed">{{ $activity->description }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-gray-600 text-md"><strong class="font-medium">Lokasi:</strong> {{ $activity->location }}</p>
                    <p class="text-gray-600 text-md"><strong class="font-medium">Dimulai:</strong> {{ $activity->start_date->format('d F Y, H:i') }}</p>
                    <p class="text-gray-600 text-md"><strong class="font-medium">Berakhir:</strong> {{ $activity->end_date->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-md"><strong class="font-medium">Status:</strong>
                        <span class="px-2 py-1 rounded-full text-sm font-semibold
                            @if($activity->status == 'Planned') bg-blue-200 text-blue-800
                            @else bg-green-200 text-green-800 @endif">
                            {{ $activity->status }}
                        </span>
                    </p>
                    <p class="text-gray-600 text-md"><strong class="font-medium">Target Peserta:</strong> {{ $activity->target_participants ?? 'Tidak Ada' }}</p>
                    <p class="text-gray-600 text-md"><strong class="font-medium">Dana Dibutuhkan:</strong> {{ $activity->required_funds ? 'Rp ' . number_format($activity->required_funds, 2, ',', '.') : 'Tidak Ada' }}</p>
                </div>
            </div>

            {{-- Tombol Daftar Jadi Peserta --}}
            <h3 class="text-xl font-semibold mt-8 mb-4">Ingin Ikut Serta sebagai Peserta?</h3>
            @auth
                @if ($isParticipant)
                    <button class="bg-gray-400 text-white font-bold py-3 px-6 rounded-full opacity-75 cursor-not-allowed" disabled>
                        Sudah Terdaftar sebagai Peserta
                    </button>
                    <form action="{{ route('public.participation.cancel', ['activity' => $activity->id, 'type' => 'participant']) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Anda yakin ingin membatalkan pendaftaran peserta ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-full transition-colors duration-300">
                            Batalkan Pendaftaran Peserta
                        </button>
                    </form>
                @else
                    <form action="{{ route('public.participation.register', ['activity' => $activity->id, 'type' => 'participant']) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full shadow-md transform transition duration-300 hover:scale-105">
                            Daftar Jadi Peserta Sekarang!
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full shadow-md transform transition duration-300 hover:scale-105">
                    Login untuk Daftar Jadi Peserta
                </a>
            @endauth

            {{-- Tombol Daftar Jadi Sukarelawan --}}
            <h3 class="text-xl font-semibold mt-8 mb-4">Ingin Menjadi Sukarelawan?</h3>
            @auth
                @if ($isVolunteer)
                    <button class="bg-gray-400 text-white font-bold py-3 px-6 rounded-full opacity-75 cursor-not-allowed" disabled>
                        Sudah Terdaftar sebagai Sukarelawan
                    </button>
                    <form action="{{ route('public.participation.cancel', ['activity' => $activity->id, 'type' => 'volunteer']) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Anda yakin ingin membatalkan pendaftaran sukarelawan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-full transition-colors duration-300">
                            Batalkan Sukarelawan
                        </button>
                    </form>
                @else
                    <form action="{{ route('public.participation.register', ['activity' => $activity->id, 'type' => 'volunteer']) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full shadow-md transform transition duration-300 hover:scale-105">
                            Daftar Jadi Sukarelawan Sekarang!
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full shadow-md transform transition duration-300 hover:scale-105">
                    Login untuk Daftar Jadi Sukarelawan
                </a>
            @endauth
        </div>
    </div>
@endsection