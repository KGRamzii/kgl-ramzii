<div>
    <div class="px-4 py-5 border-t border-gray-200 dark:border-gray-700 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200 dark:divide-gray-700">

            <!-- Current Services -->
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Current Services</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                    @if(!empty($clientServices) && $clientServices->isNotEmpty())
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($clientServices as $service)
                                <li class="flex items-center justify-between py-3">
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $service->name }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            Current Price: ${{ number_format($service->pivot->custom_price, 2) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <button
                                            type="button"
                                            wire:click="removeService({{ $service->id }})"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        >
                                            Remove
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-gray-500 dark:text-gray-400">No services assigned</span>
                    @endif
                </dd>
            </div>

            <!-- Add Service Form -->
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Add Service</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                    @if(!empty($availableServices) && $availableServices->isNotEmpty())
                        <form wire:submit="addService" class="space-y-4">
                            <div>
                                <label for="service" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Select Service
                                </label>
                                <select
                                    wire:model.live="selectedServiceId"
                                    id="service"
                                    class="block w-full mt-1 border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                >
                                    <option value="">Select a service...</option>
                                    @foreach($availableServices as $service)
                                        <option value="{{ $service->id }}">
                                            {{ $service->name }} (Default: ${{ number_format($service->default_price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="custom_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Custom Price
                                </label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input
                                        type="number"
                                        wire:model.live="customPrice"
                                        step="0.01"
                                        min="0"
                                        id="custom_price"
                                        class="block w-full pr-12 border-gray-300 rounded-md pl-7 sm:text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                        placeholder="0.00"
                                    >
                                </div>
                            </div>

                            <div>
                                <x-primary-button type="submit">
                                    Add Service
                                </x-primary-button>
                            </div>
                        </form>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">No additional services available</p>
                    @endif
                </dd>
            </div>

        </dl>
    </div>
</div>
