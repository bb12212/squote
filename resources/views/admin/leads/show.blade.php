<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Lead Details') }}
            </h2>
            <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Back to Leads
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- Lead Information -->
                <div class="col-span-2">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="mb-4 text-lg font-semibold text-gray-700">Lead Information</h3>
                            
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <p class="text-sm text-gray-500">Name</p>
                                    <p class="font-medium">{{ $lead->name }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $lead->email }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="font-medium">{{ $lead->phone }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Preferred Contact Method</p>
                                    <p class="font-medium">{{ ucfirst($lead->preferred_contact_method) }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Region</p>
                                    <p class="font-medium">{{ $lead->region ? $lead->region->name : 'N/A' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Postcode</p>
                                    <p class="font-medium">{{ $lead->postcode }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Created</p>
                                    <p class="font-medium">{{ $lead->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Services Requested -->
                    <div class="mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="mb-4 text-lg font-semibold text-gray-700">Services Requested</h3>
                            
                            @if($lead->services->count() > 0)
                                <ul class="pl-5 list-disc">
                                    @foreach($lead->services as $service)
                                        <li class="mb-1">{{ $service->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No services selected.</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Property Details -->
                    @if($lead->property)
                        <div class="mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="mb-4 text-lg font-semibold text-gray-700">Property Details</h3>
                                
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <p class="text-sm text-gray-500">Property Type</p>
                                        <p class="font-medium">{{ ucfirst($lead->property->property_type) }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Roof Type</p>
                                        <p class="font-medium">{{ ucfirst($lead->property->roof_type) }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Roof Material</p>
                                        <p class="font-medium">{{ ucfirst($lead->property->roof_material) }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Significant Shading</p>
                                        <p class="font-medium">{{ $lead->property->has_significant_shading ? 'Yes' : 'No' }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Monthly Energy Bill</p>
                                        <p class="font-medium">£{{ $lead->property->monthly_energy_bill ?? 'N/A' }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Annual Energy Usage</p>
                                        <p class="font-medium">{{ $lead->property->annual_energy_usage ?? 'N/A' }} kWh</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Additional Details -->
                    @if($lead->additional_details)
                        <div class="mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="mb-4 text-lg font-semibold text-gray-700">Additional Details</h3>
                                <p>{{ $lead->additional_details }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Assign Providers -->
                <div>
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="mb-4 text-lg font-semibold text-gray-700">Assigned Providers</h3>
                            
                            @if($lead->providers->count() > 0)
                                <ul class="mb-4 space-y-2">
                                    @foreach($lead->providers as $provider)
                                        <li class="flex items-center justify-between p-2 border rounded">
                                            <span>{{ $provider->company_name ?? $provider->name }}</span>
                                            <span class="text-sm text-gray-500">{{ $provider->pivot->created_at->format('M d, Y') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="mb-4 text-gray-500">No providers assigned yet.</p>
                            @endif
                            
                            <h4 class="mt-6 mb-2 font-semibold text-gray-700">Assign Providers</h4>
                            
                            @if($providers->count() > 0)
                                <form action="{{ route('admin.leads.assign', $lead->id) }}" method="POST">
                                    @csrf
                                    
                                    <div class="mb-4">
                                        <label for="provider_ids" class="block text-sm font-medium text-gray-700">Select Providers</label>
                                        <select name="provider_ids[]" id="provider_ids" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" multiple>
                                            @foreach($providers as $provider)
                                                <option value="{{ $provider->id }}" {{ $lead->providers->contains($provider->id) ? 'selected' : '' }}>
                                                    {{ $provider->company_name ?? $provider->name }} ({{ $provider->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="mt-1 text-xs text-gray-500">Hold Ctrl/Cmd to select multiple providers</p>
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Assign Providers
                                        </button>
                                    </div>
                                </form>
                            @else
                                <p class="text-gray-500">No eligible providers found for this region.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 