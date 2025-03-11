<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'preferred_contact_method' => 'email',
        ]);

        // Create provider users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Provider $i",
                'last_name' => 'Company',
                'email' => "provider$i@example.com",
                'phone' => "123456789$i",
                'password' => Hash::make('password'),
                'role' => 'provider',
                'preferred_contact_method' => 'email',
                'company_name' => "Solar Provider $i Ltd",
                'company_description' => "We are a leading solar provider with over $i years of experience.",
                'services_offered' => json_encode(['solar_panels', 'battery_storage', 'ev_chargers']),
                'certifications' => json_encode(['MCS', 'RECC', 'NAPIT']),
                'is_approved' => true,
                'subscription_status' => 'active',
                'subscription_ends_at' => now()->addYear(),
            ]);
        }

        // Create consumer users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Consumer $i",
                'last_name' => 'User',
                'email' => "consumer$i@example.com",
                'phone' => "987654321$i",
                'password' => Hash::make('password'),
                'role' => 'consumer',
                'preferred_contact_method' => $i % 2 == 0 ? 'email' : 'phone',
            ]);
        }
    }
}
