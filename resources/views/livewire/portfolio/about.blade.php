<?php
use function Livewire\Volt\{state};

state([
    'bio' => 'I am a dedicated Full Stack Developer with a passion for creating innovative and efficient web solutions. I specialize in turning complex problems into elegant, user-friendly applications using modern web technologies.',
    'personalDetails' => [
        'Name' => 'Kagiso Ramogayana',
        'Email' => 'kagiso1382@gmail.com',
        'Location' => 'South Africa',
    ],
    'keyStrengths' => [
        'Problem-Solving',
        'Team Collaboration',
        'Agile Development',
        'Attention to Detail',
    ],
    'certifications' => [
        ['name' => 'Kubernetes and Cloud Native Associate (KCNA)', 'icon' => 'https://www.cncf.io/wp-content/uploads/2021/09/kcna_color.svg'],
        ['name' => 'Microsoft Certified: Azure Fundamentals (AZ900)', 'icon' => 'https://learn.microsoft.com/en-us/media/learn/certification/badges/microsoft-certified-fundamentals-badge.svg'],
    ],
    'socialLinks' => [
        'github' => 'https://github.com/KGRamzii',
        'linkedin' => 'https://linkedin.com/in/kagiso-ramogayana-15a6921a0',
        'email' => 'mailto:kagiso1382@gmail.com?subject=Hello&body=I%20wanted%20to%20reach%20out...',
        'whatsapp' => 'https://wa.me/27817342820?text=Hello%20there!',
    ],
]);
?>

<div class="relative py-8 overflow-hidden sm:py-12 animate-fade-in">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid gap-8 md:gap-12 md:grid-cols-2">

            <!-- Left Column -->
            <div class="space-y-8">

                <!-- About Me -->
                <div class="p-6 shadow-md sm:p-8 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl sm:shadow-xl animate-slide-up">
                    <h2 class="mb-3 text-2xl font-bold text-gray-900 sm:text-3xl dark:text-white">
                        About Me
                    </h2>
                    <p class="text-sm leading-relaxed text-gray-700 dark:text-gray-300 sm:text-base">
                        {{ $bio }}
                    </p>
                </div>

                <!-- Personal Details -->
                <div class="p-6 shadow-md sm:p-8 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl sm:shadow-xl animate-slide-up">
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 sm:text-xl dark:text-white">
                        Personal Details
                    </h3>
                    <ul class="space-y-2">
                        @foreach ($personalDetails as $key => $value)
                            <li class="flex justify-between px-3 py-2 text-sm transition bg-gray-100 rounded-lg shadow-sm sm:text-base dark:bg-gray-800 hover:shadow-md animate-slide-up"
                                style="animation-delay: {{ 250 + ($loop->index * 50) }}ms;">
                                <span class="font-medium">{{ $key }}</span>
                                <span>{{ $value }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Key Strengths -->
                <div class="p-6 shadow-md sm:p-8 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl sm:shadow-xl animate-slide-up">
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 sm:text-xl dark:text-white">
                        Key Strengths
                    </h3>
                    <ul class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                        @foreach ($keyStrengths as $strength)
                            <li class="flex items-center gap-2 px-3 py-2 text-sm sm:text-base font-medium transition rounded-lg bg-green-50 dark:bg-green-900/30 hover:scale-[1.02] shadow-sm animate-slide-up"
                                style="animation-delay: {{ 350 + ($loop->index * 50) }}ms;">
                                <span class="text-green-500">&#10003;</span>
                                <span>{{ $strength }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Button -->
                <div class="flex flex-col gap-3 sm:flex-row animate-slide-up">
                    <a href="#" wire:click.prevent="$parent.setTab('contact')"
                       class="flex-1 px-4 py-3 text-sm sm:text-base font-semibold text-center text-white transition rounded-lg shadow-md bg-indigo-600 hover:bg-indigo-700 hover:scale-[1.02]">
                        Contact Me
                    </a>
                </div>

            </div>

            <!-- Right Column -->
            <div class="flex flex-col items-center space-y-8 sm:space-y-12">

                <!-- Profile Image -->
                <div class="overflow-hidden rounded-full shadow-xl w-36 h-36 sm:w-52 sm:h-52 bg-gradient-to-br from-indigo-400 to-blue-500 animate-slide-up">
                    <img src="{{ asset('Picture/Kagiso.png') }}" alt="Kagiso Ramogayana"
                         class="object-cover object-top w-full h-full transition duration-300 transform rounded-full hover:scale-105" />
                </div>

                <!-- Social Links -->
                <div class="flex flex-wrap justify-center gap-4 animate-slide-up">
                    @foreach ($socialLinks as $platform => $link)
                        <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                           aria-label="{{ ucfirst($platform) }} Profile"
                           class="relative p-3 transition-all duration-300 bg-white border border-gray-200 shadow-sm sm:p-4 group dark:bg-gray-800 rounded-xl hover:shadow-md dark:border-gray-700 hover:scale-105">

                            <!-- Icon -->
                            <div class="text-gray-700 transition-colors duration-200 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                @switch($platform)
                                    @case('github')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" /></svg>
                                    @break
                                    @case('linkedin')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" /><rect x="2" y="9" width="4" height="12" /><circle cx="4" cy="4" r="2" /></svg>
                                    @break
                                    @case('email')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" /><polyline points="22,6 12,13 2,6" /></svg>
                                    @break
                                    @case('whatsapp')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                             fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                                    @break
                                @endswitch
                            </div>

                            <!-- Tooltip -->
                            <div class="absolute px-2 py-1 text-xs text-white transition-opacity duration-200 transform -translate-x-1/2 bg-gray-900 rounded-lg opacity-0 pointer-events-none sm:text-sm -top-10 left-1/2 dark:bg-gray-700 group-hover:opacity-100 whitespace-nowrap">
                                {{ ucfirst($platform) }}
                                <div class="absolute transform -translate-x-1/2 border-4 border-transparent top-full left-1/2 border-t-gray-900 dark:border-t-gray-700"></div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Certifications -->
                <div class="w-full p-6 shadow-md sm:p-8 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl sm:shadow-xl animate-slide-up">
                    <h3 class="mb-4 text-xl font-semibold text-center text-gray-900 sm:text-2xl md:text-left dark:text-white">
                        Certifications
                    </h3>
                    <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach ($certifications as $certification)
                            <li class="flex items-center gap-3 p-3 text-sm sm:text-base transition transform bg-gray-100 rounded-lg shadow-sm dark:bg-gray-800 hover:shadow-md hover:-translate-y-0.5 animate-slide-up">
                                <img src="{{ $certification['icon'] }}" alt="{{ $certification['name'] }}" class="w-12 h-12 sm:w-14 sm:h-14">
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $certification['name'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
