<?php
/**
 * MySQL Database Setup Helper
 * 
 * This script helps you configure your .env file for MySQL.
 * Run this script: php setup_mysql.php
 */

$envFile = __DIR__ . '/.env';

if (!file_exists($envFile)) {
    echo "Error: .env file not found!\n";
    echo "Please create a .env file first by copying .env.example\n";
    exit(1);
}

echo "MySQL Database Configuration Setup\n";
echo "===================================\n\n";

// Read current .env file
$envContent = file_get_contents($envFile);

// Get MySQL credentials from user
echo "Please enter your MySQL database credentials:\n\n";

echo "Database Host [127.0.0.1]: ";
$host = trim(fgets(STDIN)) ?: '127.0.0.1';

echo "Database Port [3306]: ";
$port = trim(fgets(STDIN)) ?: '3306';

echo "Database Name: ";
$database = trim(fgets(STDIN));
if (empty($database)) {
    echo "Error: Database name is required!\n";
    exit(1);
}

echo "Database Username [root]: ";
$username = trim(fgets(STDIN)) ?: 'root';

echo "Database Password: ";
$password = trim(fgets(STDIN));

// Update .env file
$replacements = [
    '/^DB_CONNECTION=.*/m' => 'DB_CONNECTION=mysql',
    '/^DB_HOST=.*/m' => "DB_HOST={$host}",
    '/^DB_PORT=.*/m' => "DB_PORT={$port}",
    '/^DB_DATABASE=.*/m' => "DB_DATABASE={$database}",
    '/^DB_USERNAME=.*/m' => "DB_USERNAME={$username}",
    '/^DB_PASSWORD=.*/m' => "DB_PASSWORD={$password}",
];

foreach ($replacements as $pattern => $replacement) {
    if (preg_match($pattern, $envContent)) {
        $envContent = preg_replace($pattern, $replacement, $envContent);
    } else {
        // Add the line if it doesn't exist
        $envContent .= "\n" . $replacement;
    }
}

// Write updated .env file
file_put_contents($envFile, $envContent);

echo "\n✓ .env file has been updated!\n";
echo "\nNext steps:\n";
echo "1. Create the MySQL database: CREATE DATABASE {$database};\n";
echo "2. Run migrations: php artisan migrate\n";
echo "3. (Optional) Seed the database: php artisan db:seed\n";

