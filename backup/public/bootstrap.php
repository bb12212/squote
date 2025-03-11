<?php

// Check if we're in a Laravel Cloud environment
if (file_exists('/var/www/html/vendor/autoload.php')) {
    // We're in Laravel Cloud
    
    // Set the vendor path to the root
    $vendorPath = '/var/www/html';
    
    // Check if bootstrap directory exists in the root
    if (file_exists('/var/www/html/bootstrap/app.php')) {
        // Bootstrap directory is in the root
        $basePath = '/var/www/html';
    } else if (file_exists('/var/www/html/solar-app/bootstrap/app.php')) {
        // Bootstrap directory is in the solar-app directory
        $basePath = '/var/www/html/solar-app';
    } else {
        // Fallback to the root
        $basePath = '/var/www/html';
    }
    
    // Define a custom vendor path for autoloading
    define('VENDOR_PATH', $vendorPath);
} else {
    // We're in a local environment, use the solar-app directory
    $basePath = realpath(__DIR__ . '/../solar-app');
    
    // In local environment, vendor path is the same as base path
    define('VENDOR_PATH', $basePath);
}

// Define the application paths
define('APP_BASE_PATH', $basePath);
define('APP_PUBLIC_PATH', __DIR__);

// Return the base path
return $basePath; 