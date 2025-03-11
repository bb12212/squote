<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Region;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        // Get counts for dashboard stats
        $leadCount = Lead::count();
        $providerCount = User::where('role', 'provider')->count();
        $pendingProviderCount = User::where('role', 'provider')->where('is_approved', false)->count();
        $regionCount = Region::count();
        
        // Get recent leads
        $recentLeads = Lead::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'leadCount', 
            'providerCount', 
            'pendingProviderCount', 
            'regionCount', 
            'recentLeads'
        ));
    }

    /**
     * Show all leads.
     */
    public function leads()
    {
        $leads = Lead::latest()->paginate(15);
        return view('admin.leads.index', compact('leads'));
    }

    /**
     * Show a specific lead.
     */
    public function showLead($id)
    {
        $lead = Lead::findOrFail($id);
        $providers = User::where('role', 'provider')
            ->where('is_approved', true)
            ->whereHas('regions', function($query) use ($lead) {
                $query->where('regions.id', $lead->region_id);
            })
            ->get();
            
        return view('admin.leads.show', compact('lead', 'providers'));
    }

    /**
     * Assign providers to a lead.
     */
    public function assignProviders(Request $request, $leadId)
    {
        $request->validate([
            'provider_ids' => 'required|array',
            'provider_ids.*' => 'exists:users,id',
        ]);

        $lead = Lead::findOrFail($leadId);
        
        // Sync the providers with the lead
        $lead->providers()->sync($request->provider_ids);
        
        return redirect()->route('admin.leads.show', $lead->id)
            ->with('success', 'Providers assigned successfully.');
    }

    /**
     * Show all providers.
     */
    public function providers()
    {
        $providers = User::where('role', 'provider')->paginate(15);
        return view('admin.providers.index', compact('providers'));
    }

    /**
     * Show a specific provider.
     */
    public function showProvider($id)
    {
        $provider = User::where('role', 'provider')->findOrFail($id);
        $regions = Region::all();
        $services = Service::all();
        
        return view('admin.providers.show', compact('provider', 'regions', 'services'));
    }

    /**
     * Update a provider's approval status.
     */
    public function approveProvider(Request $request, $id)
    {
        $provider = User::where('role', 'provider')->findOrFail($id);
        $provider->is_approved = $request->is_approved ? true : false;
        $provider->save();
        
        return redirect()->route('admin.providers.show', $provider->id)
            ->with('success', 'Provider approval status updated successfully.');
    }

    /**
     * Show all regions.
     */
    public function regions()
    {
        $regions = Region::paginate(15);
        return view('admin.regions.index', compact('regions'));
    }

    /**
     * Show the form to create a new region.
     */
    public function createRegion()
    {
        return view('admin.regions.create');
    }

    /**
     * Store a new region.
     */
    public function storeRegion(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'postcode_pattern' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
        
        $region = new Region();
        $region->name = $request->name;
        $region->postcode_pattern = $request->postcode_pattern;
        $region->is_active = $request->is_active ?? false;
        $region->save();
        
        return redirect()->route('admin.regions.index')
            ->with('success', 'Region created successfully.');
    }

    /**
     * Show the form to edit a region.
     */
    public function editRegion($id)
    {
        $region = Region::findOrFail($id);
        return view('admin.regions.edit', compact('region'));
    }

    /**
     * Update a region.
     */
    public function updateRegion(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'postcode_pattern' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
        
        $region = Region::findOrFail($id);
        $region->name = $request->name;
        $region->postcode_pattern = $request->postcode_pattern;
        $region->is_active = $request->is_active ?? false;
        $region->save();
        
        return redirect()->route('admin.regions.index')
            ->with('success', 'Region updated successfully.');
    }

    /**
     * Show all services.
     */
    public function services()
    {
        $services = Service::paginate(15);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form to create a new service.
     */
    public function createService()
    {
        return view('admin.services.create');
    }

    /**
     * Store a new service.
     */
    public function storeService(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);
        
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->is_active = $request->is_active ?? false;
        $service->display_order = $request->display_order ?? 0;
        $service->save();
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Show the form to edit a service.
     */
    public function editService($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update a service.
     */
    public function updateService(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);
        
        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->is_active = $request->is_active ?? false;
        $service->display_order = $request->display_order ?? 0;
        $service->save();
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }
} 