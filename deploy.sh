#!/bin/bash

# Print each command before executing
set -x

# Exit on error
set -e

echo "Starting deployment process..."

# Function to handle errors
handle_error() {
    echo "Error occurred in deployment at line $1"
    exit 1
}

# Set up error handling
trap 'handle_error $LINENO' ERR

echo "Clearing caches..."
# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "Running database migrations..."
# Run database migrations
php artisan migrate --force

echo "Running database seeders..."
# Run essential seeders
php artisan db:seed --class=RegionSeeder --force
php artisan db:seed --class=ServiceSeeder --force
# Only seed other data if environment is not production
if [ "${APP_ENV}" != "production" ]; then
    php artisan db:seed --class=UserSeeder --force
    php artisan db:seed --class=PropertySeeder --force
    php artisan db:seed --class=LeadSeeder --force
    php artisan db:seed --class=QuoteSeeder --force
fi

echo "Optimizing application..."
# Optimize the application
php artisan optimize

echo "Rebuilding caches..."
# Update cache if using config caching
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if it doesn't exist
php artisan storage:link

echo "Deployment completed successfully!" 