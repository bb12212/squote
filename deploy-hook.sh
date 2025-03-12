#!/bin/bash

# This script runs after Laravel Cloud copies its .env file
# It updates the database connection settings to use Supabase

echo "Starting deployment hook script..."

# Wait for the .env file to be created
while [ ! -f /var/www/html/.env ]; do
  echo "Waiting for .env file to be created..."
  sleep 1
done

# Update the database connection settings in the .env file
echo "Updating database connection settings in .env file..."
sed -i 's/DB_CONNECTION=.*/DB_CONNECTION=pgsql/' /var/www/html/.env
sed -i 's/DB_HOST=.*/DB_HOST=db.qdoccfwsthzarruwswvz.supabase.co/' /var/www/html/.env
sed -i 's/DB_PORT=.*/DB_PORT=5432/' /var/www/html/.env
sed -i 's/DB_DATABASE=.*/DB_DATABASE=postgres/' /var/www/html/.env
sed -i 's/DB_USERNAME=.*/DB_USERNAME=postgres/' /var/www/html/.env
sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=!372d8TtcW47AJ./' /var/www/html/.env

# Add Supabase API credentials if they don't exist
if ! grep -q "SUPABASE_URL" /var/www/html/.env; then
  echo "Adding Supabase API credentials to .env file..."
  echo "SUPABASE_URL=https://qdoccfwsthzarruwswvz.supabase.co" >> /var/www/html/.env
  echo "SUPABASE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFkb2NjZndzdGh6YXJydXdzd3Z6Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDEyNDQ3NDIsImV4cCI6MjA1NjgyMDc0Mn0.bt3AUq2GEunCIb4b-RylNutEMhcQpCERifPQ-qEAAVk" >> /var/www/html/.env
  echo "SUPABASE_SECRET=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFkb2NjZndzdGh6YXJydXdzd3Z6Iiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc0MTI0NDc0MiwiZXhwIjoyMDU2ODIwNzQyfQ.DMwpVOtjM-3pIBT-ANwZeMbAivz4kKmoPCGTJF4KZiU" >> /var/www/html/.env
fi

echo "Database connection settings updated successfully!"

# Directly modify the database.php file to hardcode the Supabase connection details
echo "Updating database.php file..."
sed -i "s/'host' => env('DB_HOST', '127.0.0.1'),/'host' => 'db.qdoccfwsthzarruwswvz.supabase.co',/" /var/www/html/config/database.php
sed -i "s/'port' => env('DB_PORT', '5432'),/'port' => '5432',/" /var/www/html/config/database.php
sed -i "s/'database' => env('DB_DATABASE', 'laravel'),/'database' => 'postgres',/" /var/www/html/config/database.php
sed -i "s/'username' => env('DB_USERNAME', 'root'),/'username' => 'postgres',/" /var/www/html/config/database.php
sed -i "s/'password' => env('DB_PASSWORD', ''),/'password' => '!372d8TtcW47AJ.',/" /var/www/html/config/database.php

# Create a direct database connection test file
echo "Creating database connection test file..."
cat > /var/www/html/public/db-test.php << 'EOL'
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
    
    echo "Connection successful!<br>";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT current_timestamp");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Current database time: " . $result['current_timestamp'] . "<br>";
    
    // Check if services table exists
    $stmt = $pdo->query("SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_schema = 'public' 
        AND table_name = 'services'
    )");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Services table exists: " . ($result['exists'] ? 'Yes' : 'No') . "<br>";
    
    // If services table exists, try to query it
    if ($result['exists']) {
        $stmt = $pdo->query("SELECT * FROM services WHERE is_active = true ORDER BY display_order ASC");
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Found " . count($services) . " active services<br>";
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "<br>";
}
EOL

# Change to the application directory
cd /var/www/html

# Run migrations if needed
echo "Running migrations..."
php artisan migrate --force

# Fix the Service model query
echo "Running fix-service-query.php script..."
php /var/www/html/fix-service-query.php

# Check if the database connection works
echo "Testing database connection..."
php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'Database connection successful!'; } catch (\Exception \$e) { echo 'Database connection failed: ' . \$e->getMessage(); }"

# Clear cache
echo "Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Create a symbolic link to ensure storage is accessible
echo "Creating storage link..."
php artisan storage:link

echo "Deployment hook completed successfully!" 