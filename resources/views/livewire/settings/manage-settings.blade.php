<div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Business & Payment Settings</h2>

    <form wire:submit="save" class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-1">Business Name</label>
            <input type="text" wire:model="business_name" class="border rounded px-3 py-2 w-full" placeholder="Business Name">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">PayPal Email</label>
            <input type="email" wire:model="paypal_email" class="border rounded px-3 py-2 w-full" placeholder="PayPal Email">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Settings</button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">{{ session('message') }}</div>
    @endif
</div>
