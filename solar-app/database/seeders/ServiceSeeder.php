<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Solar Panel Installation',
                'description' => 'Installation of solar photovoltaic (PV) panels for residential and commercial properties.',
                'icon' => 'solar-panel',
                'display_order' => 1,
            ],
            [
                'name' => 'Battery Storage',
                'description' => 'Installation of battery storage systems to store excess solar energy for use when needed.',
                'icon' => 'battery',
                'display_order' => 2,
            ],
            [
                'name' => 'EV Charger Installation',
                'description' => 'Installation of electric vehicle charging points powered by solar energy.',
                'icon' => 'ev-charger',
                'display_order' => 3,
            ],
            [
                'name' => 'Solar Hot Water Systems',
                'description' => 'Installation of solar thermal systems for heating water using solar energy.',
                'icon' => 'hot-water',
                'display_order' => 4,
            ],
            [
                'name' => 'Solar Panel Maintenance',
                'description' => 'Regular maintenance and cleaning of solar panel systems to ensure optimal performance.',
                'icon' => 'maintenance',
                'display_order' => 5,
            ],
            [
                'name' => 'Solar Panel Repair',
                'description' => 'Repair services for damaged or malfunctioning solar panel systems.',
                'icon' => 'repair',
                'display_order' => 6,
            ],
            [
                'name' => 'Solar System Upgrade',
                'description' => 'Upgrade existing solar systems with newer, more efficient components.',
                'icon' => 'upgrade',
                'display_order' => 7,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
