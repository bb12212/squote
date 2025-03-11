#!/bin/bash

# This script restructures the project to match Laravel Cloud's expected structure
# by moving files from the solar-app directory to the root directory.

echo "Starting project restructuring for Laravel Cloud deployment..."

# Create backup of current structure
echo "Creating backup..."
mkdir -p backup
cp -r public backup/
cp -r solar-app backup/
cp laravel-cloud.json backup/
cp Procfile backup/
cp nginx.conf backup/
cp composer.json backup/
cp composer.lock backup/

# Move essential Laravel directories from solar-app to root
echo "Moving Laravel directories to root..."
for dir in app bootstrap config database resources routes storage tests vendor; do
  if [ -d "solar-app/$dir" ]; then
    echo "Moving $dir directory..."
    rm -rf "$dir" 2>/dev/null || true
    cp -r "solar-app/$dir" .
  fi
done

# Move Laravel files from solar-app to root
echo "Moving Laravel files to root..."
for file in artisan phpunit.xml; do
  if [ -f "solar-app/$file" ]; then
    echo "Moving $file file..."
    cp "solar-app/$file" .
  fi
done

# Move hidden files
echo "Moving hidden files..."
for file in .env .env.example .gitattributes; do
  if [ -f "solar-app/$file" ]; then
    echo "Moving $file file..."
    cp "solar-app/$file" .
  fi
done

# Update public directory
echo "Updating public directory..."
rm -rf public 2>/dev/null || true
cp -r solar-app/public .

# Update composer.json if needed
if [ -f "composer.json" ]; then
  echo "Updating composer.json..."
  # No need to update autoload paths as they should already be correct
fi

# Create a new .env file if it doesn't exist
if [ ! -f ".env" ]; then
  echo "Creating .env file..."
  cp solar-app/.env . 2>/dev/null || true
  cp solar-app/.env.example . 2>/dev/null || true
fi

echo "Project restructuring complete. Please review the changes and commit them."
echo "You may need to run 'composer dump-autoload' after committing the changes." 