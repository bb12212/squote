<?php

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load Laravel's autoloader
require __DIR__.'/vendor/autoload.php';

// Load environment variables
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Import the DB facade
use Illuminate\Support\Facades\DB;

echo 'Laravel Database Configuration:<br>';
echo '-------------------------------<br>';

// Get database configuration
$connection = config('database.default');
$host = config('database.connections.'.$connection.'.host');
$port = config('database.connections.'.$connection.'.port');
$database = config('database.connections.'.$connection.'.database');
$username = config('database.connections.'.$connection.'.username');
$password = config('database.connections.'.$connection.'.password') ? 'Set (hidden)' : 'Not set';

echo "Default Connection: $connection<br>";
echo "Host: $host<br>";
echo "Port: $port<br>";
echo "Database: $database<br>";
echo "Username: $username<br>";
echo "Password: $password<br>";

// Try to connect to the database using Laravel's DB facade
try {
    $result = DB::select('SELECT current_timestamp');
    echo 'Connection successful!<br>';
    echo 'Current database time: '.$result[0]->current_timestamp.'<br>';

    // Check if services table exists
    $tableExists = DB::select("SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_schema = 'public' 
        AND table_name = 'services'
    ) as exists")[0]->exists;

    echo 'Services table exists: '.($tableExists ? 'Yes' : 'No').'<br>';

    // If services table exists, try to query it
    if ($tableExists) {
        $services = DB::select('SELECT * FROM services WHERE is_active = true ORDER BY display_order ASC');
        echo 'Found '.count($services).' active services<br>';
    }
} catch (Exception $e) {
    echo 'Connection failed: '.$e->getMessage().'<br>';
}
