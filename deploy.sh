#!/bin/bash

# Print each command before executing
set -x

# Exit on error
set -e

echo "Starting deployment process..."

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run database migrations
php artisan migrate --force

# Optimize the application
php artisan optimize

# Update cache if using config caching
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Deployment completed successfully!" 