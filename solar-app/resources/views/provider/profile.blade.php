<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Provider Profile</h1>
                <p class="mt-1 text-sm text-gray-600">Manage your company information and service offerings</p>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('provider.update-profile') }}" class="space-y-6">
                        @csrf

                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Company Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="company_name" :value="__('Company Name')" />
                                    <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name', $provider->name)" required />
                                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="contact_name" :value="__('Contact Name')" />
                                    <x-text-input id="contact_name" class="block mt-1 w-full" type="text" name="contact_name" :value="old('contact_name', $provider->contact_name)" required />
                                    <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $provider->email)" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $provider->phone)" required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="website" :value="__('Website (Optional)')" />
                                    <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website', $provider->website)" />
                                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Services & Coverage</h2>
                            
                            <div class="mb-6">
                                <x-input-label :value="__('Services Offered')" class="mb-2" />
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($services as $service)
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="service_{{ $service->id }}" name="services[]" type="checkbox" value="{{ $service->id }}" class="w-4 h-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500" 
                                                    {{ in_array($service->id, old('services', $provider->services->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="service_{{ $service->id }}" class="font-medium text-gray-700">{{ $service->name }}</label>
                                                <p class="text-gray-500">{{ $service->description }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('services')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label :value="__('Regions Covered')" class="mb-2" />
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($regions as $region)
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="region_{{ $region->id }}" name="regions[]" type="checkbox" value="{{ $region->id }}" class="w-4 h-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500" 
                                                    {{ in_array($region->id, old('regions', $provider->regions->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="region_{{ $region->id }}" class="font-medium text-gray-700">{{ $region->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('regions')" class="mt-2" />
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h2>
                            
                            <div class="mb-6">
                                <x-input-label for="description" :value="__('Company Description')" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $provider->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="certifications" :value="__('Certifications & Accreditations')" />
                                <textarea id="certifications" name="certifications" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('certifications', $provider->certifications) }}</textarea>
                                <x-input-error :messages="$errors->get('certifications')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button class="ml-4">
                                {{ __('Update Profile') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 