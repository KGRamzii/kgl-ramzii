<div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Invoice Items</h2>

    <form wire:submit="save" class="mb-6 space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Service</label>
            <select
                wire:model.live="selectedService"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            >
                <option value="">Select a service...</option>
                @foreach($this->availableServices as $service)
                    <option value="{{ $service->id }}" data-price="{{ $service->pivot->custom_price ?? $service->default_price }}">
                        {{ $service->name }} (${{ number_format($service->pivot->custom_price ?? $service->default_price, 2) }})
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('selectedService')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (Optional)</label>
            <x-text-input
                type="text"
                wire:model.live="description"
                placeholder="Additional details..."
                class="mt-1 block w-full"
            />
            <x-input-error :messages="$errors->get('description')" class="mt-1" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantity</label>
                <x-text-input
                    type="number"
                    wire:model.live="quantity"
                    min="1"
                    step="1"
                    class="mt-1 block w-full"
                />
                <x-input-error :messages="$errors->get('quantity')" class="mt-1" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unit Price</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <x-text-input
                        type="number"
                        wire:model.live="unitPrice"
                        step="0.01"
                        min="0"
                        class="block w-full pl-7"
                        placeholder="0.00"
                    />
                </div>
                <x-input-error :messages="$errors->get('unitPrice')" class="mt-1" />
            </div>
        </div>

        <div class="pt-3">
            <x-primary-button type="submit">
                Add Item
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Current Items</h3>
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Service</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Qty</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Price</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Total</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                    @forelse ($this->items as $item)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm">
                                <div class="font-medium text-gray-900 dark:text-gray-100">{{ $item->service->name ?? 'Custom Item' }}</div>
                                @if($item->description)
                                    <div class="text-gray-500 dark:text-gray-400">{{ $item->description }}</div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ $item->quantity }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                ${{ number_format($item->unit_price, 2) }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                ${{ number_format($item->line_total, 2) }}
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <button
                                    wire:click="delete({{ $item->id }})"
                                    type="button"
                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No items added yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="row" colspan="3" class="pl-4 pr-3 py-3.5 text-right text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Total:
                        </th>
                        <td class="px-3 py-3.5 text-sm font-medium text-gray-900 dark:text-gray-100">
                            ${{ number_format($this->total, 2) }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
