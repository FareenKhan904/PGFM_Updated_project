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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
            $table->text('program_overview')->nullable()->after('description');
            $table->string('awarding_body')->nullable();
            $table->text('goal')->nullable();
            $table->text('examination_components')->nullable(); // JSON or text
            $table->text('eligibility_criteria')->nullable(); // JSON array
            $table->text('mandatory_workshops')->nullable(); // JSON array
            $table->text('course_modules')->nullable(); // JSON array
            $table->text('examination_structure')->nullable();
            $table->text('qualification_purpose')->nullable();
            $table->text('examination_details')->nullable();
            $table->text('skills_assessed')->nullable(); // JSON array
            $table->text('eligibility_attempts')->nullable();
            $table->text('whats_included')->nullable(); // JSON array
            $table->decimal('early_bird_fee', 10, 2)->nullable();
            $table->string('icon_class')->nullable()->default('fa-graduation-cap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle',
                'program_overview',
                'awarding_body',
                'goal',
                'examination_components',
                'eligibility_criteria',
                'mandatory_workshops',
                'course_modules',
                'examination_structure',
                'qualification_purpose',
                'examination_details',
                'skills_assessed',
                'eligibility_attempts',
                'whats_included',
                'early_bird_fee',
                'icon_class',
            ]);
        });
    }
};
