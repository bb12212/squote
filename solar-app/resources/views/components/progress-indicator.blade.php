@props(['currentStep' => 1])

<div class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav aria-label="Progress">
            <ol role="list" class="flex items-center">
                <!-- Step 1: Service Selection -->
                <li class="relative pr-8 sm:pr-20 flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="{{ $currentStep >= 1 ? 'bg-green-600' : 'bg-gray-200' }} h-10 w-10 rounded-full flex items-center justify-center">
                                @if($currentStep > 1)
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <span class="text-white font-medium">1</span>
                                @endif
                            </div>
                        </div>
                        <div class="ml-4 min-w-0 flex flex-col">
                            <span class="text-xs font-medium {{ $currentStep >= 1 ? 'text-green-600' : 'text-gray-500' }}">Step 1</span>
                            <span class="text-sm font-medium {{ $currentStep >= 1 ? 'text-gray-900' : 'text-gray-500' }}">Services</span>
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-0 right-0 h-full w-5">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                </li>

                <!-- Step 2: Property Details -->
                <li class="relative pr-8 sm:pr-20 flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="{{ $currentStep >= 2 ? 'bg-green-600' : 'bg-gray-200' }} h-10 w-10 rounded-full flex items-center justify-center">
                                @if($currentStep > 2)
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <span class="text-white font-medium">2</span>
                                @endif
                            </div>
                        </div>
                        <div class="ml-4 min-w-0 flex flex-col">
                            <span class="text-xs font-medium {{ $currentStep >= 2 ? 'text-green-600' : 'text-gray-500' }}">Step 2</span>
                            <span class="text-sm font-medium {{ $currentStep >= 2 ? 'text-gray-900' : 'text-gray-500' }}">Property</span>
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-0 right-0 h-full w-5">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                </li>

                <!-- Step 3: Contact Information -->
                <li class="relative pr-8 sm:pr-20 flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="{{ $currentStep >= 3 ? 'bg-green-600' : 'bg-gray-200' }} h-10 w-10 rounded-full flex items-center justify-center">
                                @if($currentStep > 3)
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <span class="text-white font-medium">3</span>
                                @endif
                            </div>
                        </div>
                        <div class="ml-4 min-w-0 flex flex-col">
                            <span class="text-xs font-medium {{ $currentStep >= 3 ? 'text-green-600' : 'text-gray-500' }}">Step 3</span>
                            <span class="text-sm font-medium {{ $currentStep >= 3 ? 'text-gray-900' : 'text-gray-500' }}">Contact</span>
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-0 right-0 h-full w-5">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                </li>

                <!-- Step 4: Additional Details -->
                <li class="relative pr-8 sm:pr-20 flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="{{ $currentStep >= 4 ? 'bg-green-600' : 'bg-gray-200' }} h-10 w-10 rounded-full flex items-center justify-center">
                                @if($currentStep > 4)
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <span class="text-white font-medium">4</span>
                                @endif
                            </div>
                        </div>
                        <div class="ml-4 min-w-0 flex flex-col">
                            <span class="text-xs font-medium {{ $currentStep >= 4 ? 'text-green-600' : 'text-gray-500' }}">Step 4</span>
                            <span class="text-sm font-medium {{ $currentStep >= 4 ? 'text-gray-900' : 'text-gray-500' }}">Details</span>
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-0 right-0 h-full w-5">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                </li>

                <!-- Step 5: Confirmation -->
                <li class="relative flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="{{ $currentStep >= 5 ? 'bg-green-600' : 'bg-gray-200' }} h-10 w-10 rounded-full flex items-center justify-center">
                                <span class="text-white font-medium">5</span>
                            </div>
                        </div>
                        <div class="ml-4 min-w-0 flex flex-col">
                            <span class="text-xs font-medium {{ $currentStep >= 5 ? 'text-green-600' : 'text-gray-500' }}">Step 5</span>
                            <span class="text-sm font-medium {{ $currentStep >= 5 ? 'text-gray-900' : 'text-gray-500' }}">Confirmation</span>
                        </div>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</div> 