<?php
/**
 * Safe migration script that continues even if database is not available
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    \DB::connection()->getPdo();
    // Database is available, run migrations
    $exitCode = 0;
    passthru('php artisan migrate --force', $exitCode);
    exit($exitCode);
} catch (\Exception $e) {
    echo "\n⚠️  Database connection failed: " . $e->getMessage() . "\n";
    echo "⚠️  Skipping migrations. Please configure your database and run 'php artisan migrate' manually.\n\n";
    exit(0); // Exit with success so setup script continues
}

