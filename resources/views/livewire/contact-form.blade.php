<div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Contact Me</h2>
    <form wire:submit="submit" class="space-y-4">
        <div>
            <input type="text" wire:model="name" class="border rounded px-3 py-2 w-full" placeholder="Your Name" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <input type="email" wire:model="email" class="border rounded px-3 py-2 w-full" placeholder="Your Email" required>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <input type="text" wire:model="phone" class="border rounded px-3 py-2 w-full" placeholder="Phone (optional)">
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <textarea wire:model="message" class="border rounded px-3 py-2 w-full" placeholder="Your Message" rows="4" required></textarea>
            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Send Message</button>
    </form>
    @if (session()->has('message'))
        <div class="mt-4 text-green-600">{{ session('message') }}</div>
    @endif
</div>
