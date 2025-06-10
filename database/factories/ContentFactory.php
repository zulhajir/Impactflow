<?php

namespace Database\Factories;

use App\Models\Content; // Pastikan ini benar
use App\Models\User;    // Impor model User
use App\Models\Activity; // Impor model Activity
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker; // Pastikan ini ada
use Illuminate\Support\Str;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Inisialisasi Faker dengan lokal Indonesia
        $faker = Faker::create('id_ID');

        // Pastikan ada user di database
        $userId = User::inRandomOrder()->first()->id ?? User::factory()->create()->id;

        // Daftar tipe konten yang valid
        $contentTypes = [
            'news',
            'announcement',
            'activity_report',
            'financial_report',
            'impact_report',
            'volunteer_report',
            // 'about_page', // Biasanya hanya 1
            // 'contact_page', // Biasanya hanya 1
        ];

        $type = $faker->randomElement($contentTypes);
        $title = '';
        $body = '';
        $excerpt = null;
        $slug = null;
        $fileUrl = null;
        $isPublished = true; // Kebanyakan konten dummy akan langsung dipublikasikan
        $publishedAt = now();
        $reportDate = null;
        $activityId = null;

        // Logika untuk konten spesifik Palu dan sesuai tipe
        switch ($type) {
            case 'news':
                $titles = [
                    'Palu Bangkit: Revitalisasi Ekonomi Lokal Pasca Bencana',
                    'Warga Palu Sambut Baik Program Pelatihan UMKM',
                    'Inovasi Pertanian Berkelanjutan di Lembah Palu',
                    'Potensi Wisata Bahari di Teluk Palu Makin Bersinar',
                    'Sektor Perikanan Palu Terus Tumbuh dengan Bantuan Komunitas',
                    'Kerja Bakti Massal di Pantai Talise Tingkatkan Kebersihan Lingkungan',
                    'Komunitas Pemuda Palu Gelar Kampanye Anti Narkoba',
                ];
                $title = $faker->randomElement($titles);
                $body = $faker->paragraphs(mt_rand(5, 10), true);
                $excerpt = $faker->paragraph(mt_rand(2, 4));
                $slug = Str::slug($title . '-' . uniqid()); // Pastikan slug unik
                break;

            case 'announcement':
                $titles = [
                    'Pengumuman: Jadwal Vaksinasi Massal di Kantor Wali Kota Palu',
                    'Pemberitahuan: Penutupan Sementara Jembatan Kuning untuk Perbaikan',
                    'Undangan: Diskusi Publik Pembangunan Kota Palu',
                    'Informasi Terbaru: Program Bantuan Sosial Pemerintah Kota Palu',
                ];
                $title = $faker->randomElement($titles);
                $body = $faker->paragraphs(mt_rand(3, 6), true);
                $excerpt = null; // Pengumuman biasanya tidak punya excerpt
                $slug = null;
                break;

            case 'activity_report':
            case 'volunteer_report':
                // Coba ambil activity_id dari kegiatan yang sudah ada
                $activity = Activity::inRandomOrder()->first();
                if ($activity) {
                    $activityId = $activity->id;
                    $title = ($type === 'activity_report' ? 'Laporan Kegiatan: ' : 'Laporan Relawan: ') . $activity->title;
                } else {
                    $title = ($type === 'activity_report' ? 'Laporan Kegiatan Umum ' : 'Laporan Relawan Umum ') . $faker->word();
                }

                $body = $faker->paragraphs(mt_rand(4, 8), true) . "\n\n" . "Detail lengkap kegiatan terlampir dalam dokumen.";
                $fileUrl = 'documents/reports/' . Str::slug($title) . '-' . uniqid() . '.pdf'; // Contoh URL file
                $reportDate = $faker->dateTimeBetween('-6 months', 'now');
                $isPublished = true;
                $publishedAt = $reportDate; // Tanggal publikasi sama dengan tanggal laporan
                $excerpt = null;
                $slug = null;
                break;

            case 'financial_report':
            case 'impact_report':
                $title = ($type === 'financial_report' ? 'Laporan Keuangan Tahunan ' : 'Laporan Dampak Program ') . $faker->year();
                $body = $faker->paragraphs(mt_rand(3, 7), true) . "\n\n" . "Dokumen lengkap dapat diunduh melalui tautan di bawah.";
                $fileUrl = 'documents/reports/' . Str::slug($title) . '-' . uniqid() . '.pdf';
                $reportDate = $faker->dateTimeBetween('-1 year', 'now');
                $isPublished = true;
                $publishedAt = $reportDate;
                $excerpt = null;
                $slug = null;
                $activityId = null; // Laporan ini biasanya tidak terkait dengan satu kegiatan spesifik
                break;
            // 'about_page' dan 'contact_page' biasanya dibuat manual dan tunggal, jadi tidak di-random
        }


        return [
            'user_id' => $userId,
            'activity_id' => $activityId,
            'title' => $title,
            'slug' => $slug,
            'type' => $type,
            'excerpt' => $excerpt,
            'body' => $body,
            'file_url' => $fileUrl,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'report_date' => $reportDate,
        ];
    }
}