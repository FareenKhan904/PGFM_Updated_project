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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Student who enrolled
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Course enrolled in
            $table->tinyInteger('status')->default(0); // 0 = pending, 1 = accepted, 2 = rejected
            $table->text('notes')->nullable(); // Optional notes from doctor/admin
            $table->timestamps();
            
            // Prevent duplicate enrollments
            $table->unique(['user_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
