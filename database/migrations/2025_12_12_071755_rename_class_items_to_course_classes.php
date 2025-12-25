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
        // Rename the table only if it exists and hasn't been renamed already
        if (Schema::hasTable('class_items') && !Schema::hasTable('course_classes')) {
            Schema::rename('class_items', 'course_classes');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rename back to class_items only if course_classes exists
        if (Schema::hasTable('course_classes') && !Schema::hasTable('class_items')) {
            Schema::rename('course_classes', 'class_items');
        }
    }
};
