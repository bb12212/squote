<?php

// This script fixes the query in the ConsumerController to use boolean values correctly
// It should be run after deployment

// Load Laravel's autoloader
require __DIR__.'/vendor/autoload.php';

// Load environment variables
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Import the DB facade
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Check if the services table exists
if (Schema::hasTable('services')) {
    echo "Services table exists, checking for is_active column...\n";

    // Check if the is_active column exists and its type
    $columns = Schema::getColumnListing('services');
    if (in_array('is_active', $columns)) {
        echo "is_active column exists, checking its type...\n";

        // Get the column type
        $columnType = DB::connection()->getDoctrineColumn('services', 'is_active')->getType()->getName();
        echo "is_active column type: $columnType\n";

        // If the column is not boolean, convert it
        if ($columnType !== 'boolean') {
            echo "Converting is_active column to boolean...\n";

            // Create a temporary column
            Schema::table('services', function ($table) {
                $table->boolean('is_active_temp')->default(false);
            });

            // Copy data from is_active to is_active_temp, converting values
            $services = DB::table('services')->get();
            foreach ($services as $service) {
                $isActive = $service->is_active == 1 ? true : false;
                DB::table('services')
                    ->where('id', $service->id)
                    ->update(['is_active_temp' => $isActive]);
            }

            // Drop the original column
            Schema::table('services', function ($table) {
                $table->dropColumn('is_active');
            });

            // Rename the temporary column to is_active
            Schema::table('services', function ($table) {
                $table->renameColumn('is_active_temp', 'is_active');
            });

            echo "is_active column converted to boolean successfully!\n";
        } else {
            echo "is_active column is already boolean, no conversion needed.\n";
        }
    } else {
        echo "is_active column does not exist in the services table.\n";
    }
} else {
    echo "Services table does not exist.\n";
}

// Test the query
try {
    $services = DB::table('services')->where('is_active', true)->orderBy('display_order')->get();
    echo 'Query successful! Found '.count($services)." active services.\n";
} catch (\Exception $e) {
    echo 'Query failed: '.$e->getMessage()."\n";
}
