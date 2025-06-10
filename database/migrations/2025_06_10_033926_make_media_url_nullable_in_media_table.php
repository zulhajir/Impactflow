<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media', function (Blueprint $table) {
            // Ubah kolom media_url menjadi nullable
            $table->string('media_url')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            // Kembalikan ke non-nullable jika rollback dibutuhkan.
            // Hati-hati: ini akan gagal jika ada null di kolom saat ini.
            $table->string('media_url')->nullable(false)->change();
        });
    }
};