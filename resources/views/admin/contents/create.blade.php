@extends('layouts.admin')

@section('title', '| Tambah Konten')
@section('header', 'Tambah Konten Baru')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Konten Baru</h1>

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

        <form action="{{ route('admin.contents.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Konten:</label>
                <select id="type" name="type" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" onchange="toggleContentTypeFields()">
                    <option value="">-- Pilih Tipe Konten --</option>
                    <option value="news" {{ old('type') == 'news' ? 'selected' : '' }}>Berita</option>
                    <option value="announcement" {{ old('type') == 'announcement' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="activity_report" {{ old('type') == 'activity_report' ? 'selected' : '' }}>Laporan Kegiatan</option>
                    <option value="financial_report" {{ old('type') == 'financial_report' ? 'selected' : '' }}>Laporan Keuangan</option>
                    <option value="impact_report" {{ old('type') == 'impact_report' ? 'selected' : '' }}>Laporan Dampak</option>
                    <option value="volunteer_report" {{ old('type') == 'volunteer_report' ? 'selected' : '' }}>Laporan Sukarelawan</option>
                    <option value="about_page" {{ old('type') == 'about_page' ? 'selected' : '' }}>Halaman Tentang Kami</option>
                    <option value="contact_page" {{ old('type') == 'contact_page' ? 'selected' : '' }}>Halaman Kontak Kami</option>
                </select>
            </div>

            <div id="common_fields">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul:</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Isi Konten/Laporan:</label>
                    <textarea id="body" name="body" rows="8" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('body') }}</textarea>
                </div>
            </div>

            <div id="news_announcement_fields" class="hidden">
                <div class="mb-4">
                    <label for="excerpt" class="block text-gray-700 text-sm font-bold mb-2">Ringkasan (untuk Berita/Pengumuman):</label>
                    <textarea id="excerpt" name="excerpt" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('excerpt') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">URL Gambar Sampul (untuk Berita/Pengumuman):</label>
                    <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="is_published" class="inline-flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="form-checkbox">
                        <span class="ml-2 text-gray-700">Publikasikan</span>
                    </label>
                </div>
            </div>

            <div id="report_fields" class="hidden">
                <div class="mb-4">
                    <label for="activity_id" class="block text-gray-700 text-sm font-bold mb-2">Kegiatan Terkait (khusus Laporan, Opsional):</label>
                    <select id="activity_id" name="activity_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">-- Pilih Kegiatan --</option>
                        @foreach($activities as $activity)
                            <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>{{ $activity->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="file_url" class="block text-gray-700 text-sm font-bold mb-2">URL/Path File Laporan (Opsional):</label>
                    <input type="url" id="file_url" name="file_url" value="{{ old('file_url') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="report_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Laporan:</label>
                    <input type="datetime-local" id="report_date" name="report_date" value="{{ old('report_date', now()->format('Y-m-d\TH:i')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Konten
                </button>
                <a href="{{ route('admin.contents.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>

        <script>
            function toggleContentTypeFields() {
                const type = document.getElementById('type').value;
                const newsAnnouncementFields = document.getElementById('news_announcement_fields');
                const reportFields = document.getElementById('report_fields');

                // Sembunyikan semua dan hapus required
                newsAnnouncementFields.classList.add('hidden');
                reportFields.classList.add('hidden');
                newsAnnouncementFields.querySelectorAll('input, textarea, select').forEach(el => el.removeAttribute('required'));
                reportFields.querySelectorAll('input, textarea, select').forEach(el => el.removeAttribute('required'));

                // Tampilkan dan atur required sesuai type
                if (type === 'news' || type === 'announcement') {
                    newsAnnouncementFields.classList.remove('hidden');
                    // Tambahkan required jika diperlukan, misal untuk excerpt di sini
                    // document.getElementById('excerpt').setAttribute('required', 'required');
                } else if (type.includes('report')) { // Jika tipe mengandung 'report'
                    reportFields.classList.remove('hidden');
                    document.getElementById('report_date').setAttribute('required', 'required');
                    // document.getElementById('file_url').setAttribute('required', 'required'); // uncomment if file_url is always required for reports
                }
            }
            document.addEventListener('DOMContentLoaded', toggleContentTypeFields);
            document.getElementById('type').addEventListener('change', toggleContentTypeFields);
        </script>
    </div>
@endsection