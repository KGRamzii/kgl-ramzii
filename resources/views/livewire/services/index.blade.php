<div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Services</h1>
        <flux:modal.trigger name="create-service">
            <flux:button class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Service
            </flux:button>
        </flux:modal.trigger>
    </div>

    <!-- Services Table -->
    @if($services->count())
        <div class="overflow-hidden bg-white rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($services as $service)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $service->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $service->description ?? 'No description' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">${{ number_format($service->default_price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($service->active)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Active</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex justify-end gap-2">
                                    <flux:modal.trigger name="edit-service-{{ $service->id }}">
                                        <flux:button>Edit</flux:button>
                                    </flux:modal.trigger>

                                    <flux:button wire:click="toggleActive({{ $service->id }})" class="{{ $service->active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                        {{ $service->active ? 'Deactivate' : 'Activate' }}
                                    </flux:button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal for each service -->
                        <flux:modal name="edit-service-{{ $service->id }}" class="md:w-96">
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">Edit Service</flux:heading>
                                    <flux:text class="mt-2">Update service details.</flux:text>
                                </div>

                                <flux:input label="Name" placeholder="Service name" wire:model="name" />
                                <flux:input label="Description" placeholder="Optional description" wire:model="description" />
                                <flux:input label="Default Price" type="number" min="0" step="0.01" wire:model="default_price" />
                                <div class="flex items-center">
                                    <input type="checkbox" id="active-{{ $service->id }}" wire:model="active" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label for="active-{{ $service->id }}" class="ml-2 text-gray-700">Active</label>
                                </div>

                                <div class="flex justify-end gap-2">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">Cancel</flux:button>
                                    </flux:modal.close>
                                    <flux:button wire:click="save" variant="primary">Save</flux:button>
                                </div>
                            </div>
                        </flux:modal>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $services->links() }}</div>
    @else
        <div class="py-12 text-center">
            <h3 class="mt-2 text-sm font-medium text-gray-900">No services</h3>
            <flux:modal.trigger name="create-service">
                <flux:button>New Service</flux:button>
            </flux:modal.trigger>
        </div>
    @endif

    <!-- Create Service Modal -->
    <flux:modal name="create-service" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingService ? 'Edit Service' : 'Create Service' }}</flux:heading>
                <flux:text class="mt-2">Add a new service or update an existing one.</flux:text>
            </div>

            <flux:input label="Name" placeholder="Service name" wire:model="name" />
            <flux:input label="Description" placeholder="Optional description" wire:model="description" />
            <flux:input label="Default Price" type="number" min="0" step="0.01" wire:model="default_price" />
            <div class="flex items-center">
                <flux:input type="checkbox" id="active-create" wire:model="active" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"/>
                <label for="active-create" class="ml-2 text-gray-700">Active</label>
            </div>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" wire:click="save" variant="primary">Save</flux:button>
            </div>
        </div>
    </flux:modal>

    <hr class="my-6 border-t" />
    <flux:modal.trigger name="delete-profile">
    <flux:button variant="danger">Delete</flux:button>
</flux:modal.trigger>

<flux:modal name="delete-profile" class="min-w-[22rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete project?</flux:heading>

            <flux:text class="mt-2">
                <p>You're about to delete this project.</p>
                <p>This action cannot be reversed.</p>
            </flux:text>
        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>

            <flux:button type="submit" variant="danger">Delete project</flux:button>
        </div>
    </div>
</flux:modal>
</div>
