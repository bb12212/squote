<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->isAdmin())
                        <h3 class="mb-4 text-lg font-semibold">Admin Dashboard</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <a href="{{ route('admin.dashboard') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">Admin Dashboard</h4>
                                <p class="text-sm text-gray-600">View statistics and recent leads</p>
                            </a>
                            
                            <a href="{{ route('admin.leads.index') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">Manage Leads</h4>
                                <p class="text-sm text-gray-600">Assign providers to leads</p>
                            </a>
                            
                            <a href="{{ route('admin.providers.index') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">Manage Providers</h4>
                                <p class="text-sm text-gray-600">Approve and manage providers</p>
                            </a>
                            
                            <a href="{{ route('admin.regions.index') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">Manage Regions</h4>
                                <p class="text-sm text-gray-600">Create and edit regions</p>
                            </a>
                            
                            <a href="{{ route('admin.services.index') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">Manage Services</h4>
                                <p class="text-sm text-gray-600">Create and edit services</p>
                            </a>
                        </div>
                    @elseif(auth()->user()->isProvider())
                        <h3 class="mb-4 text-lg font-semibold">Provider Dashboard</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <a href="{{ route('provider.dashboard') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">Provider Dashboard</h4>
                                <p class="text-sm text-gray-600">View your statistics and recent leads</p>
                            </a>
                            
                            <a href="{{ route('provider.leads') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">My Leads</h4>
                                <p class="text-sm text-gray-600">View and manage your assigned leads</p>
                            </a>
                            
                            <a href="{{ route('provider.messages') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">Messages</h4>
                                <p class="text-sm text-gray-600">Communicate with potential customers</p>
                            </a>
                            
                            <a href="{{ route('provider.profile') }}" class="p-4 transition duration-150 bg-white border rounded-lg shadow-sm hover:shadow-md">
                                <h4 class="mb-2 text-base font-semibold text-indigo-600">My Profile</h4>
                                <p class="text-sm text-gray-600">Update your company profile</p>
                            </a>
                        </div>
                    @else
                        <h3 class="mb-4 text-lg font-semibold">Consumer Dashboard</h3>
                        <p>Welcome to your dashboard. Here you can track your solar quote requests and communicate with providers.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
