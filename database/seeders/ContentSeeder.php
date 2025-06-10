<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content; // Impor model Content

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 10 data konten dummy yang relevan
        Content::factory(10)->create();

        // Buat satu halaman About (jika Anda ingin spesifik)
        Content::updateOrCreate(
            ['type' => 'about_page'],
            [
                'user_id' => \App\Models\User::first()->id ?? \App\Models\User::factory()->create()->id,
                'title' => 'Tentang Kami - ImpactFlow Palu',
                'slug' => 'tentang-kami',
                'excerpt' => 'ImpactFlow adalah platform kolaborasi untuk kegiatan sosial di Palu.',
                'body' => 'ImpactFlow didirikan dengan tujuan untuk memfasilitasi dan mengkoordinasikan berbagai kegiatan sosial dan kemanusiaan di Kota Palu dan sekitarnya. Kami percaya bahwa dengan semangat gotong royong, kita bisa menciptakan dampak positif yang lebih besar bagi masyarakat. Bergabunglah bersama kami untuk membangun Palu yang lebih baik!',
                'is_published' => true,
                'published_at' => now(),
            ]
        );

        // Buat satu halaman Kontak (jika Anda ingin spesifik)
        Content::updateOrCreate(
            ['type' => 'contact_page'],
            [
                'user_id' => \App\Models\User::first()->id ?? \App\Models\User::factory()->create()->id,
                'title' => 'Hubungi Kami',
                'slug' => 'kontak',
                'excerpt' => 'Silakan hubungi kami untuk informasi lebih lanjut.',
                'body' => 'Anda dapat menghubungi tim ImpactFlow melalui email di info@impactflowpalu.org atau mengunjungi kantor kami di Jl. Sam Ratulangi No. 12, Kota Palu. Kami siap membantu Anda!',
                'is_published' => true,
                'published_at' => now(),
            ]
        );
    }
}