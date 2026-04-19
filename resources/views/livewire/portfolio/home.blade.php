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
        ['name' => 'Kubernetes and Cloud Native Associate (KCNA)', 'icon' => 'images/badges/kcna.svg'],
        ['name' => 'Microsoft Certified: Azure Fundamentals (AZ900)', 'icon' => 'images/badges/az900.svg'],
    ],
    'socialLinks' => [
        'github' => 'https://github.com/KGRamzii',
        'linkedin' => 'https://linkedin.com/in/kagiso-ramogayana-15a6921a0',
        'email' => 'mailto:kagiso1382@gmail.com?subject=Hello&body=I%20wanted%20to%20reach%20out...',
        'whatsapp' => 'https://wa.me/27817342820?text=Hello%20there!',
    ],
    'cvPath' => 'CV/CV.pdf',
]);

$cvExists = computed(function () {
    return file_exists(public_path($this->cvPath));
});
?>

<div class="relative py-12 overflow-hidden animate-fade-in">
    <div class="container relative z-10 max-w-5xl px-6 mx-auto">

        <!-- Hero: photo + intro -->
        <div class="flex flex-col items-center gap-10 mb-14 md:flex-row md:items-center md:gap-14 animate-slide-up">

            <!-- Profile Photo -->
            <div class="flex-shrink-0">
                <div class="w-44 h-44 md:w-56 md:h-56 overflow-hidden rounded-full ring-4 ring-blue-500/40 dark:ring-blue-400/40 shadow-xl">
                    <img src="{{ asset('Picture/Kagiso.png') }}" alt="Kagiso Ramogayana"
                         class="object-cover object-top w-full h-full"
                         width="224" height="224">
                </div>
            </div>

            <!-- Name, role, social links, buttons -->
            <div class="flex-1 text-center md:text-left">
                <h1 class="mb-3 text-4xl font-bold leading-tight text-transparent bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 dark:from-white dark:via-blue-200 dark:to-purple-200 bg-clip-text md:text-5xl lg:text-6xl">
                    {{ $name }}
                </h1>

                <p class="mb-6 text-xl font-medium text-gray-600 dark:text-gray-300">
                    {{ $role }}
                </p>

                <!-- Social Links -->
                <div class="flex justify-center gap-3 mb-8 md:justify-start">
                    @foreach ($socialLinks as $platform => $link)
                        <a href="{{ $link }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="{{ ucfirst($platform) }} Profile"
                           class="relative p-3 transition-all duration-300 bg-white border border-gray-200 shadow-md group dark:bg-gray-800 rounded-xl hover:shadow-lg dark:border-gray-700 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-500/50"
                        >
                            <div class="text-gray-700 transition-colors duration-200 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                @switch($platform)
                                    @case('github')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
                                        </svg>
                                    @break
                                    @case('linkedin')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                            <rect x="2" y="9" width="4" height="12" />
                                            <circle cx="4" cy="4" r="2" />
                                        </svg>
                                    @break
                                    @case('email')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                    @break
                                    @case('whatsapp')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                    @break
                                @endswitch
                            </div>
                            <!-- Tooltip -->
                            <div class="absolute px-2 py-1 text-xs text-white transition-opacity duration-200 transform -translate-x-1/2 bg-gray-900 rounded-lg opacity-0 pointer-events-none -top-9 left-1/2 dark:bg-gray-700 group-hover:opacity-100 whitespace-nowrap">
                                {{ ucfirst($platform) }}
                                <div class="absolute transform -translate-x-1/2 border-4 border-transparent top-full left-1/2 border-t-gray-900 dark:border-t-gray-700"></div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col items-center gap-3 sm:flex-row md:items-start md:justify-start">
                    @if ($this->cvExists)
                        <flux:modal.trigger name="cv-modal">
                            <button class="inline-flex items-center px-6 py-3 font-semibold text-white transition-all duration-300 shadow-md bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                View CV
                            </button>
                        </flux:modal.trigger>
                    @endif

                    <button wire:click.prevent="$parent.setTab('contact')"
                        class="inline-flex items-center px-6 py-3 font-semibold text-gray-900 transition-all duration-300 bg-white border-2 border-gray-300 shadow-md group dark:bg-gray-800 dark:text-white dark:border-gray-600 rounded-xl hover:shadow-lg hover:scale-105 hover:border-blue-500 dark:hover:border-blue-400 focus:outline-none focus:ring-4 focus:ring-gray-500/50">
                        <svg class="w-5 h-5 mr-2 text-gray-600 transition-colors duration-200 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="transition-colors duration-200 group-hover:text-blue-600 dark:group-hover:text-blue-400">Contact Me</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Professional Highlights -->
        <div class="mb-8 animate-slide-up">
            <div class="p-8 border shadow-xl bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl border-gray-200/50 dark:border-gray-700/50">
                <h2 class="flex items-center mb-6 text-2xl font-bold text-gray-900 dark:text-white">
                    <svg class="w-6 h-6 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Professional Highlights
                </h2>
                <div class="grid gap-3 md:grid-cols-2">
                    @foreach ($highlights as $highlight)
                        <div class="flex items-start p-3 space-x-3 transition-colors duration-200 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <div class="flex-shrink-0 w-2 h-2 mt-2 bg-blue-500 rounded-full dark:bg-blue-400"></div>
                            <p class="leading-relaxed text-gray-700 dark:text-gray-300">{{ $highlight }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Certifications -->
        <div class="p-6 shadow-md sm:p-8 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl animate-slide-up">
            <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">
                Certifications
            </h3>
            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach ($certifications as $certification)
                    <li class="flex items-center gap-3 p-3 text-sm sm:text-base transition transform bg-gray-100 rounded-lg shadow-sm dark:bg-gray-800 hover:shadow-md hover:-translate-y-0.5">
                        <img src="{{ asset($certification['icon']) }}" alt="{{ $certification['name'] }}" class="w-12 h-12 sm:w-14 sm:h-14" loading="lazy">
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $certification['name'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    <!-- CV Modal -->
    <flux:modal name="cv-modal" class="md:w-4/5 lg:w-3/5">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $name }} - Curriculum Vitae</flux:heading>
                <flux:text class="mt-2">Preview and download your CV.</flux:text>
            </div>

            <div class="w-full overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-900 h-[70vh]">
                <iframe src="{{ asset($cvPath) }}"
                        class="w-full h-full border-none rounded-lg"
                        title="CV Preview"></iframe>
            </div>

            <div class="flex justify-end">
                <a href="{{ asset($cvPath) }}" download="{{ $name }}_CV.pdf">
                    <flux:button variant="primary" class="inline-flex items-center">
                        <flux:icon.arrow-down-tray class="w-5 h-5 mr-2" />
                        Download CV
                    </flux:button>
                </a>
            </div>
        </div>
    </flux:modal>
</div>
