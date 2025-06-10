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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pembuat konten
            $table->foreignId('activity_id')->nullable()->constrained()->onDelete('set null'); // Opsional, jika konten adalah laporan kegiatan
            $table->string('title');
            $table->string('slug')->unique()->nullable(); // Untuk URL ramah SEO (berita/artikel)
            // Tipe konten: 'news', 'announcement', 'activity_report', 'financial_report', 'impact_report', 'volunteer_report', 'about_page', 'contact_page'
            $table->string('type');
            $table->text('excerpt')->nullable(); // Ringkasan (untuk berita/artikel)
            $table->longText('body')->nullable(); // Isi konten atau laporan
            $table->string('file_url')->nullable(); // URL/Path file (untuk laporan jika berupa dokumen)
            $table->boolean('is_published')->default(false); // Status publikasi (untuk berita/artikel/halaman)
            $table->timestamp('published_at')->nullable(); // Tanggal publikasi
            $table->dateTime('report_date')->nullable(); // Tanggal laporan (khusus type laporan)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
