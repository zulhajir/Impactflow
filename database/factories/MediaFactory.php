<?php

namespace Database\Factories;

use App\Models\Media; // Pastikan ini benar
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker; // Pastikan ini ada

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Inisialisasi Faker dengan lokal Indonesia
        $faker = Faker::create('id_ID');

        // Daftar tipe media yang valid
        $mediaTypes = ['album', 'image', 'video'];
        $type = $faker->randomElement($mediaTypes);

        $title = null;
        $description = null;
        $mediaUrl = null;
        $thumbnailUrl = null;
        $isPublished = true;
        $albumId = null;

        switch ($type) {
            case 'album':
                $titles = [
                    'Galeri Kegiatan Sosial Palu',
                    'Dokumentasi Bantuan Bencana Palu',
                    'Album Foto Pembangunan Kembali Kota',
                    'Potret Keindahan Alam Sulawesi Tengah',
                    'Kumpulan Video Acara Komunitas',
                    'Foto Relawan ImpactFlow',
                ];
                $descriptions = [
                    'Kumpulan foto kegiatan sosial yang telah kami lakukan di berbagai wilayah Palu.',
                    'Dokumentasi visual dari proses penyaluran bantuan dan rehabilitasi pasca bencana di Palu.',
                    'Foto-foto kemajuan pembangunan infrastruktur dan fasilitas umum di Kota Palu.',
                    'Indahnya pemandangan alam Sulawesi Tengah yang terekam dalam bidikan kamera.',
                    'Video-video singkat yang mengabadikan momen-momen penting dari acara komunitas.',
                ];
                $title = $faker->randomElement($titles);
                $description = $faker->randomElement($descriptions);
                $mediaUrl = null; // Album tidak punya media_url sendiri, isinya adalah media lain
                $thumbnailUrl = 'https://picsum.photos/seed/' . $faker->word() . '/400/300'; // Thumbnail untuk album
                break;

            case 'image':
                $titles = [
                    'Gotong Royong Bersih Pantai',
                    'Penyerahan Bantuan Sembako',
                    'Suasana Pelatihan UMKM',
                    'Peserta Lomba Lari Palu Fun Run',
                    'Pemandangan Matahari Terbit di Teluk Palu',
                    'Anak-anak Bermain di Taman Kota',
                ];
                $captions = [
                    'Warga Palu bahu membahu membersihkan sampah di pesisir pantai.',
                    'Tim relawan menyerahkan paket sembako kepada keluarga terdampak.',
                    'Antusiasme peserta dalam sesi pelatihan kewirausahaan.',
                    'Semangat para pelari di garis start Palu Fun Run.',
                    'Indahnya panorama pagi di Teluk Palu, memukau hati.',
                    'Senyum ceria anak-anak menikmati fasilitas di taman kota.',
                ];
                $title = $faker->randomElement($titles);
                $description = $faker->randomElement($captions); // Deskripsi sebagai caption
                $mediaUrl = 'https://picsum.photos/seed/' . $faker->word() . '/1200/800'; // Contoh URL gambar
                $thumbnailUrl = null; // Gambar tidak butuh thumbnail terpisah kecuali untuk galeri
                break;

            case 'video':
                $titles = [
                    'Sorotan Kegiatan Donor Darah PMI Palu',
                    'Cuplikan Festival Budaya Palu',
                    'Video Edukasi Pencegahan Stunting',
                    'Wawancara dengan Tokoh Masyarakat Palu',
                    'Peresmian Proyek Rehabilitasi Desa',
                ];
                $descriptions = [
                    'Video singkat yang menampilkan momen-momen penting dalam kegiatan donor darah di Palu.',
                    'Potongan-potongan menarik dari pagelaran seni dan budaya lokal Palu.',
                    'Video informatif mengenai pentingnya gizi seimbang untuk tumbuh kembang anak.',
                    'Diskusi eksklusif dengan Bapak/Ibu [Nama Tokoh] tentang masa depan Palu.',
                    'Dokumentasi proses peresmian proyek rehabilitasi desa yang baru saja selesai.',
                ];
                $title = $faker->randomElement($titles);
                $description = $faker->randomElement($descriptions);
                $mediaUrl = 'https://www.youtube.com/embed/' . $faker->unique()->randomElement([
                    'dQw4w9WgXcQ', // Rick Astley - Never Gonna Give You Up (contoh populer)
                    'BTYN_6yZg1M', // Contoh ID video YouTube lain
                    'P3e00Qj4q7M',
                    'V4-qfX0F69Q',
                    'o-YJ341fXgI',
                    'RjM3FzH3mBw', // Contoh ID video YouTube dari Palu atau terkait (jika ada)
                ]); // Contoh URL video YouTube
                $thumbnailUrl = 'https://img.youtube.com/vi/' . basename($mediaUrl) . '/mqdefault.jpg'; // Thumbnail YouTube
                break;
        }

        // Untuk gambar/video, secara acak kaitkan dengan album yang sudah ada jika ada
        if ($type !== 'album') {
            $existingAlbum = Media::where('type', 'album')->inRandomOrder()->first();
            if ($existingAlbum && $faker->boolean(70)) { // 70% kemungkinan terkait album
                $albumId = $existingAlbum->id;
            }
        }


        return [
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'media_url' => $mediaUrl,
            'thumbnail_url' => $thumbnailUrl,
            'is_published' => $isPublished,
            'album_id' => $albumId,
        ];
    }
}