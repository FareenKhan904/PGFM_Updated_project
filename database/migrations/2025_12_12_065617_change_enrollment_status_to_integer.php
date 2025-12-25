<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // This migration is not needed since we already created the table with integer status
        // But we'll keep it for consistency in case we need to modify existing data
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse since we're using integer from the start
    }
};
