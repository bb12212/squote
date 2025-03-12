#!/bin/bash

# This script runs after Laravel Cloud copies its .env file
# It updates the database connection settings to use Supabase

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

# Run migrations if needed
cd /var/www/html
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

echo "Deployment hook completed successfully!" 