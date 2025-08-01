<?php
use function Livewire\Volt\{state};

state([
    'webDevSkills' => [
        ['name' => 'Laravel', 'level' => 70, 'icon' => 'https://raw.githubusercontent.com/devicons/devicon/1119b9f84c0290e0f0b38982099a2bd027a48bf1/icons/laravel/laravel-plain.svg'],
        ['name' => 'Vue.js', 'level' => 40, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg'],
        ['name' => 'PHP', 'level' => 70, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg'],
        ['name' => 'JavaScript', 'level' => 40, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg'],

        ['name' => 'Tailwind CSS', 'level' => 60, 'icon' => 'https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg'],
    ],
    'cloudSkills' => [
        ['name' => 'Microsoft Azure', 'level' => 60, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/azure/azure-original.svg'],
        ['name' => 'Cloud Architecture', 'level' => 75, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/googlecloud/googlecloud-original.svg'],
        ['name' => 'Serverless Computing', 'level' => 40, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/apache/apache-original.svg'],
        ['name' => 'Kubernetes', 'level' => 75, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/kubernetes/kubernetes-plain.svg'],
        ['name' => 'Docker', 'level' => 75, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg'],
        ['name' => 'Github', 'level' => 80, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg'],
    ],
    'certifications' => [
        'Microsoft Certified: Azure Fundamentals',
        'Microsoft Certified: Kebernetes and Cloud Native Associate',

    ],
]);
?>

<div class="container py-12 mx-auto animate-fade-in">
    <h2 class="mb-10 text-3xl font-bold text-center text-light-text-dark dark:text-white">
        My Skills
    </h2>

    <div class="space-y-12">
        <!-- Web Development Skills -->
        <div>
            <h3 class="mb-6 text-2xl font-semibold text-light-text-dark dark:text-white">
                Web Development Skills
            </h3>
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($webDevSkills as $skill)
                    <div class="flex items-center mb-4 animate-slide-up space-x-4">
                        <img src="{{ $skill['icon'] }}" alt="{{ $skill['name'] }}" class="w-8 h-8">
                        <div class="flex-grow">
                            <div class="flex justify-between mb-2">
                                <span class="text-light-text-muted dark:text-dark-text-muted">
                                    {{ $skill['name'] }}
                                </span>
                                <span class="text-light-text-muted dark:text-dark-text-muted">
                                    {{ $skill['level'] }}%
                                </span>
                            </div>
                            <div class="w-full bg-light-secondary dark:bg-dark-secondary rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-green-400 to-blue-500 h-2.5 rounded-full"
                                    style="width: {{ $skill['level'] }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cloud & DevOps Skills -->
        <div>
            <h3 class="mb-6 text-2xl font-semibold text-light-text-dark dark:text-white">
                Cloud & DevOps Skills
            </h3>
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($cloudSkills as $skill)
                    <div class="flex items-center mb-4 animate-slide-up space-x-4">
                        <img src="{{ $skill['icon'] }}" alt="{{ $skill['name'] }}" class="w-8 h-8">
                        <div class="flex-grow">
                            <div class="flex justify-between mb-2">
                                <span class="text-light-text-muted dark:text-dark-text-muted">
                                    {{ $skill['name'] }}
                                </span>
                                <span class="text-light-text-muted dark:text-dark-text-muted">
                                    {{ $skill['level'] }}%
                                </span>
                            </div>
                            <div class="w-full bg-light-secondary dark:bg-dark-secondary rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-purple-400 to-pink-500 h-2.5 rounded-full"
                                    style="width: {{ $skill['level'] }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Certifications -->
        <div>
            <h3 class="mb-6 text-2xl font-semibold text-light-text-dark dark:text-white">
                Certifications
            </h3>
            <ul class="list-disc pl-6 text-light-text-muted dark:text-dark-text-muted">
                @foreach ($certifications as $certification)
                    <li class="mb-2">
                        {{ $certification }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
