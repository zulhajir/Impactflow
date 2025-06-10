<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::truncate(); // Opsional: Hapus user yang ada sebelum seed

        // Buat 8 user secara acak.
        // Data relevan Palu akan dihasilkan oleh UserFactory yang sudah disesuaikan.
        User::factory(8)->create();
    }
}