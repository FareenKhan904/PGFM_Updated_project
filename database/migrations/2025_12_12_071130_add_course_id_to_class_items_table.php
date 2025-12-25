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
        // Check if table exists with old name, rename if needed
        if (Schema::hasTable('class_items') && !Schema::hasTable('course_classes')) {
            Schema::rename('class_items', 'course_classes');
        }
        
        $tableName = Schema::hasTable('course_classes') ? 'course_classes' : 'class_items';
        
        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            if (!Schema::hasColumn($tableName, 'course_id')) {
                // SQLite doesn't support 'after()' clause, so we omit it
                $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableName = Schema::hasTable('course_classes') ? 'course_classes' : 'class_items';
        
        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            if (Schema::hasColumn($tableName, 'course_id')) {
                $table->dropForeign(['course_id']);
                $table->dropColumn('course_id');
            }
        });
    }
};
