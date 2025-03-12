<?php

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$host = 'db.qdoccfwsthzarruwswvz.supabase.co';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = '!372d8TtcW47AJ.';

echo "Attempting to connect to PostgreSQL database at $host:$port...<br>";

try {
    // Create a PDO connection
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $password);

    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo 'Connection successful!<br>';

    // Test a simple query
    $stmt = $pdo->query('SELECT current_timestamp');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo 'Current database time: '.$result['current_timestamp'].'<br>';

    // Check if services table exists
    $stmt = $pdo->query("SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_schema = 'public' 
        AND table_name = 'services'
    )");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo 'Services table exists: '.($result['exists'] ? 'Yes' : 'No').'<br>';

    // If services table exists, try to query it
    if ($result['exists']) {
        $stmt = $pdo->query('SELECT * FROM services WHERE is_active = true ORDER BY display_order ASC');
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo 'Found '.count($services).' active services<br>';
    }

} catch (PDOException $e) {
    echo 'Connection failed: '.$e->getMessage().'<br>';
}
