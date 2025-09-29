<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Overview -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Total Clients -->
            <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800">
                <div class="p-4 flex items-center">
                    <div class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total Clients
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $stats['total_clients'] }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Active Clients -->
            <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800">
                <div class="p-4 flex items-center">
                    <div class="p-3 rounded-full text-green-500 dark:text-green-100 bg-green-100 dark:bg-green-500 mr-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Active Clients
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $stats['active_clients'] }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800">
                <div class="p-4">
                    <p class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Quick Actions</p>
                    <div class="grid grid-cols-2 gap-4 justify-center">
                        <a href="{{ route('clients.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring">
                            Manage Clients
                        </a>
                        <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring">
                            New Invoice
                        </button>
                    </div>
                </div>
            </div>

            <!-- Client Status -->
            <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800">
                <div class="p-4">
                    <p class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Client Status</p>
                    <div class="flex justify-between text-sm">
                        <div>
                            <span class="block text-gray-600 dark:text-gray-400">Active</span>
                            <span class="block mt-1 text-lg font-semibold text-green-600">{{ $stats['client_statuses']['active'] ?? 0 }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-600 dark:text-gray-400">Inactive</span>
                            <span class="block mt-1 text-lg font-semibold text-gray-600">{{ $stats['client_statuses']['inactive'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Clients -->
        <div class="mb-8">
            <div class="rounded-lg shadow-xs bg-white dark:bg-gray-800 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">
                            Recent Clients
                        </h2>
                        <a href="{{ route('clients.index') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                            View all →
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Client</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Business</th>
                                    <th class="px-4 py-3">Joined</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @forelse ($stats['recent_clients'] as $client)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-semibold">{{ $client->name }}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $client->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $client->status === 'active' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100' }}">
                                                {{ ucfirst($client->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $client->business_name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $client->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                                            No clients found. <a href="{{ route('clients.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Add your first client</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
