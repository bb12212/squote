<?php

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo 'Environment Variables Check:<br>';
echo '----------------------------<br>';

// Check DB connection variables
echo 'DB_CONNECTION: '.(getenv('DB_CONNECTION') ?: 'Not set').'<br>';
echo 'DB_HOST: '.(getenv('DB_HOST') ?: 'Not set').'<br>';
echo 'DB_PORT: '.(getenv('DB_PORT') ?: 'Not set').'<br>';
echo 'DB_DATABASE: '.(getenv('DB_DATABASE') ?: 'Not set').'<br>';
echo 'DB_USERNAME: '.(getenv('DB_USERNAME') ?: 'Not set').'<br>';
echo 'DB_PASSWORD: '.(getenv('DB_PASSWORD') ? 'Set (hidden)' : 'Not set').'<br>';

// Check Supabase variables
echo 'SUPABASE_URL: '.(getenv('SUPABASE_URL') ?: 'Not set').'<br>';
echo 'SUPABASE_KEY: '.(getenv('SUPABASE_KEY') ? 'Set (hidden)' : 'Not set').'<br>';
echo 'SUPABASE_SECRET: '.(getenv('SUPABASE_SECRET') ? 'Set (hidden)' : 'Not set').'<br>';

// Check Laravel environment
echo 'APP_ENV: '.(getenv('APP_ENV') ?: 'Not set').'<br>';
echo 'APP_DEBUG: '.(getenv('APP_DEBUG') ?: 'Not set').'<br>';

// Check if .env file exists
echo '.env file exists: '.(file_exists('.env') ? 'Yes' : 'No').'<br>';

// Check if .env.supabase file exists
echo '.env.supabase file exists: '.(file_exists('.env.supabase') ? 'Yes' : 'No').'<br>';

// Check if laravel-cloud.json file exists
echo 'laravel-cloud.json file exists: '.(file_exists('laravel-cloud.json') ? 'Yes' : 'No').'<br>';

// Try to load environment from .env file using Laravel's dotenv
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';

    if (class_exists('Dotenv\Dotenv')) {
        try {
            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            echo 'Successfully loaded .env file with Dotenv<br>';

            // Check DB connection variables after loading .env
            echo 'After loading .env:<br>';
            echo 'DB_CONNECTION: '.($_ENV['DB_CONNECTION'] ?? 'Not set').'<br>';
            echo 'DB_HOST: '.($_ENV['DB_HOST'] ?? 'Not set').'<br>';
            echo 'DB_PORT: '.($_ENV['DB_PORT'] ?? 'Not set').'<br>';
            echo 'DB_DATABASE: '.($_ENV['DB_DATABASE'] ?? 'Not set').'<br>';
            echo 'DB_USERNAME: '.($_ENV['DB_USERNAME'] ?? 'Not set').'<br>';
            echo 'DB_PASSWORD: '.(isset($_ENV['DB_PASSWORD']) ? 'Set (hidden)' : 'Not set').'<br>';
        } catch (Exception $e) {
            echo 'Error loading .env file: '.$e->getMessage().'<br>';
        }
    } else {
        echo 'Dotenv class not found<br>';
    }
} else {
    echo 'vendor/autoload.php not found<br>';
}

// Check if we can connect to the database using the environment variables
try {
    $dbConnection = getenv('DB_CONNECTION') ?: 'pgsql';
    $dbHost = getenv('DB_HOST') ?: '127.0.0.1';
    $dbPort = getenv('DB_PORT') ?: '5432';
    $dbName = getenv('DB_DATABASE') ?: 'postgres';
    $dbUser = getenv('DB_USERNAME') ?: 'postgres';
    $dbPass = getenv('DB_PASSWORD') ?: '';

    echo '<br>Attempting to connect to database using environment variables:<br>';
    echo "Connection: $dbConnection<br>";
    echo "Host: $dbHost<br>";
    echo "Port: $dbPort<br>";
    echo "Database: $dbName<br>";
    echo "Username: $dbUser<br>";

    if ($dbConnection === 'pgsql') {
        $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName;sslmode=require";
        $pdo = new PDO($dsn, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connection successful!<br>';
    } else {
        echo "Unsupported database connection: $dbConnection<br>";
    }
} catch (PDOException $e) {
    echo 'Connection failed: '.$e->getMessage().'<br>';
}
