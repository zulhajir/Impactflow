@extends('layouts.public')

@section('title', '| Donasi')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Ayo Berdonasi untuk ImpactFlow!</h1>
            <p class="text-gray-700 text-center mb-8">Setiap donasi Anda sangat berarti untuk mendukung kegiatan sosial kami.</p>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    @if ($errors->any())
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif

            <form action="{{ route('public.donations.submit') }}" method="POST" class="mb-8">
                @csrf

                @guest
                    <div class="mb-4">
                        <label for="is_anonymous" class="flex items-center text-gray-700 text-sm font-bold mb-2">
                            <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }} class="form-checkbox h-4 w-4 text-blue-600 mr-2" onchange="toggleDonorFields()">
                            Donasi Anonim (Nama & Email tidak akan ditampilkan)
                        </label>
                    </div>
                    <div id="donor-fields" class="{{ old('is_anonymous') ? 'hidden' : '' }}">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Anda:</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Anda:</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                @else
                    <p class="text-gray-700 mb-4">Anda berdonasi sebagai: <span class="font-bold">{{ Auth::user()->name }} ({{ Auth::user()->email }})</span></p>
                    <div class="mb-4">
                        <label for="is_anonymous" class="flex items-center text-gray-700 text-sm font-bold mb-2">
                            <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }} class="form-checkbox h-4 w-4 text-blue-600 mr-2">
                            Sembunyikan Nama Saya (Donasi Anonim)
                        </label>
                    </div>
                @endguest


                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Donasi (IDR):</label>
                    <input type="number" step="any" id="amount" name="amount" value="{{ old('amount') }}" required min="10000"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-xs text-gray-500 mt-1">Minimal donasi Rp 10.000</p>
                </div>

                <div class="mb-4">
                    <label for="payment_method" class="block text-gray-700 text-sm font-bold mb-2">Metode Pembayaran:</label>
                    <select id="payment_method" name="payment_method" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                        <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash (Datang Langsung)</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="activity_id" class="block text-gray-700 text-sm font-bold mb-2">Untuk Kegiatan (Opsional):</label>
                    <select id="activity_id" name="activity_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">-- Donasi Umum/Organisasi --</option>
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>{{ $activity->title }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-6 rounded-full w-full shadow-lg transform transition duration-300 hover:scale-105">
                    Kirim Donasi
                </button>
            </form>

            <script>
                function toggleDonorFields() {
                    const isAnonymousCheckbox = document.getElementById('is_anonymous');
                    const donorFields = document.getElementById('donor-fields');
                    if (isAnonymousCheckbox.checked) {
                        donorFields.classList.add('hidden');
                        donorFields.querySelectorAll('input').forEach(input => input.removeAttribute('required'));
                    } else {
                        donorFields.classList.remove('hidden');
                        donorFields.querySelectorAll('input').forEach(input => input.setAttribute('required', 'required'));
                    }
                }
                document.addEventListener('DOMContentLoaded', toggleDonorFields);
            </script>
        </div>
    </div>
@endsection