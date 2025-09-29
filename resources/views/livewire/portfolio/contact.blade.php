<?php

use function Livewire\Volt\{state, computed, mount};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

state([
    'name' => '',
    'email' => '',
    'subject' => '',
    'message' => '',
    'submitted' => false,
    'error' => null,
    'isLoading' => false,
    'honeypot' => '', // Spam protection
    'contactInfo' => [
        'email' => 'kagiso1382@gmail.com',
        'phone' => '+27 81 734 2820',
        'location' => 'Johannesburg, South Africa',
        'timezone' => 'SAST (GMT+2)',
        'response_time' => 'Within 24 hours',
    ],
    'socialLinks' => [
        'github' => 'https://github.com/KGRamzii',
        'linkedin' => 'https://linkedin.com/in/kagiso-ramogayana-15a6921a0',
        'whatsapp' => 'https://wa.me/27817342820?text=Hello%20there!',
    ],
]);

// Computed properties
$messageLength = computed(fn() => strlen($this->message));
$isFormValid = computed(fn() =>
    !empty($this->name) &&
    !empty($this->email) &&
    !empty($this->message) &&
    filter_var($this->email, FILTER_VALIDATE_EMAIL) &&
    strlen($this->message) >= 10
);

mount(function () {
    // Initialize component
});

$submit = function () {
    // Honeypot check for spam
    if (!empty($this->honeypot)) {
        return; // Silent fail for bots
    }

    // Rate limiting
    $key = 'contact-form:' . request()->ip();
    if (RateLimiter::tooManyAttempts($key, 10)) {
        $this->error = 'Too many attempts. Please try again in a few minutes.';
        return;
    }

    RateLimiter::hit($key, 300); // 5 minutes

    $this->isLoading = true;
    $this->error = null;

    $validated = $this->validate([
        'name' => 'required|string|min:2|max:50|regex:/^[a-zA-Z\s]+$/',
        'email' => 'required|email:rfc,dns|max:100',
        'subject' => 'nullable|string|max:100',
        'message' => 'required|string|min:10|max:1000',
        'honeypot' => 'size:0', // Must be empty
    ], [
        'name.regex' => 'Name can only contain letters and spaces.',
        'email.email' => 'Please provide a valid email address.',
        'message.min' => 'Message must be at least 10 characters long.',
        'message.max' => 'Message cannot exceed 1000 characters.',
    ]);

    try {
        $slackWebhookUrl = env('SLACK_WEBHOOK');

        if (!$slackWebhookUrl) {
            throw new \Exception('Slack webhook URL not configured');
        }

        // Enhanced Slack payload
        $response = Http::timeout(10)->post($slackWebhookUrl, [
            'blocks' => [
                [
                    'type' => 'header',
                    'text' => [
                        'type' => 'plain_text',
                        'text' => '📧 New Contact Form Submission'
                    ]
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Name:*\n{$validated['name']}"
                        ],
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Email:*\n{$validated['email']}"
                        ]
                    ]
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Subject:*\n" . ($validated['subject'] ?: 'No subject provided')
                        ],
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Timestamp:*\n" . now()->format('Y-m-d H:i:s T')
                        ]
                    ]
                ],
                [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "*Message:*\n```{$validated['message']}```"
                    ]
                ],
                [
                    'type' => 'context',
                    'elements' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => "IP: " . request()->ip() . " | User Agent: " . request()->userAgent()
                        ]
                    ]
                ]
            ]
        ]);

        if (!$response->successful()) {
            throw new \Exception('Slack webhook failed: ' . $response->body());
        }

        // Log successful submission
        Log::info('Contact form submitted successfully', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'ip' => request()->ip()
        ]);

        $this->submitted = true;
        $this->reset(['name', 'email', 'subject', 'message', 'error']);

        // Clear rate limit on successful submission
        RateLimiter::clear($key);

    } catch (\Exception $e) {
        Log::error('Contact form submission failed', [
            'error' => $e->getMessage(),
            'email' => $this->email ?? 'unknown',
            'ip' => request()->ip()
        ]);

        $this->error = match(true) {
            str_contains($e->getMessage(), 'timeout') => 'Request timed out. Please try again.',
            str_contains($e->getMessage(), 'connection') => 'Connection error. Please check your internet connection.',
            str_contains($e->getMessage(), 'webhook') => 'Service temporarily unavailable. Please try again later.',
            default => 'Failed to send message. Please try again or contact me directly.'
        };
    } finally {
        $this->isLoading = false;
    }
};

$resetForm = function () {
    $this->submitted = false;
    $this->error = null;
    $this->reset(['name', 'email', 'subject', 'message']);
};

$fillDemoData = function () {
    $this->name = 'John Doe';
    $this->email = 'john.doe@example.com';
    $this->subject = 'Project Inquiry';
    $this->message = 'Hi Kagiso, I saw your portfolio and I\'m interested in discussing a potential project. Could we schedule a call this week?';
};
?>

<div class="container py-12 mx-auto animate-fade-in">
    <!-- Header Section -->
    <div class="mb-12 text-center">
        <h2 class="mb-4 text-4xl font-bold text-light-text-dark dark:text-white">
            Let's Work Together
        </h2>
        <p class="max-w-3xl mx-auto text-lg leading-relaxed text-light-text-muted dark:text-dark-text-muted">
            Have a project in mind or just want to say hello? I'd love to hear from you.
            Fill out the form below or reach out through any of the contact methods.
        </p>
    </div>

    <div class="max-w-6xl mx-auto">
        <div class="grid items-start gap-12 md:grid-cols-2">
            <!-- Contact Form -->
            <div class="order-2 md:order-1">
                @if ($submitted)
                    <div class="p-8 border border-green-200 shadow-lg bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl dark:border-green-800 animate-fade-up">
                        <div class="text-center">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-green-500 rounded-full">
                                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mb-4 text-2xl font-bold text-green-800 dark:text-green-300">
                                Message Sent Successfully!
                            </h3>
                            <p class="mb-6 leading-relaxed text-green-700 dark:text-green-400">
                                Thank you for reaching out! I've received your message and will get back to you within 24 hours.
                            </p>
                            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                                <button
                                    wire:click="resetForm"
                                    class="inline-flex items-center px-6 py-3 text-white transition-all duration-300 bg-green-500 rounded-lg hover:bg-green-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Send Another Message
                                </button>
                                <a
                                    href="mailto:{{ $contactInfo['email'] }}"
                                    class="inline-flex items-center px-6 py-3 text-green-600 transition-all duration-300 border-2 border-green-500 rounded-lg dark:text-green-400 hover:bg-green-500 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Email Directly
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-8 shadow-lg bg-light-card dark:bg-gray-800 rounded-2xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-semibold text-light-text-dark dark:text-white">
                                Send a Message
                            </h3>
                            @if (app()->environment('local'))
                                <button
                                    wire:click="fillDemoData"
                                    class="text-sm text-blue-500 transition-colors hover:text-blue-600"
                                    title="Fill demo data (development only)"
                                >
                                    Fill Demo
                                </button>
                            @endif
                        </div>

                        <form wire:submit="submit" class="space-y-6">
                            <!-- Honeypot field (hidden) -->
                            <input type="text" name="website" wire:model.live="honeypot" style="display:none;" tabindex="-1" autocomplete="off">

                            @if ($error)
                                <div class="flex items-center px-4 py-3 text-red-700 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:border-red-800 dark:text-red-400" role="alert">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $error }}</span>
                                </div>
                            @endif

                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-light-text-dark dark:text-white">
                                    Name <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-light-text-muted dark:text-dark-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        id="name"
                                        wire:model.live.blur="name"
                                        placeholder="Your full name"
                                        class="w-full pl-10 pr-4 py-3 bg-light-secondary dark:bg-dark-secondary text-light-text-dark dark:text-white rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 @error('name') border-red-500 focus:ring-red-500 @enderror"
                                        aria-describedby="name-error"
                                    />
                                </div>
                                @error('name')
                                    <p id="name-error" class="flex items-center mt-1 text-sm text-red-500">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-light-text-dark dark:text-white">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-light-text-muted dark:text-dark-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input
                                        type="email"
                                        id="email"
                                        wire:model.live.blur="email"
                                        placeholder="your.email@example.com"
                                        class="w-full pl-10 pr-4 py-3 bg-light-secondary dark:bg-dark-secondary text-light-text-dark dark:text-white rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 @error('email') border-red-500 focus:ring-red-500 @enderror"
                                        aria-describedby="email-error"
                                    />
                                </div>
                                @error('email')
                                    <p id="email-error" class="flex items-center mt-1 text-sm text-red-500">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Subject Field -->
                            <div>
                                <label for="subject" class="block mb-2 text-sm font-medium text-light-text-dark dark:text-white">
                                    Subject
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-light-text-muted dark:text-dark-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        id="subject"
                                        wire:model.live="subject"
                                        placeholder="What's this about? (optional)"
                                        class="w-full pl-10 pr-4 py-3 bg-light-secondary dark:bg-dark-secondary text-light-text-dark dark:text-white rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 @error('subject') border-red-500 focus:ring-red-500 @enderror"
                                    />
                                </div>
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message Field -->
                            <div>
                                <label for="message" class="block mb-2 text-sm font-medium text-light-text-dark dark:text-white">
                                    Message <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <textarea
                                        id="message"
                                        wire:model.live="message"
                                        rows="5"
                                        placeholder="Tell me about your project or just say hello..."
                                        class="w-full p-4 bg-light-secondary dark:bg-dark-secondary text-light-text-dark dark:text-white rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 resize-none @error('message') border-red-500 focus:ring-red-500 @enderror"
                                        aria-describedby="message-error message-counter"
                                    ></textarea>
                                    <div
                                        id="message-counter"
                                        class="absolute bottom-3 right-3 text-sm {{ $this->messageLength > 900 ? 'text-red-500' : ($this->messageLength > 700 ? 'text-yellow-500' : 'text-light-text-muted dark:text-dark-text-muted') }}"
                                    >
                                        {{ $this->messageLength }}/1000
                                    </div>
                                </div>
                                @error('message')
                                    <p id="message-error" class="flex items-center mt-1 text-sm text-red-500">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                class="relative w-full px-6 py-4 overflow-hidden font-medium text-white transition-all duration-300 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500/50 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 group"
                                wire:target="submit"
                                wire:loading.class="opacity-75 cursor-not-allowed"
                                wire:loading.attr="disabled"
                                :disabled="!$this->isFormValid || $isLoading"
                            >
                                <!-- Button Background Animation -->
                                <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-r from-purple-600 to-blue-500 group-hover:opacity-100"></div>

                                <span class="relative flex items-center justify-center">
                                    <span wire:loading.remove wire:target="submit" class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        Send Message
                                    </span>
                                    <span wire:loading wire:target="submit" class="flex items-center">
                                        <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Sending Message...
                                    </span>
                                </span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Contact Information -->
            <div class="order-1 space-y-8 md:order-2">
                <!-- Contact Details Card -->
                <div class="p-8 shadow-lg bg-light-card dark:bg-gray-800 rounded-2xl">
                    <h3 class="mb-6 text-2xl font-semibold text-light-text-dark dark:text-white">
                        Contact Information
                    </h3>
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-light-text-dark dark:text-white">Email</p>
                                <a href="mailto:{{ $contactInfo['email'] }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    {{ $contactInfo['email'] }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg dark:bg-green-900/30">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-light-text-dark dark:text-white">Phone</p>
                                <a href="tel:{{ str_replace(' ', '', $contactInfo['phone']) }}" class="text-green-600 dark:text-green-400 hover:underline">
                                    {{ $contactInfo['phone'] }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg dark:bg-purple-900/30">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-light-text-dark dark:text-white">Location</p>
                                <p class="text-light-text-muted dark:text-dark-text-muted">
                                    {{ $contactInfo['location'] }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg dark:bg-orange-900/30">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-light-text-dark dark:text-white">Response Time</p>
                                <p class="text-light-text-muted dark:text-dark-text-muted">
                                    {{ $contactInfo['response_time'] }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-indigo-100 rounded-lg dark:bg-indigo-900/30">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-light-text-dark dark:text-white">Timezone</p>
                                <p class="text-light-text-muted dark:text-dark-text-muted">
                                    {{ $contactInfo['timezone'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Links Card -->
                <div class="p-8 shadow-lg bg-light-card dark:bg-gray-800 rounded-2xl">
                    <h3 class="mb-6 text-xl font-semibold text-light-text-dark dark:text-white">
                        Connect on Social Media
                    </h3>
                    <div class="flex space-x-4">
                        @foreach ($socialLinks as $platform => $link)
                            <a
                                href="{{ $link }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center justify-center w-12 h-12 transition-all duration-300 rounded-lg bg-light-secondary dark:bg-dark-secondary text-light-text-dark dark:text-white hover:scale-110 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                title="{{ ucfirst($platform) }}"
                            >
                                @switch($platform)
                                    @case('github')
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
                                        </svg>
                                    @break

                                    @case('linkedin')
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd" />
                                        </svg>
                                    @break

                                    @case('whatsapp')
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                    @break
                                @endswitch
                            </a>
                        @endforeach
                    </div>
                    <p class="mt-4 text-sm text-light-text-muted dark:text-dark-text-muted">
                        Feel free to connect with me on any of these platforms for quick messages or professional networking.
                    </p>
                </div>

                <!-- Quick Contact Options -->
                <div class="p-6 border border-blue-200 bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/10 dark:to-purple-900/10 rounded-2xl dark:border-blue-800/30">
                    <h4 class="mb-4 font-semibold text-light-text-dark dark:text-white">
                        Prefer Direct Contact?
                    </h4>
                    <div class="space-y-3">
                        <a
                            href="mailto:{{ $contactInfo['email'] }}?subject=Project Inquiry&body=Hi Kagiso,%0D%0A%0D%0AI'd like to discuss a potential project with you.%0D%0A%0D%0ABest regards"
                            class="flex items-center p-3 transition-all duration-300 bg-white rounded-lg shadow-sm dark:bg-gray-800 hover:shadow-md hover:scale-105 group"
                        >
                            <div class="flex items-center justify-center w-10 h-10 mr-3 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-light-text-dark dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                    Send Email
                                </p>
                                <p class="text-sm text-light-text-muted dark:text-dark-text-muted">
                                    Opens your email client
                                </p>
                            </div>
                        </a>

                        <a
                            href="{{ $socialLinks['whatsapp'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center p-3 transition-all duration-300 bg-white rounded-lg shadow-sm dark:bg-gray-800 hover:shadow-md hover:scale-105 group"
                        >
                            <div class="flex items-center justify-center w-10 h-10 mr-3 bg-green-100 rounded-lg dark:bg-green-900/30">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-light-text-dark dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400">
                                    WhatsApp Chat
                                </p>
                                <p class="text-sm text-light-text-muted dark:text-dark-text-muted">
                                    Quick and convenient
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
