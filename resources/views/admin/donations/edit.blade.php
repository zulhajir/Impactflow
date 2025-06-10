@extends('layouts.admin')

@section('title', '| Edit Donasi')
@section('header', 'Edit Donasi')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Donasi</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Donatur (Opsional):</label>
                <select id="user_id" name="user_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Pilih Donatur (Kosongkan untuk Anonim) --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $donation->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="activity_id" class="block text-gray-700 text-sm font-bold mb-2">Kegiatan Terkait (Opsional):</label>
                <select id="activity_id" name="activity_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Pilih Kegiatan (Kosongkan untuk Donasi Umum) --</option>
                    @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}" {{ old('activity_id', $donation->activity_id) == $activity->id ? 'selected' : '' }}>{{ $activity->title }}</option>
                    @endforeach
                </select>
                @error('activity_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Donasi:</label>
                    <input type="number" step="0.01" id="amount" name="amount" value="{{ old('amount', $donation->amount) }}" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="currency" class="block text-gray-700 text-sm font-bold mb-2">Mata Uang:</label>
                    <input type="text" id="currency" name="currency" value="{{ old('currency', $donation->currency) }}" required maxlength="3"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="mb-4">
                <label for="donation_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Donasi:</label>
                <input type="datetime-local" id="donation_date" name="donation_date" value="{{ old('donation_date', \Carbon\Carbon::parse($donation->donation_date)->format('Y-m-d\TH:i')) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="payment_method" class="block text-gray-700 text-sm font-bold mb-2">Metode Pembayaran:</label>
                <input type="text" id="payment_method" name="payment_method" value="{{ old('payment_method', $donation->payment_method) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                <select id="status" name="status" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="Pending" {{ old('status', $donation->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ old('status', $donation->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Failed" {{ old('status', $donation->status) == 'Failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="is_anonymous" class="flex items-center text-gray-700 text-sm font-bold">
                    <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1" {{ old('is_anonymous', $donation->is_anonymous) ? 'checked' : '' }}
                           class="form-checkbox h-4 w-4 text-blue-600 mr-2">
                    Donasi Anonim
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui Donasi
                </button>
                <a href="{{ route('admin.donations.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection