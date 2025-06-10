<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Judul album atau caption gambar
            $table->text('description')->nullable(); // Deskripsi album
            // Tipe media: 'album', 'image', 'video'
            $table->string('type');
            $table->string('media_url'); // URL gambar/video
            $table->string('thumbnail_url')->nullable(); // URL thumbnail untuk video/album
            $table->boolean('is_published')->default(false);
            // Self-referencing foreign key for albums
            $table->foreignId('album_id')->nullable()->constrained('media')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
