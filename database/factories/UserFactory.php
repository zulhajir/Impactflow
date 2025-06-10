<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker; // Pastikan ini ada

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    // Tidak perlu lagi override __construct

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Inisialisasi Faker di dalam definition() atau sebagai properti.
        // Jika hanya di sini, ia akan dibuat setiap kali definition dipanggil.
        // Opsi yang lebih baik adalah membuatnya menjadi properti, seperti yang sudah ada di base Factory.
        // Namun, jika masalahnya di constructor, kita biarkan saja.
        $faker = Faker::create('id_ID'); // Inisialisasi di sini jika Anda tidak meng-override constructor

        // Pilihan role yang valid
        $roles = ['user', 'admin'];

        // Contoh alamat atau kota yang relevan dengan Palu dan sekitarnya
        $paluAddresses = [
            'Jl. Sam Ratulangi No. ' . $faker->buildingNumber(), // Gunakan $faker di sini
            'Jl. Basuki Rahmat No. ' . $faker->buildingNumber(),
            'Jl. Garuda No. ' . $faker->buildingNumber(),
            'Jl. Juanda No. ' . $faker->buildingNumber(),
            'Jl. Tombolotutu No. ' . $faker->buildingNumber(),
            'Perumahan Citraland Palu Blok ' . $faker->randomLetter() . ' No. ' . $faker->buildingNumber(),
            'BTN Bumi Bahari Blok ' . $faker->randomLetter() . ' No. ' . $faker->buildingNumber(),
            'Desa Salena, Kec. Mantikulore',
            'Kelurahan Tatura Utara, Kec. Palu Selatan',
            'Kelurahan Besusu Timur, Kec. Palu Timur',
        ];

        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => $faker->randomElement($roles),
            'phone_number' => $faker->phoneNumber,
            'address' => $faker->randomElement($paluAddresses) . ', Kota Palu, Sulawesi Tengah',
        ];
    }

    /**
     * Indicate that the user is an admin.
     */
    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'admin',
            ];
        });
    }
}