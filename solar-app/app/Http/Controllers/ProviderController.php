<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Quote;
use App\Models\Region;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProviderController extends Controller
{
    /**
     * Show the provider registration page.
     */
    public function register()
    {
        $services = Service::active()->ordered()->get();
        $regions = Region::active()->ordered()->get();
        
        return view('provider.register', compact('services', 'regions'));
    }

    /**
     * Process the provider registration.
     */
    public function storeRegistration(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
            'regions' => 'required|array|min:1',
            'regions.*' => 'exists:regions,id',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'certifications' => 'nullable|string|max:500',
            'terms_accepted' => 'required|accepted',
        ]);

        // Create the provider user
        $user = User::create([
            'name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'provider',
            'contact_name' => $request->contact_name,
            'website' => $request->website,
            'description' => $request->description,
            'certifications' => $request->certifications,
        ]);

        // Attach services and regions
        $user->services()->attach($request->services);
        $user->regions()->attach($request->regions);

        // Log the user in
        Auth::login($user);

        return redirect()->route('provider.dashboard')->with('success', 'Registration successful! Welcome to your provider dashboard.');
    }

    /**
     * Show the provider dashboard.
     */
    public function dashboard()
    {
        $provider = Auth::user();
        
        // Get leads assigned to this provider
        $leads = Lead::whereHas('providers', function ($query) use ($provider) {
            $query->where('users.id', $provider->id);
        })->latest()->paginate(10);
        
        // Get statistics
        $stats = [
            'total_leads' => $leads->total(),
            'new_leads' => $leads->where('status', 'new')->count(),
            'contacted_leads' => $leads->where('status', 'contacted')->count(),
            'converted_leads' => $leads->where('status', 'converted')->count(),
            'quotes_sent' => Quote::where('provider_id', $provider->id)->count(),
        ];
        
        return view('provider.dashboard', compact('leads', 'stats'));
    }

    /**
     * Show the provider profile page.
     */
    public function profile()
    {
        $provider = Auth::user();
        $services = Service::active()->ordered()->get();
        $regions = Region::active()->ordered()->get();
        
        return view('provider.profile', compact('provider', 'services', 'regions'));
    }

    /**
     * Update the provider profile.
     */
    public function updateProfile(Request $request)
    {
        $provider = Auth::user();
        
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($provider->id)],
            'phone' => 'required|string|max:20',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
            'regions' => 'required|array|min:1',
            'regions.*' => 'exists:regions,id',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'certifications' => 'nullable|string|max:500',
        ]);

        // Update the provider
        User::where('id', $provider->id)->update([
            'name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_name' => $request->contact_name,
            'website' => $request->website,
            'description' => $request->description,
            'certifications' => $request->certifications,
        ]);

        // Refresh the provider model
        $provider = User::find($provider->id);

        // Sync services and regions
        if (method_exists($provider, 'services')) {
            $provider->services()->sync($request->services);
        }
        
        if (method_exists($provider, 'regions')) {
            $provider->regions()->sync($request->regions);
        }

        return redirect()->route('provider.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the leads list page.
     */
    public function leads()
    {
        $provider = Auth::user();
        
        // Get leads assigned to this provider
        $leads = Lead::whereHas('providers', function ($query) use ($provider) {
            $query->where('users.id', $provider->id);
        })->latest()->paginate(15);
        
        return view('provider.leads', compact('leads'));
    }

    /**
     * Show a specific lead.
     */
    public function showLead($id)
    {
        $provider = Auth::user();
        
        $lead = Lead::whereHas('providers', function ($query) use ($provider) {
            $query->where('users.id', $provider->id);
        })->findOrFail($id);
        
        // Get existing quote if any
        $quote = Quote::where('provider_id', $provider->id)
            ->where('lead_id', $lead->id)
            ->first();
        
        return view('provider.lead-details', compact('lead', 'quote'));
    }

    /**
     * Submit a quote for a lead.
     */
    public function submitQuote(Request $request, $leadId)
    {
        $provider = Auth::user();
        
        $lead = Lead::whereHas('providers', function ($query) use ($provider) {
            $query->where('users.id', $provider->id);
        })->findOrFail($leadId);
        
        $request->validate([
            'total_price' => 'required|numeric|min:0',
            'installation_timeframe' => 'required|string|max:255',
            'system_details' => 'required|string|max:1000',
            'warranty_information' => 'required|string|max:500',
            'additional_notes' => 'nullable|string|max:1000',
        ]);

        // Create or update the quote
        Quote::updateOrCreate(
            [
                'provider_id' => $provider->id,
                'lead_id' => $lead->id,
            ],
            [
                'total_price' => $request->total_price,
                'installation_timeframe' => $request->installation_timeframe,
                'system_details' => $request->system_details,
                'warranty_information' => $request->warranty_information,
                'additional_notes' => $request->additional_notes,
                'status' => 'submitted',
            ]
        );

        // Update lead status if it's new
        if ($lead->status === 'new') {
            $lead->update(['status' => 'quoted']);
        }

        // TODO: Send notification to the consumer

        return redirect()->route('provider.lead', $lead->id)->with('success', 'Quote submitted successfully.');
    }

    /**
     * Show the messaging interface.
     */
    public function messages($leadId = null)
    {
        $provider = Auth::user();
        
        // Get all leads with messages for this provider
        $leadsWithMessages = Lead::whereHas('providers', function ($query) use ($provider) {
            $query->where('users.id', $provider->id);
        })->whereHas('messages')->get();
        
        $currentLead = null;
        $messages = collect();
        
        if ($leadId) {
            $currentLead = Lead::whereHas('providers', function ($query) use ($provider) {
                $query->where('users.id', $provider->id);
            })->findOrFail($leadId);
            
            $messages = $currentLead->messages()->orderBy('created_at')->get();
        }
        
        return view('provider.messages', compact('leadsWithMessages', 'currentLead', 'messages'));
    }

    /**
     * Send a message to a lead.
     */
    public function sendMessage(Request $request, $leadId)
    {
        $provider = Auth::user();
        
        $lead = Lead::whereHas('providers', function ($query) use ($provider) {
            $query->where('users.id', $provider->id);
        })->findOrFail($leadId);
        
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Create the message
        $message = $lead->messages()->create([
            'sender_id' => $provider->id,
            'sender_type' => 'provider',
            'content' => $request->message,
        ]);

        // TODO: Send notification to the consumer

        return redirect()->route('provider.messages', $lead->id)->with('success', 'Message sent successfully.');
    }
}
