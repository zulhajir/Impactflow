<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media; // Impor model Media

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PERINGATAN: Jika Anda menjalankan seeder ini berulang kali tanpa truncate/migrate:fresh,
        // akan ada duplikasi data.
        // Media::truncate(); // Opsional: Hapus media yang ada sebelum seed

        // 1. Buat beberapa album terlebih dahulu agar ada album yang bisa dikaitkan
        Media::factory(3)->state(['type' => 'album'])->create(); // Membuat 3 album spesifik

        // 2. Buat data media lainnya (gambar, video, dan mungkin album tambahan)
        // Jumlah total media yang akan dibuat (termasuk 3 album di atas)
        // Misalnya, kita ingin total 20 media (3 album + 17 acak)
        Media::factory(17)->create(); // Membuat 17 media acak (gambar/video/album)

        // Ini akan menghasilkan campuran:
        // - 3 album yang kita buat secara spesifik
        // - 17 media acak (yang bisa jadi gambar, video, atau album lain).
        // Beberapa gambar/video dari 17 media acak tersebut mungkin akan terhubung ke 3 album awal.
    }
}