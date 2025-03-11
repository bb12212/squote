#!/bin/bash

# Create a temporary directory
mkdir -p temp_dir

# Move all files from solar-app to the temp directory
cp -r solar-app/* temp_dir/
cp -r solar-app/.* temp_dir/ 2>/dev/null || true

# Move the files from temp directory to the root
cp -r temp_dir/* .
cp -r temp_dir/.* . 2>/dev/null || true

# Clean up
rm -rf temp_dir

# Update the composer.json file to reflect the new structure
if [ -f "composer.json" ]; then
    # Update the autoload paths if needed
    sed -i '' 's/"App\\\\": "app\//"App\\\\": "app\//g' composer.json
fi

echo "Files moved successfully. Please review the changes and commit them." 