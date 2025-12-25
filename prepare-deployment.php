<?php
/**
 * Deployment Preparation Script
 * 
 * This script helps prepare your Laravel application for deployment
 * by creating a clean deployment package.
 * 
 * Usage: php prepare-deployment.php
 */

$baseDir = __DIR__;
$deploymentDir = $baseDir . '/deployment-package';

echo "Laravel Deployment Preparation Script\n";
echo "=====================================\n\n";

// Create deployment directory
if (!is_dir($deploymentDir)) {
    mkdir($deploymentDir, 0755, true);
    echo "✓ Created deployment directory\n";
} else {
    echo "⚠ Deployment directory already exists. Cleaning...\n";
    deleteDirectory($deploymentDir);
    mkdir($deploymentDir, 0755, true);
}

// Directories to copy
$directoriesToCopy = [
    'app',
    'bootstrap',
    'config',
    'database',
    'public',
    'resources',
    'routes',
    'storage',
    'vendor',
];

// Files to copy
$filesToCopy = [
    'artisan',
    'composer.json',
    'composer.lock',
];

// Copy directories
echo "\nCopying directories...\n";
foreach ($directoriesToCopy as $dir) {
    $source = $baseDir . '/' . $dir;
    $dest = $deploymentDir . '/' . $dir;
    
    if (is_dir($source)) {
        copyDirectory($source, $dest, $dir);
        echo "✓ Copied {$dir}/\n";
    } else {
        echo "⚠ Directory {$dir}/ not found, skipping...\n";
    }
}

// Copy files
echo "\nCopying files...\n";
foreach ($filesToCopy as $file) {
    $source = $baseDir . '/' . $file;
    $dest = $deploymentDir . '/' . $file;
    
    if (file_exists($source)) {
        copy($source, $dest);
        echo "✓ Copied {$file}\n";
    } else {
        echo "⚠ File {$file} not found, skipping...\n";
    }
}

// Clean storage directory
echo "\nCleaning storage directory...\n";
$storageDirs = [
    'storage/logs',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/views',
];

foreach ($storageDirs as $dir) {
    $fullPath = $deploymentDir . '/' . $dir;
    if (is_dir($fullPath)) {
        // Delete contents but keep directory
        deleteDirectoryContents($fullPath);
        echo "✓ Cleaned {$dir}/\n";
    }
}

// Create .gitkeep files
foreach ($storageDirs as $dir) {
    $fullPath = $deploymentDir . '/' . $dir;
    if (is_dir($fullPath)) {
        file_put_contents($fullPath . '/.gitkeep', '');
    }
}

// Create .env.example from .env (remove sensitive data)
echo "\nCreating .env.example...\n";
if (file_exists($baseDir . '/.env')) {
    $envContent = file_get_contents($baseDir . '/.env');
    // Remove sensitive values but keep structure
    $envContent = preg_replace('/^(APP_KEY=).*$/m', '$1', $envContent);
    $envContent = preg_replace('/^(DB_PASSWORD=).*$/m', '$1', $envContent);
    $envContent = preg_replace('/^(MAIL_PASSWORD=).*$/m', '$1', $envContent);
    file_put_contents($deploymentDir . '/.env.example', $envContent);
    echo "✓ Created .env.example\n";
}

echo "\n=====================================\n";
echo "Deployment package ready!\n";
echo "Location: {$deploymentDir}\n";
echo "\nNext steps:\n";
echo "1. Review the deployment package\n";
echo "2. Create .env file on server with production values\n";
echo "3. Upload files to Namecheap hosting\n";
echo "4. Follow the deployment guide\n";
echo "\n";

// Helper functions
function copyDirectory($source, $dest, $baseDir = '') {
    if (!is_dir($dest)) {
        mkdir($dest, 0755, true);
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $destPath = $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        
        // Skip certain files/directories
        if (shouldSkip($item->getPathname(), $baseDir)) {
            continue;
        }
        
        if ($item->isDir()) {
            if (!is_dir($destPath)) {
                mkdir($destPath, 0755, true);
            }
        } else {
            copy($item->getPathname(), $destPath);
        }
    }
}

function shouldSkip($path, $baseDir) {
    $skipPatterns = [
        '/\.git/',
        '/node_modules/',
        '/\.env$/',
        '/\.log$/',
        '/storage\/logs\/.*\.log$/',
        '/storage\/framework\/cache\/data\//',
        '/storage\/framework\/sessions\//',
        '/storage\/framework\/views\//',
    ];
    
    foreach ($skipPatterns as $pattern) {
        if (preg_match($pattern, $path)) {
            return true;
        }
    }
    
    return false;
}

function deleteDirectory($dir) {
    if (!is_dir($dir)) {
        return;
    }
    
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDirectory($path) : unlink($path);
    }
    rmdir($dir);
}

function deleteDirectoryContents($dir) {
    if (!is_dir($dir)) {
        return;
    }
    
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDirectory($path) : unlink($path);
    }
}

