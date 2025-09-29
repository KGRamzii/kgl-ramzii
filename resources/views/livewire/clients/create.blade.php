<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add New Client</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Create a new client profile with their basic information.
                    </p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit="save">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white dark:bg-gray-800 space-y-6 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input-label for="name" value="Name" />
                                    <x-text-input wire:model.live="name" id="name" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input-label for="email" value="Email" />
                                    <x-text-input wire:model.live="email" id="email" type="email" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Business Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input-label for="business_name" value="Business Name (Optional)" />
                                    <x-text-input wire:model.live="business_name" id="business_name" type="text" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
                                </div>

                                <!-- Phone -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input-label for="phone" value="Phone (Optional)" />
                                    <x-text-input wire:model.live="phone" id="phone" type="tel" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <!-- Monthly Rate -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input-label for="monthly_rate" value="Monthly Rate" />
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
                                        </div>
                                        <x-text-input
                                            wire:model.live="monthly_rate"
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            id="monthly_rate"
                                            class="mt-1 block w-full pl-7"
                                            placeholder="0.00"
                                        />
                                    </div>
                                    <x-input-error :messages="$errors->get('monthly_rate')" class="mt-2" />
                                </div>

                                <!-- Status -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input-label for="status" value="Status" />
                                    <select
                                        wire:model.live="status"
                                        id="status"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
                                    >
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>

                                <!-- Recurring -->
                                <div class="col-span-6 sm:col-span-4">
                                    <div class="flex items-center">
                                        <input
                                            wire:model.live="recurring"
                                            id="recurring"
                                            type="checkbox"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        >
                                        <label for="recurring" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                                            Recurring Client (Monthly Invoicing)
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('recurring')" class="mt-2" />
                                </div>

                                <!-- Notes -->
                                <div class="col-span-6">
                                    <x-input-label for="notes" value="Notes (Optional)" />
                                    <textarea
                                        wire:model.live="notes"
                                        id="notes"
                                        rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    ></textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 text-right sm:px-6">
                            <x-secondary-button wire:navigate href="{{ route('clients.index') }}" class="mr-3">
                                Cancel
                            </x-secondary-button>
                            <x-primary-button type="submit">
                                Create Client
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
