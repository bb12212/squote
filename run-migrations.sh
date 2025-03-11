#!/bin/bash

# This script runs the database migrations for the Laravel application

echo "Running database migrations..."
php artisan migrate --force

echo "Seeding the database..."
php artisan db:seed --force

echo "Database setup complete." 