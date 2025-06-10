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
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'participant' atau 'volunteer'
            $table->dateTime('registration_date');
            // Status untuk peserta: Registered, Attended, Cancelled
            // Status untuk sukarelawan: Registered, Assigned, Completed
            $table->string('status')->default('Registered');
            $table->string('assigned_task')->nullable(); // Khusus untuk type 'volunteer'
            $table->integer('hours_volunteered')->nullable(); // Khusus untuk type 'volunteer'
            $table->text('notes')->nullable(); // Catatan umum
            $table->timestamps();
            $table->unique(['user_id', 'activity_id', 'type']); // Mencegah duplikasi pendaftaran
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};
