<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConsumerController extends Controller
{
    /**
     * Show the landing page.
     */
    public function index()
    {
        // Use the scope defined in the Service model, which uses boolean true
        $services = Service::active()->ordered()->get();

        // If the above query fails, try a direct query with boolean true
        if ($services->isEmpty()) {
            try {
                $services = DB::table('services')
                    ->where('is_active', true)
                    ->orderBy('display_order')
                    ->get();
            } catch (\Exception $e) {
                // Log the error
                Log::error('Error querying services: '.$e->getMessage());

                // Try with integer 1 as a fallback
                try {
                    $services = DB::table('services')
                        ->whereRaw('is_active = 1')
                        ->orderBy('display_order')
                        ->get();
                } catch (\Exception $e2) {
                    // Log the error
                    Log::error('Error querying services with fallback: '.$e2->getMessage());

                    // Return an empty collection as a last resort
                    $services = collect();
                }
            }
        }

        return view('consumer.index', compact('services'));
    }

    /**
     * Validate the postcode and redirect to the service selection step.
     */
    public function validatePostcode(Request $request)
    {
        $request->validate([
            'postcode' => 'required|string|max:10',
        ]);

        // Store postcode in session
        session(['quote.postcode' => $request->postcode]);

        // Find the region based on the postcode
        $postcode = strtoupper(str_replace(' ', '', $request->postcode));
        $region = Region::active()->get()->first(function ($region) use ($postcode) {
            return $region->matchesPostcode($postcode);
        });

        if ($region) {
            session(['quote.region_id' => $region->id]);
        }

        return redirect()->route('consumer.service-selection');
    }

    /**
     * Show the service selection step.
     */
    public function serviceSelection()
    {
        // Check if postcode is in session
        if (! session('quote.postcode')) {
            return redirect()->route('consumer.index')->with('error', 'Please enter your postcode first.');
        }

        $services = Service::active()->ordered()->get();

        return view('consumer.service-selection', compact('services'));
    }

    /**
     * Store the selected services and redirect to the property details step.
     */
    public function storeServices(Request $request)
    {
        $request->validate([
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
        ]);

        // Store selected services in session
        session(['quote.services' => $request->services]);

        return redirect()->route('consumer.property-details');
    }

    /**
     * Show the property details step.
     */
    public function propertyDetails()
    {
        // Check if services are in session
        if (! session('quote.services')) {
            return redirect()->route('consumer.service-selection')->with('error', 'Please select at least one service.');
        }

        return view('consumer.property-details');
    }

    /**
     * Store the property details and redirect to the contact information step.
     */
    public function storePropertyDetails(Request $request)
    {
        $request->validate([
            'property_type' => 'required|string|in:'.implode(',', array_keys(\App\Models\Property::propertyTypes())),
            'roof_type' => 'nullable|string|in:'.implode(',', array_keys(\App\Models\Property::roofTypes())),
            'roof_material' => 'nullable|string|in:'.implode(',', array_keys(\App\Models\Property::roofMaterials())),
            'has_significant_shading' => 'nullable|boolean',
            'monthly_energy_bill' => 'nullable|numeric|min:0',
            'annual_energy_usage' => 'nullable|integer|min:0',
        ]);

        // Store property details in session
        session(['quote.property_details' => $request->all()]);

        return redirect()->route('consumer.contact-information');
    }

    /**
     * Show the contact information step.
     */
    public function contactInformation()
    {
        // Check if property details are in session
        if (! session('quote.property_details')) {
            return redirect()->route('consumer.property-details')->with('error', 'Please provide your property details.');
        }

        return view('consumer.contact-information');
    }

    /**
     * Store the contact information and redirect to the additional details step.
     */
    public function storeContactInformation(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'preferred_contact_method' => 'required|string|in:email,phone,either',
        ]);

        // Store contact information in session
        session(['quote.contact_information' => $request->all()]);

        return redirect()->route('consumer.additional-details');
    }

    /**
     * Show the additional details step.
     */
    public function additionalDetails()
    {
        // Check if contact information is in session
        if (! session('quote.contact_information')) {
            return redirect()->route('consumer.contact-information')->with('error', 'Please provide your contact information.');
        }

        return view('consumer.additional-details');
    }

    /**
     * Store the additional details and redirect to the confirmation page.
     */
    public function storeAdditionalDetails(Request $request)
    {
        $request->validate([
            'additional_details' => 'nullable|string|max:1000',
        ]);

        // Store additional details in session
        session(['quote.additional_details' => $request->additional_details]);

        // Process the lead
        $this->processLead();

        return redirect()->route('consumer.confirmation');
    }

    /**
     * Show the confirmation page.
     */
    public function confirmation()
    {
        // Check if lead has been processed
        if (! session('quote.lead_processed')) {
            return redirect()->route('consumer.index')->with('error', 'Please complete the quote request form.');
        }

        return view('consumer.confirmation');
    }

    /**
     * Process the lead and store it in the database.
     */
    private function processLead()
    {
        // Get all data from session
        $quoteData = session('quote');

        // Create or find the user
        $user = \App\Models\User::firstOrCreate(
            ['email' => $quoteData['contact_information']['email']],
            [
                'name' => $quoteData['contact_information']['first_name'],
                'last_name' => $quoteData['contact_information']['last_name'],
                'phone' => $quoteData['contact_information']['phone'] ?? null,
                'password' => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(16)),
                'role' => 'consumer',
                'preferred_contact_method' => $quoteData['contact_information']['preferred_contact_method'],
            ]
        );

        // Create the property
        $property = \App\Models\Property::create([
            'user_id' => $user->id,
            'region_id' => $quoteData['region_id'] ?? null,
            'postcode' => $quoteData['postcode'],
            'property_type' => $quoteData['property_details']['property_type'],
            'roof_type' => $quoteData['property_details']['roof_type'] ?? null,
            'roof_material' => $quoteData['property_details']['roof_material'] ?? null,
            'has_significant_shading' => $quoteData['property_details']['has_significant_shading'] ?? false,
            'monthly_energy_bill' => $quoteData['property_details']['monthly_energy_bill'] ?? null,
            'annual_energy_usage' => $quoteData['property_details']['annual_energy_usage'] ?? null,
            'additional_details' => $quoteData['additional_details'] ?? null,
        ]);

        // Create the lead
        $lead = \App\Models\Lead::create([
            'user_id' => $user->id,
            'property_id' => $property->id,
            'first_name' => $quoteData['contact_information']['first_name'],
            'last_name' => $quoteData['contact_information']['last_name'],
            'email' => $quoteData['contact_information']['email'],
            'phone' => $quoteData['contact_information']['phone'] ?? null,
            'preferred_contact_method' => $quoteData['contact_information']['preferred_contact_method'],
            'additional_details' => $quoteData['additional_details'] ?? null,
            'status' => 'new',
        ]);

        // Attach services to the lead
        $lead->services()->attach($quoteData['services']);

        // Mark lead as processed in session
        session(['quote.lead_processed' => true]);
        session(['quote.lead_id' => $lead->id]);

        // Send confirmation email
        // TODO: Implement email sending

        return $lead;
    }
}
