<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 3 data kegiatan dummy menggunakan factory.
        // Data relevan Palu akan dihasilkan oleh ActivityFactory yang sudah disesuaikan.
        Activity::factory(3)->create();
    }
}