@extends('layouts.public')

@section('title', '| Kontak Kami')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-xl mx-auto">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Kontak Kami</h1>
            <p class="text-gray-700 text-center mb-8">Kami senang mendengar dari Anda! Silakan hubungi kami melalui informasi di bawah ini atau isi formulir kontak.</p>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-3 text-gray-800">Informasi Kontak</h2>
                <p class="text-gray-700 mb-2"><strong>Email:</strong> info@impactflow.org</p>
                <p class="text-gray-700 mb-2"><strong>Telepon:</strong> +62 812 3456 7890</p>
                <p class="text-gray-700 mb-2"><strong>Alamat:</strong> Jl. Karanjalemba No. 8, Kota Palu, Indonesia</p>
            </div>

            <h2 class="text-xl font-semibold mb-4 text-gray-800">Kirim Pesan kepada Kami</h2>
            <form action="#" method="POST"> {{-- Ganti # dengan rute untuk pengiriman pesan --}}
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Anda:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Anda:</label>
                    <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Pesan Anda:</label>
                    <textarea id="message" name="message" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
@endsection