@extends('layouts.admin')

@section('title', '| Pengaturan Website')
@section('header', 'Pengaturan Website')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Pengaturan Website</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('POST') {{-- SettingController update menggunakan POST, tapi ini bisa PUT/PATCH juga --}}

            <div class="mb-4">
                <label for="site_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Situs:</label>
                <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name']->value ?? '') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="contact_email" class="block text-gray-700 text-sm font-bold mb-2">Email Kontak:</label>
                <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']->value ?? '') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon:</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $settings['phone_number']->value ?? '') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
                <textarea id="address" name="address" rows="3"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('address', $settings['address']->value ?? '') }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
@endsection