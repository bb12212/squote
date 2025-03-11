<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all consumer users
        $consumers = User::where('role', 'consumer')->get();
        $regions = Region::all();
        
        // UK postcodes for different regions
        $postcodes = [
            'London' => ['E1 6AN', 'SW1A 1AA', 'N1 9GU', 'W1A 1AB', 'SE1 9SG'],
            'South East' => ['RG1 3EJ', 'OX1 1PT', 'BN1 1UB', 'GU1 4HL', 'ME1 1PD'],
            'South West' => ['BS1 1UB', 'EX1 1TS', 'PL1 2PB', 'BA1 1RG', 'TR1 1XU'],
            'East of England' => ['CB1 1PT', 'IP1 1PL', 'NR1 3RL', 'CM1 1QH', 'CO1 1JN'],
            'East Midlands' => ['NG1 5FT', 'LE1 6RU', 'DE1 2QY', 'LN1 1YL', 'NN1 1ED'],
            'West Midlands' => ['B1 1HQ', 'CV1 5FB', 'WV1 1SV', 'ST1 1DB', 'DY1 1PY'],
            'North West' => ['M1 1AE', 'L1 8JQ', 'PR1 2UR', 'CH1 1EA', 'WA1 1QT'],
            'Yorkshire and the Humber' => ['S1 2BJ', 'LS1 1UR', 'HU1 2PQ', 'YO1 9QR', 'HD1 2JF'],
            'North East' => ['NE1 7RU', 'DH1 5TL', 'SR1 1RE', 'TS1 1PA', 'DL1 1DL'],
            'Scotland' => ['G1 1XW', 'EH1 1TG', 'AB10 1FG', 'DD1 1DB', 'PA1 2AF'],
            'Wales' => ['CF10 1EP', 'SA1 1DP', 'LL11 1LP', 'SY23 1AS', 'NP10 8QQ'],
            'Northern Ireland' => ['BT1 1LT', 'BT2 7LS', 'BT7 1JB', 'BT48 6DQ', 'BT51 3RP'],
        ];
        
        $propertyTypes = array_keys(Property::propertyTypes());
        $roofTypes = array_keys(Property::roofTypes());
        $roofMaterials = array_keys(Property::roofMaterials());
        
        foreach ($consumers as $consumer) {
            // Randomly select a region
            $region = $regions->random();
            
            // Get a random postcode for the region
            $regionPostcodes = $postcodes[$region->name];
            $postcode = $regionPostcodes[array_rand($regionPostcodes)];
            
            // Create 1-2 properties for each consumer
            $numProperties = rand(1, 2);
            
            for ($i = 0; $i < $numProperties; $i++) {
                Property::create([
                    'user_id' => $consumer->id,
                    'region_id' => $region->id,
                    'postcode' => $postcode,
                    'property_type' => $propertyTypes[array_rand($propertyTypes)],
                    'roof_type' => $roofTypes[array_rand($roofTypes)],
                    'roof_material' => $roofMaterials[array_rand($roofMaterials)],
                    'has_significant_shading' => (bool) rand(0, 1),
                    'monthly_energy_bill' => rand(50, 300),
                    'annual_energy_usage' => rand(2000, 8000),
                    'additional_details' => rand(0, 1) ? 'Looking for the most efficient system available.' : null,
                ]);
            }
        }
    }
}
