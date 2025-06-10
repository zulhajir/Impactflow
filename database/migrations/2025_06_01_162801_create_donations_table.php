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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Donatur (bisa null jika anonim)
            $table->foreignId('activity_id')->nullable()->constrained()->onDelete('set null'); // Kegiatan terkait (bisa null jika donasi umum)
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('IDR');
            $table->dateTime('donation_date');
            $table->string('payment_method');
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('Pending'); // Pending, Completed, Failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
