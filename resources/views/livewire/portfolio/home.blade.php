<?php
use function Livewire\Volt\{state, computed};

state([
    'name' => 'Kagiso Ramogayana',
    'role' => 'Full Stack Developer',
    'highlights' => ['Expertise in building scalable web applications', 'Cloud-native development with Azure and AWS', 'Strong focus on performance and user experience', 'Continuous learning and technology innovation'],
    'certifications' => [
        'Microsoft Azure Fundamentals (AZ-900)',
        'Laravel Certified Developer',
        // Add more certifications
    ],
    'socialLinks' => [
        'github' => 'https://github.com/KGRamzii',
        'linkedin' => 'https://linkedin.com/in/kagiso-ramogayana-15a6921a0',
        'email' => 'kagiso1382@gmail.com',
    ],
    'showCvModal' => false, // New state for CV modal
]);

// CV Modal methods
$openCvModal = fn() => ($this->showCvModal = true);
$closeCvModal = fn() => ($this->showCvModal = false);
?>

<div class="py-16 text-center animate-fade-in">
    <div class="container max-w-4xl px-4 mx-auto">
        <div class="mb-12">
            <h1 class="mb-4 text-4xl font-bold text-light-text-dark dark:text-white md:text-5xl animate-slide-up">
                {{ $name }}
            </h1>
            <p class="mb-6 text-xl delay-100 text-light-text-muted dark:text-dark-text-muted animate-slide-up">
                {{ $role }}
            </p>

            <div class="mb-8 space-y-4 text-left delay-200 animate-slide-up">
                <h2 class="text-2xl font-semibold text-light-text-dark dark:text-white">
                    Professional Highlights
                </h2>
                <ul class="pl-5 list-disc text-light-text-muted dark:text-dark-text-muted">
                    @foreach ($highlights as $highlight)
                        <li>{{ $highlight }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-8 space-y-4 text-left delay-300 animate-slide-up">
                <h2 class="text-2xl font-semibold text-light-text-dark dark:text-white">
                    Certifications
                </h2>
                <ul class="pl-5 list-disc text-light-text-muted dark:text-dark-text-muted">
                    @foreach ($certifications as $certification)
                        <li>{{ $certification }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="flex justify-center mb-8 space-x-4 animate-slide-up delay-400">
            @foreach ($socialLinks as $platform => $link)
                <a href="{{ $link }}" target="_blank" aria-label="{{ ucfirst($platform) }} Profile"
                    class="transition-colors text-light-text-dark dark:text-white hover:text-light-accent dark:hover:text-dark-accent">
                    @switch($platform)
                        @case('github')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
                            </svg>
                        @break

                        @case('linkedin')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                <rect x="2" y="9" width="4" height="12" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                        @break

                        @case('email')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        @break
                    @endswitch
                </a>
            @endforeach
        </div>

        <div class="flex justify-center space-x-4 delay-500 animate-slide-up">
            <button wire:click="openCvModal"
                class="px-6 py-3 text-white transition rounded-lg bg-light-text-muted dark:bg-dark-accent hover:opacity-90">
                View CV
            </button>
            <a href="#" wire:click.prevent="$parent.setTab('contact')"
                class="px-6 py-3 transition border rounded-lg border-light-text-muted dark:border-dark-accent text-light-text-muted dark:text-white hover:bg-light-text-muted dark:hover:bg-dark-accent hover:text-white">
                Contact Me
            </a>
        </div>
    </div>
    {{-- CV Modal --}}
    @if ($showCvModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
            <div class="relative w-11/12 max-w-4xl mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <button wire:click="closeCvModal"
                    class="absolute text-gray-600 dark:text-red-600 top-4 right-4 hover:text-gray-900 dark:hover:text-white z-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="p-4">
                    <iframe src="{{ asset('CV/KagisoCV.pdf') }}" width="100%" height="600px"
                        class="border-none"></iframe>
                </div>

                <div class="flex justify-center p-4">
                    <a href="{{ asset('CV/KagisoCV.pdf') }}" download
                        class="inline-flex items-center px-6 py-3 text-white transition bg-blue-500 rounded-lg hover:bg-blue-600 dark:bg-dark-accent dark:hover:bg-dark-accent-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download CV
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
