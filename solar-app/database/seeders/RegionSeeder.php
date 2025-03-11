<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create UK regions with postcode patterns
        $regions = [
            [
                'name' => 'London',
                'postcode_pattern' => '^(E|EC|N|NW|SE|SW|W|WC)[0-9]',
                'description' => 'Greater London area',
            ],
            [
                'name' => 'South East',
                'postcode_pattern' => '^(BN|CT|GU|ME|OX|PO|RG|RH|SL|SO|TN)',
                'description' => 'South East England',
            ],
            [
                'name' => 'South West',
                'postcode_pattern' => '^(BA|BH|BS|DT|EX|PL|TA|TQ|TR)',
                'description' => 'South West England',
            ],
            [
                'name' => 'East of England',
                'postcode_pattern' => '^(AL|CB|CM|CO|HP|IP|LU|NR|PE|SG|SS)',
                'description' => 'East of England',
            ],
            [
                'name' => 'East Midlands',
                'postcode_pattern' => '^(DE|DN|LE|LN|NG|NN)',
                'description' => 'East Midlands',
            ],
            [
                'name' => 'West Midlands',
                'postcode_pattern' => '^(B|CV|DY|HR|ST|TF|WR|WS|WV)',
                'description' => 'West Midlands',
            ],
            [
                'name' => 'North West',
                'postcode_pattern' => '^(BB|BL|CA|CH|CW|FY|L|LA|M|OL|PR|SK|WA|WN)',
                'description' => 'North West England',
            ],
            [
                'name' => 'Yorkshire and the Humber',
                'postcode_pattern' => '^(BD|DN|HD|HG|HU|HX|LS|S|WF|YO)',
                'description' => 'Yorkshire and the Humber',
            ],
            [
                'name' => 'North East',
                'postcode_pattern' => '^(DH|DL|NE|SR|TS)',
                'description' => 'North East England',
            ],
            [
                'name' => 'Scotland',
                'postcode_pattern' => '^(AB|DD|DG|EH|FK|G|HS|IV|KA|KW|KY|ML|PA|PH|TD|ZE)',
                'description' => 'Scotland',
            ],
            [
                'name' => 'Wales',
                'postcode_pattern' => '^(CF|CH|LL|NP|SA|SY)',
                'description' => 'Wales',
            ],
            [
                'name' => 'Northern Ireland',
                'postcode_pattern' => '^(BT)',
                'description' => 'Northern Ireland',
            ],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }

        // Assign providers to regions
        $providers = User::where('role', 'provider')->get();
        $allRegions = Region::all();

        foreach ($providers as $provider) {
            // Assign each provider to 3-5 random regions
            $numRegions = rand(3, 5);
            $randomRegions = $allRegions->random($numRegions);
            
            foreach ($randomRegions as $region) {
                // 30% chance of being a preferred provider
                $isPreferred = (rand(1, 10) <= 3);
                
                $provider->regions()->attach($region->id, [
                    'is_preferred' => $isPreferred,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
