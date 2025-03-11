<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Lead Details</h1>
                    <p class="mt-1 text-sm text-gray-600">View and manage lead information</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('provider.leads') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Back to Leads') }}
                    </a>
                    <a href="{{ route('provider.messages', $lead->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Message Customer') }}
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Lead Information -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Name</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ $lead->first_name }} {{ $lead->last_name }}</div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Email</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ $lead->email }}</div>
                                </div>
                                
                                @if ($lead->phone)
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Phone</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ $lead->phone }}</div>
                                </div>
                                @endif
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Preferred Contact Method</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ ucfirst($lead->preferred_contact_method) }}</div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Date Submitted</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ $lead->created_at->format('M d, Y') }}</div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Status</div>
                                    <div class="mt-1">
                                        @if ($lead->status === 'new')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                New
                                            </span>
                                        @elseif ($lead->status === 'contacted')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Contacted
                                            </span>
                                        @elseif ($lead->status === 'quoted')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Quoted
                                            </span>
                                        @elseif ($lead->status === 'converted')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                Converted
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ ucfirst($lead->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Property Details</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Postcode</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ $lead->property->postcode }}</div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Property Type</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ ucfirst($lead->property->property_type) }}</div>
                                </div>
                                
                                @if ($lead->property->roof_type)
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Roof Type</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ ucfirst($lead->property->roof_type) }}</div>
                                </div>
                                @endif
                                
                                @if ($lead->property->roof_material)
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Roof Material</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ ucfirst($lead->property->roof_material) }}</div>
                                </div>
                                @endif
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Significant Shading</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ $lead->property->has_significant_shading ? 'Yes' : 'No' }}</div>
                                </div>
                                
                                @if ($lead->property->monthly_energy_bill)
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Monthly Energy Bill</div>
                                    <div class="mt-1 text-sm text-gray-900">£{{ number_format($lead->property->monthly_energy_bill, 2) }}</div>
                                </div>
                                @endif
                                
                                @if ($lead->property->annual_energy_usage)
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Annual Energy Usage</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ number_format($lead->property->annual_energy_usage) }} kWh</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Services Requested</h2>
                            
                            <div class="flex flex-wrap gap-2">
                                @foreach ($lead->services as $service)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                        {{ $service->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if ($lead->additional_details)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Additional Details</h2>
                            
                            <div class="text-sm text-gray-900 whitespace-pre-line">{{ $lead->additional_details }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Quote Submission -->
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">{{ $quote ? 'Update Quote' : 'Submit Quote' }}</h2>
                            
                            <form method="POST" action="{{ route('provider.submit-quote', $lead->id) }}" class="space-y-4">
                                @csrf
                                
                                <div>
                                    <x-input-label for="total_price" :value="__('Total Price (£)')" />
                                    <x-text-input id="total_price" class="block mt-1 w-full" type="number" name="total_price" :value="old('total_price', $quote ? $quote->total_price : '')" required step="0.01" min="0" />
                                    <x-input-error :messages="$errors->get('total_price')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="installation_timeframe" :value="__('Installation Timeframe')" />
                                    <x-text-input id="installation_timeframe" class="block mt-1 w-full" type="text" name="installation_timeframe" :value="old('installation_timeframe', $quote ? $quote->installation_timeframe : '')" required placeholder="e.g. 2-3 weeks" />
                                    <x-input-error :messages="$errors->get('installation_timeframe')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="system_details" :value="__('System Details')" />
                                    <textarea id="system_details" name="system_details" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Describe the proposed system specifications">{{ old('system_details', $quote ? $quote->system_details : '') }}</textarea>
                                    <x-input-error :messages="$errors->get('system_details')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="warranty_information" :value="__('Warranty Information')" />
                                    <textarea id="warranty_information" name="warranty_information" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Describe warranty terms">{{ old('warranty_information', $quote ? $quote->warranty_information : '') }}</textarea>
                                    <x-input-error :messages="$errors->get('warranty_information')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="additional_notes" :value="__('Additional Notes (Optional)')" />
                                    <textarea id="additional_notes" name="additional_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Any additional information">{{ old('additional_notes', $quote ? $quote->additional_notes : '') }}</textarea>
                                    <x-input-error :messages="$errors->get('additional_notes')" class="mt-2" />
                                </div>
                                
                                <div class="flex items-center justify-end">
                                    <x-primary-button>
                                        {{ $quote ? __('Update Quote') : __('Submit Quote') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 