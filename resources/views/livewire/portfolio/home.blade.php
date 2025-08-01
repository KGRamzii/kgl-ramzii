<?php
use function Livewire\Volt\{state, computed};

state([
    'name' => 'Kagiso Ramogayana',
    'role' => 'Full Stack Developer',
    'highlights' => [
        'Expertise in building scalable web applications',
        'Cloud-native development with Azure',
        'Strong focus on performance and user experience',
        'Continuous learning and technology innovation',
        'Proficient in Adobe Creative Suite (Photoshop, Illustrator, After Effects)',
        'Creating visually appealing graphics and layouts',
        'Designing responsive and user-friendly interfaces',
    ],
    'certifications' => [
        'Microsoft Azure Fundamentals (AZ-900)',
        'Kubernetes and Cloud Native Associate (KCNA)',

        // Add more certifications
    ],
    'socialLinks' => [
        'github' => 'https://github.com/KGRamzii',
        'linkedin' => 'https://linkedin.com/in/kagiso-ramogayana-15a6921a0',
        'email' => 'mailto:kagiso1382@gmail.com?subject=Hello&body=I%20wanted%20to%20reach%20out...',
        // 'whatsapp' => 'https://wa.me/27817342820?text=Hello%20there!',

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

                        @case('whatsapp')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
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
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black bg-opacity-50">
        <div class="relative w-11/12 max-w-4xl mx-auto my-6 bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <!-- Close Button -->
            <button
                wire:click="closeCvModal"
                class="absolute text-gray-600 dark:text-red-600 top-4 right-4 hover:text-gray-900 dark:hover:text-white z-60"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- PDF Viewer -->
            <div class="p-4">
                <div class="w-full overflow-hidden rounded-lg">
                    <iframe
                        src="{{ asset('CV/KagisoCV1.pdf') }}"
                        class="w-full h-[calc(100vh-200px)] min-h-[300px] border-none"
                        style="max-height: 600px;"
                    ></iframe>
                </div>
            </div>

            <!-- Download Button -->
            <div class="flex justify-center p-4">
                <a
                    href="{{ asset('CV/KagisoCV1.pdf') }}"
                    download
                    class="inline-flex items-center px-6 py-3 text-white transition bg-blue-500 rounded-lg hover:bg-blue-600 dark:bg-dark-accent dark:hover:bg-dark-accent-dark"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download CV
                </a>
            </div>
        </div>
    </div>
@endif
</div>
