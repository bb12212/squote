<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Provider Details') }}
            </h2>
            <a href="{{ route('admin.providers.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Back to Providers
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
                <!-- Provider Information -->
                <div class="col-span-2">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">Provider Information</h3>
                                <div>
                                    @if($provider->is_approved)
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            Approved
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                            Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <p class="text-sm text-gray-500">Company Name</p>
                                    <p class="font-medium">{{ $provider->company_name ?? 'N/A' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Contact Name</p>
                                    <p class="font-medium">{{ $provider->contact_name ?? $provider->name }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $provider->email }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="font-medium">{{ $provider->phone }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Website</p>
                                    <p class="font-medium">
                                        @if($provider->website)
                                            <a href="{{ $provider->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $provider->website }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Preferred Contact Method</p>
                                    <p class="font-medium">{{ ucfirst($provider->preferred_contact_method) }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Subscription Status</p>
                                    <p class="font-medium">{{ ucfirst($provider->subscription_status ?? 'None') }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Subscription Ends</p>
                                    <p class="font-medium">{{ $provider->subscription_ends_at ? $provider->subscription_ends_at->format('M d, Y') : 'N/A' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Registered</p>
                                    <p class="font-medium">{{ $provider->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Company Description -->
                    @if($provider->company_description)
                        <div class="mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="mb-4 text-lg font-semibold text-gray-700">Company Description</h3>
                                <p>{{ $provider->company_description }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Services Offered -->
                    <div class="mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="mb-4 text-lg font-semibold text-gray-700">Services Offered</h3>
                            
                            @if($provider->services->count() > 0)
                                <ul class="pl-5 list-disc">
                                    @foreach($provider->services as $service)
                                        <li class="mb-1">{{ $service->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No services selected.</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Regions Served -->
                    <div class="mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="mb-4 text-lg font-semibold text-gray-700">Regions Served</h3>
                            
                            @if($provider->regions->count() > 0)
                                <ul class="pl-5 list-disc">
                                    @foreach($provider->regions as $region)
                                        <li class="mb-1">
                                            {{ $region->name }}
                                            @if($region->pivot->is_preferred)
                                                <span class="ml-2 text-xs text-indigo-600">(Preferred)</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No regions selected.</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Certifications -->
                    @if($provider->certifications)
                        <div class="mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="mb-4 text-lg font-semibold text-gray-700">Certifications</h3>
                                
                                @php
                                    $certifications = json_decode($provider->certifications);
                                @endphp
                                
                                @if(is_array($certifications) && count($certifications) > 0)
                                    <ul class="pl-5 list-disc">
                                        @foreach($certifications as $certification)
                                            <li class="mb-1">{{ $certification }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500">No certifications listed.</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Approval Actions -->
                <div>
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="mb-4 text-lg font-semibold text-gray-700">Provider Actions</h3>
                            
                            <form action="{{ route('admin.providers.approve', $provider->id) }}" method="POST">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="is_approved" class="block text-sm font-medium text-gray-700">Approval Status</label>
                                    <select name="is_approved" id="is_approved" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="1" {{ $provider->is_approved ? 'selected' : '' }}>Approved</option>
                                        <option value="0" {{ !$provider->is_approved ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                                
                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Update Status
                                    </button>
                                </div>
                            </form>
                            
                            <div class="mt-8">
                                <h4 class="mb-2 font-semibold text-gray-700">Assigned Leads</h4>
                                
                                @if($provider->assignedLeads->count() > 0)
                                    <ul class="space-y-2">
                                        @foreach($provider->assignedLeads as $lead)
                                            <li class="flex items-center justify-between p-2 border rounded">
                                                <span>{{ $lead->name }} ({{ $lead->email }})</span>
                                                <a href="{{ route('admin.leads.show', $lead->id) }}" class="text-sm text-indigo-600 hover:text-indigo-900">View</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500">No leads assigned yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 