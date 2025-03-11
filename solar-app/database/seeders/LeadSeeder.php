<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Property;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all properties, services, and providers
        $properties = Property::all();
        $services = Service::all();
        $providers = User::where('role', 'provider')->get();
        
        // Create leads for 70% of properties
        $leadProperties = $properties->random(ceil($properties->count() * 0.7));
        
        foreach ($leadProperties as $property) {
            $user = $property->user;
            
            // Create a lead
            $lead = Lead::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'first_name' => $user->name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'preferred_contact_method' => $user->preferred_contact_method,
                'additional_details' => rand(0, 1) ? 'I would like to get quotes as soon as possible.' : null,
                'status' => $this->getRandomStatus(),
            ]);
            
            // Attach 1-3 random services to the lead
            $numServices = rand(1, 3);
            $randomServices = $services->random($numServices);
            
            foreach ($randomServices as $service) {
                $lead->services()->attach($service->id);
            }
            
            // For leads that are not 'new', assign 1-3 providers
            if ($lead->status !== 'new') {
                $numProviders = rand(1, 3);
                $randomProviders = $providers->random($numProviders);
                
                foreach ($randomProviders as $provider) {
                    $lead->providers()->attach($provider->id, [
                        'status' => $this->getRandomProviderStatus(),
                        'assigned_at' => now()->subDays(rand(1, 30)),
                        'contacted_at' => rand(0, 1) ? now()->subDays(rand(1, 15)) : null,
                    ]);
                }
            }
        }
    }
    
    /**
     * Get a random lead status.
     */
    private function getRandomStatus(): string
    {
        $statuses = ['new', 'assigned', 'contacted', 'converted', 'closed'];
        $weights = [20, 30, 25, 15, 10]; // Weighted probabilities
        
        return $this->getRandomWeightedElement($statuses, $weights);
    }
    
    /**
     * Get a random provider status.
     */
    private function getRandomProviderStatus(): string
    {
        $statuses = ['assigned', 'contacted', 'quoted', 'won', 'lost'];
        $weights = [30, 25, 20, 15, 10]; // Weighted probabilities
        
        return $this->getRandomWeightedElement($statuses, $weights);
    }
    
    /**
     * Get a random element from an array with weighted probabilities.
     */
    private function getRandomWeightedElement(array $elements, array $weights): string
    {
        $totalWeight = array_sum($weights);
        $randomWeight = rand(1, $totalWeight);
        
        $currentWeight = 0;
        foreach ($elements as $index => $element) {
            $currentWeight += $weights[$index];
            
            if ($randomWeight <= $currentWeight) {
                return $element;
            }
        }
        
        return $elements[0]; // Fallback
    }
}
