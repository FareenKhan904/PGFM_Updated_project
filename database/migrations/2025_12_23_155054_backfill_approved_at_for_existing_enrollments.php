<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Enrollment;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Backfill approved_at for existing accepted enrollments
        // Set approved_at to updated_at for enrollments that are already accepted
        DB::table('enrollments')
            ->where('status', Enrollment::STATUS_ACCEPTED)
            ->whereNull('approved_at')
            ->update([
                'approved_at' => DB::raw('updated_at')
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally clear approved_at for accepted enrollments
        // This is optional - you may want to keep the data
        // DB::table('enrollments')
        //     ->where('status', Enrollment::STATUS_ACCEPTED)
        //     ->update(['approved_at' => null]);
    }
};
