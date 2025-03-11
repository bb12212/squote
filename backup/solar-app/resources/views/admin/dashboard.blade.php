<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-4">
                        <!-- Stats Cards -->
                        <div class="p-4 bg-white rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-700">Total Leads</h3>
                            <p class="text-3xl font-bold text-indigo-600">{{ $leadCount }}</p>
                            <a href="{{ route('admin.leads.index') }}" class="text-sm text-indigo-600 hover:underline">View all leads</a>
                        </div>
                        
                        <div class="p-4 bg-white rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-700">Total Providers</h3>
                            <p class="text-3xl font-bold text-indigo-600">{{ $providerCount }}</p>
                            <a href="{{ route('admin.providers.index') }}" class="text-sm text-indigo-600 hover:underline">View all providers</a>
                        </div>
                        
                        <div class="p-4 bg-white rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-700">Pending Approvals</h3>
                            <p class="text-3xl font-bold text-indigo-600">{{ $pendingProviderCount }}</p>
                            <a href="{{ route('admin.providers.index') }}" class="text-sm text-indigo-600 hover:underline">Review providers</a>
                        </div>
                        
                        <div class="p-4 bg-white rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-700">Total Regions</h3>
                            <p class="text-3xl font-bold text-indigo-600">{{ $regionCount }}</p>
                            <a href="{{ route('admin.regions.index') }}" class="text-sm text-indigo-600 hover:underline">Manage regions</a>
                        </div>
                    </div>
                    
                    <!-- Recent Leads -->
                    <div class="mt-8">
                        <h3 class="mb-4 text-xl font-semibold text-gray-700">Recent Leads</h3>
                        
                        @if($recentLeads->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase border-b">ID</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase border-b">Name</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase border-b">Email</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase border-b">Region</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase border-b">Created</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase border-b">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($recentLeads as $lead)
                                            <tr>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $lead->id }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $lead->name }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $lead->email }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ $lead->region ? $lead->region->name : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ $lead->created_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                    <a href="{{ route('admin.leads.show', $lead->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">No leads found.</p>
                        @endif
                        
                        <div class="mt-4">
                            <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                View All Leads
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 