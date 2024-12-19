<?php

use function Livewire\Volt\{state, computed};
use Illuminate\Support\Facades\Mail;

state([
    'name' => '',
    'email' => '',
    'message' => '',
    'submitted' => false,
    'error' => null,
]);

$submit = function () {
    $validated = $this->validate([
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|max:100',
        'message' => 'required|min:10|max:500',
    ]);

    try {
        // Replace with your actual Slack webhook URL
        $slackWebhookUrl = env('SLACK_HOOK');

        // Send message to Slack
        $slackResponse = Http::post($slackWebhookUrl, [
            'blocks' => [
                [
                    'type' => 'section',
                    'block_id' => 'section-1',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => '*New Contact Form Submission*',
                        ],
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Name:*\n{$this->name}",
                        ],
                    ],
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Email:*\n{$this->email}",
                        ],
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Message:*\n{$this->message}",
                        ],
                    ],
                ],
                [
                    'type' => 'divider',
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => ':incoming_envelope: *New contact form received!*',
                        ],
                    ],
                ],
            ],
        ]);

        // Optional: Send email notification
        // Mail::to('your-admin-email@example.com')->send(new ContactFormSubmission($this->name, $this->email, $this->message));

        $this->submitted = true;
        $this->reset(['name', 'email', 'message']);
    } catch (\Exception $e) {
        // Log the error for admin review
        \Log::error('Contact form submission failed: ' . $e->getMessage());

        $this->error = match (true) {
            str_contains($e->getMessage(), 'connection') => 'Network error. Please check your internet connection.',
            default => 'Failed to send message. Please try again later.',
        };
    }
};

$resetForm = function () {
    $this->submitted = false;
    $this->error = null;
};
?>

<div class="container mx-auto py-12">
    <h2 class="text-3xl font-bold text-center mb-10
        text-light-text-dark
        dark:text-white">
        Contact Me
    </h2>

    @if ($submitted)
        <div
            class="max-w-lg mx-auto text-center
            bg-light-secondary
            dark:bg-dark-secondary
            p-8
            rounded-lg
            shadow-md">
            <h3 class="text-2xl font-bold mb-4
                text-light-text-dark
                dark:text-white">
                Message Sent Successfully!
            </h3>
            <p class="text-light-text-muted dark:text-dark-text-muted mb-6">
                Thank you for your message. I'll get back to you soon.
            </p>
            <button wire:click="resetForm"
                class="
                    bg-light-text-muted
                    dark:bg-dark-accent
                    text-white
                    px-6 py-3
                    rounded-lg
                    hover:opacity-90
                    transition">
                Send Another Message
            </button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="max-w-lg mx-auto">
            @if ($error)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ $error }}</span>
                </div>
            @endif

            <div class="mb-4">
                <label
                    class="block mb-2
                    text-light-text-muted
                    dark:text-dark-text-muted">
                    Name
                </label>
                <input type="text" wire:model="name"
                    class="w-full p-3
                        bg-light-secondary
                        dark:bg-dark-secondary
                        text-light-text-dark
                        dark:text-white
                        rounded-lg
                        focus:outline-none
                        focus:ring-2
                        focus:ring-light-text-muted
                        dark:focus:ring-dark-accent
                        @error('name') border-red-500 @enderror" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label
                    class="block mb-2
                    text-light-text-muted
                    dark:text-dark-text-muted">
                    Email
                </label>
                <input type="email" wire:model="email"
                    class="w-full p-3
                        bg-light-secondary
                        dark:bg-dark-secondary
                        text-light-text-dark
                        dark:text-white
                        rounded-lg
                        focus:outline-none
                        focus:ring-2
                        focus:ring-light-text-muted
                        dark:focus:ring-dark-accent
                        @error('email') border-red-500 @enderror" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label
                    class="block mb-2
                    text-light-text-muted
                    dark:text-dark-text-muted">
                    Message
                </label>
                <textarea wire:model="message" rows="5"
                    class="w-full p-3
                        bg-light-secondary
                        dark:bg-dark-secondary
                        text-light-text-dark
                        dark:text-white
                        rounded-lg
                        focus:outline-none
                        focus:ring-2
                        focus:ring-light-text-muted
                        dark:focus:ring-dark-accent
                        @error('message') border-red-500 @enderror"></textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit"
                    class="
                        bg-light-text-muted
                        dark:bg-dark-accent
                        text-white
                        px-6 py-3
                        rounded-lg
                        hover:opacity-90
                        transition
                        w-full">
                    Send Message
                </button>
            </div>
        </form>
    @endif
</div>
