<div class="max-w-2xl p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-xl font-bold">Invoices</h2>

    <form wire:submit="save" class="mb-6 space-y-3">
        <div>
            <select wire:model.live="client_id" class="w-full px-3 py-2 border rounded" required>
                <option value="">Select Client</option>
                @foreach ($this->clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <input type="text" wire:model.live="invoice_number" placeholder="Invoice Number" class="w-full px-3 py-2 border rounded" required>
            @error('invoice_number') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-3 gap-2">
            <div>
                <label class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" wire:model.live="date_start" class="w-full px-3 py-2 border rounded" required>
                @error('date_start') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" wire:model.live="date_end" class="w-full px-3 py-2 border rounded" required>
                @error('date_end') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" wire:model.live="due_date" class="w-full px-3 py-2 border rounded" required>
                @error('due_date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <input type="number" wire:model.live="total_amount" placeholder="Total Amount" class="w-full px-3 py-2 border rounded" required min="0" step="0.01">
            @error('total_amount') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <select wire:model.live="status" class="w-full px-3 py-2 border rounded" required>
                <option value="">Select Status</option>
                <option value="draft">Draft</option>
                <option value="sent">Sent</option>
                <option value="paid">Paid</option>
                <option value="overdue">Overdue</option>
            </select>
            @error('status') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" wire:loading.attr="disabled">
            <span wire:loading.remove>Add Invoice</span>
            <span wire:loading>Adding...</span>
        </button>
    </form>

    <!-- Success/Error Messages -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-200 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Invoices List -->
    <div class="divide-y">
        @forelse ($this->invoices as $invoice)
            <div class="flex items-center justify-between py-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3">
                        <span class="text-lg font-semibold">{{ $invoice->invoice_number }}</span>
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $invoice->status === 'sent' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $invoice->status === 'draft' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ $invoice->status === 'overdue' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </div>
                    <div class="mt-1 text-sm text-gray-600">
                        <span>Client: {{ $invoice->client->name ?? 'N/A' }}</span>
                        <span class="mx-2">•</span>
                        <span>Amount: R{{ number_format($invoice->total_amount, 2) }}</span>
                        <span class="mx-2">•</span>
                        <span>Due: {{ \Carbon\Carbon::parse($invoice->due_date)->format('M j, Y') }}</span>
                    </div>
                </div>

                <div class="flex gap-2 ml-4">
                    <button
                        wire:click="openInvoiceItems({{ $invoice->id }})"
                        class="px-3 py-1 text-sm text-blue-600 border border-blue-300 rounded hover:bg-blue-50">
                        Items
                    </button>

                    <a href="{{ route('invoices.pdf', $invoice->id) }}"
                       target="_blank"
                       class="px-3 py-1 text-sm text-green-600 border border-green-300 rounded hover:bg-green-50">
                        PDF
                    </a>

                    <button wire:click="sendEmail({{ $invoice->id }})"
                            class="px-3 py-1 text-sm text-purple-600 border border-purple-300 rounded hover:bg-purple-50"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="sendEmail({{ $invoice->id }})">Email</span>
                        <span wire:loading wire:target="sendEmail({{ $invoice->id }})">Sending...</span>
                    </button>

                    <button wire:click="delete({{ $invoice->id }})"
                            onclick="return confirm('Are you sure you want to delete this invoice?')"
                            class="px-3 py-1 text-sm text-red-600 border border-red-300 rounded hover:bg-red-50"
                            wire:loading.attr="disabled">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="py-8 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-lg font-medium">No invoices found</p>
                <p class="text-sm">Create your first invoice to get started.</p>
            </div>
        @endforelse
    </div>

    <!-- Modal for Invoice Items using x-model -->
    <div x-show="$wire.showItemsModal"
         x-model="$wire.showItemsModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
         @click.self="$wire.showItemsModal = false">

        <div class="relative w-full max-w-4xl max-h-[90vh] bg-white rounded-lg shadow-xl overflow-hidden"
             @click.stop>

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-lg font-semibold">Invoice Items</h3>
                <button @click="$wire.showItemsModal = false"
                        class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-8rem)]">
                <div wire:loading.delay class="flex items-center justify-center py-8">
                    <svg class="w-6 h-6 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading invoice items...
                </div>

                <div wire:loading.remove>
                    @if($showItemsModal && $currentInvoiceId)
                        @livewire('invoice-items.manage-invoice-items', ['invoiceId' => $currentInvoiceId], key('invoice-items-modal-' . $currentInvoiceId . '-' . now()->timestamp))
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
