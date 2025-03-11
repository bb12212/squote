<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all leads that have providers with 'quoted', 'won', or 'lost' status
        $leads = Lead::whereHas('providers', function ($query) {
            $query->whereIn('status', ['quoted', 'won', 'lost']);
        })->get();
        
        foreach ($leads as $lead) {
            // Get providers who have quoted for this lead
            $providers = $lead->providers()->whereIn('status', ['quoted', 'won', 'lost'])->get();
            
            foreach ($providers as $provider) {
                // Determine quote status based on provider status
                $status = 'pending';
                if ($provider->pivot->status === 'won') {
                    $status = 'accepted';
                } elseif ($provider->pivot->status === 'lost') {
                    $status = rand(0, 1) ? 'rejected' : 'expired';
                }
                
                // Create a quote
                $systemSizeKw = rand(3, 15);
                $totalAmount = $systemSizeKw * 1000 + rand(500, 2000);
                $estimatedAnnualProduction = $systemSizeKw * rand(800, 1200);
                $estimatedSavings = $estimatedAnnualProduction * 0.15; // Assuming £0.15 per kWh savings
                
                Quote::create([
                    'lead_id' => $lead->id,
                    'user_id' => $provider->id,
                    'total_amount' => $totalAmount,
                    'description' => "Quote for {$systemSizeKw}kW solar panel system with installation and warranty.",
                    'system_details' => "High-efficiency solar panels with inverter and mounting system.",
                    'system_size_kw' => $systemSizeKw,
                    'estimated_annual_production_kwh' => $estimatedAnnualProduction,
                    'estimated_savings_per_year' => $estimatedSavings,
                    'warranty_years' => rand(10, 25),
                    'valid_until' => now()->addMonths(rand(1, 3)),
                    'status' => $status,
                ]);
            }
        }
    }
}
