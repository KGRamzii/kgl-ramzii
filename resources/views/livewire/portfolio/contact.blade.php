<?php

use function Livewire\Volt\{state, computed};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

state([
    'name' => '',
    'email' => '',
    'message' => '',
    'submitted' => false,
    'error' => null,
    'isLoading' => false,
    'messageLength' => 0,
]);

computed(function () {
    return strlen($this->message);
});

$submit = function () {
    $this->isLoading = true;

    $validated = $this->validate([
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|max:100',
        'message' => 'required|min:10|max:500',
    ]);

    try {
        $slackWebhookUrl = env('SLACK_HOOK');

        Http::post($slackWebhookUrl, [
            'blocks' => [
                [
                    'type' => 'section',
                    'block_id' => 'section-1',
                    'fields' => [
                        ['type' => 'mrkdwn', 'text' => '*New Contact Form Submission*'],
                        ['type' => 'mrkdwn', 'text' => "*Name:*\n{$this->name}"],
                    ],
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        ['type' => 'mrkdwn', 'text' => "*Email:*\n{$this->email}"],
                        ['type' => 'mrkdwn', 'text' => "*Message:*\n{$this->message}"],
                    ],
                ],
                ['type' => 'divider'],
                [
                    'type' => 'section',
                    'fields' => [
                        ['type' => 'mrkdwn', 'text' => ':incoming_envelope: *New contact form received!*'],
                    ],
                ],
            ],
        ]);

        $this->submitted = true;
        $this->reset(['name', 'email', 'message']);
    } catch (\Exception $e) {
        \Log::error('Contact form submission failed: ' . $e->getMessage());

        $this->error = str_contains($e->getMessage(), 'connection')
            ? 'Network error. Please check your internet connection.'
            : 'Failed to send message. Please try again later.';
    } finally {
        $this->isLoading = false;
    }
};

$resetForm = function () {
    $this->submitted = false;
    $this->error = null;
};
?>

<div class="container mx-auto py-12 animate-fade-in">
    <h2 class="text-3xl font-bold text-center mb-4 text-light-text-dark dark:text-white">
        Contact Me
    </h2>
    <p class="text-center mb-10 text-light-text-muted dark:text-dark-text-muted max-w-2xl mx-auto">
        Have a question or want to work together? Feel free to reach out using the form below
        or connect with me directly through social media.
    </p>

    @if ($submitted)
        <div class="max-w-lg mx-auto text-center bg-light-secondary dark:bg-dark-secondary p-8 rounded-lg shadow-md animate-fade-up">
            <svg class="w-16 h-16 mx-auto mb-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-2xl font-bold mb-4 text-light-text-dark dark:text-white">
                Message Sent Successfully!
            </h3>
            <p class="text-light-text-muted dark:text-dark-text-muted mb-6">
                Thank you for reaching out. I'll get back to you as soon as possible.
            </p>
            <button wire:click="resetForm"
                class="bg-light-text-muted dark:bg-dark-accent text-white px-6 py-3 rounded-lg hover:opacity-90 transition">
                Send Another Message
            </button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="max-w-lg mx-auto">
            @if ($error)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $error }}</span>
                </div>
            @endif

            <div class="mb-4">
                <label class="block mb-2 text-light-text-muted dark:text-dark-text-muted">Name</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-light-text-muted dark:text-dark-text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <input type="text" wire:model="name"
                        class="w-full pl-10 p-3 bg-light-secondary dark:bg-dark-secondary text-light-text-dark dark:text-white rounded-lg
                            focus:outline-none focus:ring-2 focus:ring-light-text-muted dark:focus:ring-dark-accent
                            @error('name') border-red-500 @enderror" />
                </div>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-light-text-muted dark:text-dark-text-muted">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-light-text-muted dark:text-dark-text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <input type="email" wire:model="email"
                        class="w-full pl-10 p-3 bg-light-secondary dark:bg-dark-secondary text-light-text-dark dark:text-white rounded-lg
                            focus:outline-none focus:ring-2 focus:ring-light-text-muted dark:focus:ring-dark-accent
                            @error('email') border-red-500 @enderror" />
                </div>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-light-text-muted dark:text-dark-text-muted">Message</label>
                <div class="relative">
                    <textarea wire:model.live="message" rows="5"
                        class="w-full p-3 bg-light-secondary dark:bg-dark-secondary text-light-text-dark dark:text-white rounded-lg
                            focus:outline-none focus:ring-2 focus:ring-light-text-muted dark:focus:ring-dark-accent
                            @error('message') border-red-500 @enderror"></textarea>
                    <div class="absolute bottom-2 right-2 text-sm text-light-text-muted dark:text-dark-text-muted">
                        {{ strlen($message) }}/500
                    </div>
                </div>
                @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-light-text-muted dark:bg-dark-accent text-white px-6 py-3 rounded-lg hover:opacity-90 transition w-full relative"
                    wire:target="submit"
                    wire:loading.class="opacity-75 cursor-not-allowed"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="submit">Send Message</span>
                    <span wire:loading wire:target="submit" class="inline-flex items-center justify-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sending...
                    </span>
                </button>
            </div>
        </form>
    @endif
</div>
