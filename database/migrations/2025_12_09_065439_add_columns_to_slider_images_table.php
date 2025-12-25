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
        Schema::table('slider_images', function (Blueprint $table) {
            // Check if columns exist before adding them (they may already exist from the create migration)
            // Note: SQLite doesn't support 'after()' clause, so we omit it
            if (!Schema::hasColumn('slider_images', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('slider_images', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('slider_images', 'image_path')) {
                $table->string('image_path');
            }
            if (!Schema::hasColumn('slider_images', 'button_text')) {
                $table->string('button_text')->nullable();
            }
            if (!Schema::hasColumn('slider_images', 'button_link')) {
                $table->string('button_link')->nullable();
            }
            if (!Schema::hasColumn('slider_images', 'order')) {
                $table->integer('order')->default(0);
            }
            if (!Schema::hasColumn('slider_images', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slider_images', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'image_path', 'button_text', 'button_link', 'order', 'is_active']);
        });
    }
};
