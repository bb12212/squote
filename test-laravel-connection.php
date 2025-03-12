<?php

// Bootstrap Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test database connection
try {
    $connection = \Illuminate\Support\Facades\DB::connection();
    $pdo = $connection->getPdo();

    echo 'Successfully connected to database: '.$connection->getDatabaseName()."\n";
    echo "Connection details:\n";
    echo '  Driver: '.$connection->getDriverName()."\n";
    echo '  Host: '.$connection->getConfig('host')."\n";
    echo '  Database: '.$connection->getDatabaseName()."\n";

    // Test query
    $result = \Illuminate\Support\Facades\DB::select('SELECT 1 as test');
    echo 'Test query result: '.print_r($result, true)."\n";

} catch (Exception $e) {
    echo 'Connection failed: '.$e->getMessage()."\n";

    // Show current configuration
    echo "\nCurrent database configuration:\n";
    echo '  DB_CONNECTION: '.env('DB_CONNECTION')."\n";
    echo '  DB_HOST: '.env('DB_HOST')."\n";
    echo '  DB_PORT: '.env('DB_PORT')."\n";
    echo '  DB_DATABASE: '.env('DB_DATABASE')."\n";
    echo '  DB_USERNAME: '.env('DB_USERNAME')."\n";
}
