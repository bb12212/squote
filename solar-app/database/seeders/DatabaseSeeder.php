<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders in the correct order to respect foreign key constraints
        $this->call([
            UserSeeder::class,      // First, create users
            RegionSeeder::class,    // Then regions
            ServiceSeeder::class,   // Then services
            PropertySeeder::class,  // Then properties (depends on users and regions)
            LeadSeeder::class,      // Then leads (depends on properties, users, and services)
            QuoteSeeder::class,     // Finally quotes (depends on leads and users)
        ]);
    }
}
