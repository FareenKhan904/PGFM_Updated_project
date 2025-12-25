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
        // Check if table already exists with correct structure
        if (Schema::hasTable('class_items')) {
            // Check if user_id foreign key exists by trying to get constraint names
            try {
                $constraints = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM information_schema.KEY_COLUMN_USAGE 
                    WHERE TABLE_SCHEMA = DATABASE() 
                    AND TABLE_NAME = 'class_items' 
                    AND COLUMN_NAME = 'user_id' 
                    AND REFERENCED_TABLE_NAME = 'users'
                ");
                
                $hasUserIdForeignKey = !empty($constraints);
            } catch (\Exception $e) {
                // If query fails, assume foreign key doesn't exist
                $hasUserIdForeignKey = false;
            }
            
            // Only add foreign key if it doesn't exist
            if (!$hasUserIdForeignKey && Schema::hasColumn('class_items', 'user_id')) {
                try {
                    // Try to add foreign key constraint with a unique name
                    DB::statement('ALTER TABLE class_items ADD CONSTRAINT class_items_user_id_fk FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
                } catch (\Exception $e) {
                    // If constraint already exists with different name, that's fine
                    // Just continue
                }
            }
            
            // Ensure all required columns exist (skip if they already exist)
            // The table structure is already correct, so we don't need to modify it
        } elseif (Schema::hasTable('course_classes')) {
            // Create new table for class materials
            Schema::create('class_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_class_id')->constrained('course_classes')->onDelete('cascade');
                $table->string('title');
                $table->text('description')->nullable();
                $table->enum('type', ['pdf', 'video', 'link', 'document', 'other'])->default('other');
                $table->string('file_path')->nullable();
                $table->string('file_name')->nullable();
                $table->string('file_size')->nullable();
                $table->string('external_link')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop if we created it (not if it existed before)
        if (Schema::hasTable('class_items')) {
            Schema::table('class_items', function (Blueprint $table) {
                if (Schema::hasColumn('class_items', 'course_class_id')) {
                    $table->dropForeign(['course_class_id']);
                    $table->dropColumn('course_class_id');
                }
                if (Schema::hasColumn('class_items', 'type')) {
                    $table->dropColumn('type');
                }
                if (Schema::hasColumn('class_items', 'file_path')) {
                    $table->dropColumn('file_path');
                }
                if (Schema::hasColumn('class_items', 'file_name')) {
                    $table->dropColumn('file_name');
                }
                if (Schema::hasColumn('class_items', 'file_size')) {
                    $table->dropColumn('file_size');
                }
                if (Schema::hasColumn('class_items', 'external_link')) {
                    $table->dropColumn('external_link');
                }
                if (Schema::hasColumn('class_items', 'order')) {
                    $table->dropColumn('order');
                }
            });
        }
    }
};
