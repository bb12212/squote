<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Messages</h1>
                <p class="mt-1 text-sm text-gray-600">Communicate with potential customers</p>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-0 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-4">
                        <!-- Leads Sidebar -->
                        <div class="border-r border-gray-200 md:col-span-1">
                            <div class="p-4 border-b border-gray-200">
                                <h2 class="text-lg font-medium text-gray-900">Conversations</h2>
                            </div>
                            <div class="overflow-y-auto" style="max-height: 600px;">
                                @if ($leadsWithMessages->count() > 0)
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($leadsWithMessages as $leadItem)
                                            <li>
                                                <a href="{{ route('provider.messages', $leadItem->id) }}" class="block hover:bg-gray-50 {{ $currentLead && $currentLead->id === $leadItem->id ? 'bg-indigo-50' : '' }}">
                                                    <div class="px-4 py-4">
                                                        <div class="flex justify-between">
                                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $leadItem->first_name }} {{ $leadItem->last_name }}</p>
                                                            <p class="text-xs text-gray-500">{{ $leadItem->messages->sortByDesc('created_at')->first()->created_at->format('M d') }}</p>
                                                        </div>
                                                        <p class="mt-1 text-xs text-gray-500 truncate">{{ $leadItem->property->postcode }}</p>
                                                        <p class="mt-1 text-xs text-gray-500 truncate">
                                                            @foreach ($leadItem->services as $service)
                                                                {{ $service->name }}{{ !$loop->last ? ', ' : '' }}
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center py-8">
                                        <p class="text-sm text-gray-500">No conversations yet</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Message Area -->
                        <div class="md:col-span-3">
                            @if ($currentLead)
                                <div class="flex flex-col h-full" style="height: 600px;">
                                    <!-- Lead Info Header -->
                                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                                        <div>
                                            <h2 class="text-lg font-medium text-gray-900">{{ $currentLead->first_name }} {{ $currentLead->last_name }}</h2>
                                            <p class="text-sm text-gray-500">{{ $currentLead->property->postcode }}</p>
                                        </div>
                                        <a href="{{ route('provider.lead', $currentLead->id) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            View Lead
                                        </a>
                                    </div>

                                    <!-- Messages -->
                                    <div class="flex-1 p-4 overflow-y-auto bg-gray-50">
                                        @if ($messages->count() > 0)
                                            <div class="space-y-4">
                                                @foreach ($messages as $message)
                                                    <div class="flex {{ $message->sender_type === 'provider' ? 'justify-end' : 'justify-start' }}">
                                                        <div class="max-w-md px-4 py-2 rounded-lg {{ $message->sender_type === 'provider' ? 'bg-indigo-100 text-indigo-900' : 'bg-white border border-gray-200 text-gray-900' }}">
                                                            <div class="text-sm">{{ $message->content }}</div>
                                                            <div class="mt-1 text-xs text-gray-500 text-right">{{ $message->created_at->format('M d, g:i a') }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-8">
                                                <p class="text-sm text-gray-500">No messages yet. Start the conversation!</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Message Input -->
                                    <div class="p-4 border-t border-gray-200 bg-white">
                                        <form method="POST" action="{{ route('provider.send-message', $currentLead->id) }}">
                                            @csrf
                                            <div class="flex">
                                                <div class="flex-1">
                                                    <textarea name="message" rows="2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Type your message..." required></textarea>
                                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                                </div>
                                                <div class="ml-3 flex items-end">
                                                    <x-primary-button>
                                                        {{ __('Send') }}
                                                    </x-primary-button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center justify-center h-full" style="height: 600px;">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No conversation selected</h3>
                                        <p class="mt-1 text-sm text-gray-500">Select a lead from the sidebar to view messages</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 