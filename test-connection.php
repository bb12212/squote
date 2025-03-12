<?php

// Database connection parameters from Supabase
$host = 'db.qdoccfwsthzarruwswvz.supabase.co';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = '!372d8TtcW47AJ.';

try {
    // Create a new PDO instance
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $password);

    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Test the connection with a simple query
    $stmt = $pdo->query('SELECT 1 as connection_test');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Successfully connected to Supabase PostgreSQL database!\n";
    echo 'Test query result: '.print_r($result, true)."\n";

} catch (PDOException $e) {
    echo 'Connection failed: '.$e->getMessage()."\n";
}
