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
        Schema::create('library_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Doctor who uploaded
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['book', 'article', 'document', 'video', 'other'])->default('other');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->year('year')->nullable();
            $table->string('file_path')->nullable(); // Path to uploaded file
            $table->string('file_name')->nullable(); // Original file name
            $table->string('file_size')->nullable(); // File size in bytes
            $table->string('external_link')->nullable(); // For external resources
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_items');
    }
};
