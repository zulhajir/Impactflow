<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker; // Pastikan ini ada

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Inisialisasi Faker dengan lokal Indonesia
        $faker = Faker::create('id_ID');

        $userId = User::inRandomOrder()->first()->id ?? User::factory()->create()->id;

        $startDate = $faker->dateTimeBetween('-1 month', '+3 months');
        $endDate = $faker->dateTimeBetween($startDate, (clone $startDate)->modify('+1 week'));
        $statuses = ['Planned', 'Ongoing', 'Completed', 'Cancelled'];

        // --- Data Relevan Palu/Indonesia ---
        $paluLocations = [
            'Lapangan Vatulemo, Palu',
            'Pusat Kuliner Palu, Jl. Diponegoro',
            'Pantai Talise, Palu',
            'Hutan Kota Palu',
            'Universitas Tadulako, Palu',
            'Hotel Santika Palu',
            'Gedung Olahraga Palu',
            'Masjid Raya Baiturrahim, Palu',
            'Perpustakaan Provinsi Sulawesi Tengah, Palu',
            'Taman Nasional Lore Lindu (dekat Palu)',
            'Anjungan Nusantara Palu',
            'Jembatan Ponulele, Palu',
        ];

        $activityTitles = [
            'Festival Teluk Palu',
            'Bazar UMKM dan Kuliner Khas Palu',
            'Workshop Peningkatan Kapasitas SDM Pariwisata',
            'Pelatihan Penanggulangan Bencana Alam',
            'Kegiatan Sosial Bersih-Bersih Lingkungan Pantai Talise',
            'Seminar Nasional Transformasi Digital di Era Industri 4.0',
            'Pentas Seni dan Budaya Daerah Sulawesi Tengah',
            'Lomba Lari Palu Fun Run 10K',
            'Pameran Foto Keindahan Alam dan Budaya Palu',
            'Donor Darah Bersama PMI Kota Palu',
            'Diskusi Publik Isu Lingkungan Kota Palu',
            'Gebyar Vaksinasi COVID-19 Tahap Lanjutan', // Contoh relevan di masa pandemi
        ];

        $activityDescriptions = [
            'Kegiatan ini bertujuan untuk mempromosikan pariwisata lokal dan mengangkat potensi UMKM di Kota Palu.',
            'Peserta akan mendapatkan pemahaman mendalam tentang manajemen risiko bencana dan teknik evakuasi dasar.',
            'Acara ini terbuka untuk umum, mari bersama menjaga kebersihan lingkungan kita untuk masa depan yang lebih baik.',
            'Mengajak masyarakat untuk berpartisipasi dalam pengembangan ekonomi kreatif melalui digitalisasi produk.',
            'Sebuah persembahan bagi kekayaan seni dan budaya yang dimiliki Provinsi Sulawesi Tengah.',
            'Ajang silaturahmi sekaligus meningkatkan kesadaran akan pentingnya gaya hidup sehat.',
            'Menampilkan karya-karya fotografi terbaik yang menggambarkan pesona alam Palu dan sekitarnya.',
            'Mari bersama membantu sesama dengan mendonorkan darah, setetes darah Anda menyelamatkan nyawa.',
            'Diskusi interaktif tentang solusi inovatif untuk masalah lingkungan di perkotaan.',
        ];
        // --- Akhir Data Relevan Palu/Indonesia ---

        return [
            'user_id' => $userId,
            'title' => $faker->randomElement($activityTitles), // Judul kegiatan yang relevan
            'description' => $faker->randomElement($activityDescriptions) . ' ' . $faker->paragraphs(1, true), // Deskripsi relevan + tambahan paragraf acak
            'start_date' => $startDate->format('Y-m-d H:i:s'),
            'end_date' => $endDate->format('Y-m-d H:i:s'),
            'location' => $faker->randomElement($paluLocations), // Lokasi kegiatan di Palu
            'target_participants' => $faker->numberBetween(10, 200),
            'status' => $faker->randomElement($statuses),
            'required_funds' => $faker->randomFloat(2, 100000, 50000000),
            'image_url' => 'https://picsum.photos/seed/' . $faker->word() . '/800/400',
        ];
    }
}