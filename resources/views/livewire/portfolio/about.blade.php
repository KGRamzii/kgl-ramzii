<?php
use function Livewire\Volt\{state};

state([
    'bio' => 'I am a dedicated Full Stack Developer with a passion for creating innovative and efficient web solutions. With extensive experience in modern web technologies, I transform complex problems into elegant, user-friendly applications.',
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
        ['name' => 'Microsoft Certified: Azure Fundamentals', 'icon' => 'https://learn.microsoft.com/en-us/media/learn/certification/badges/microsoft-certified-fundamentals-badge.svg'],
    ],
]);
?>

<div class="container py-12 mx-auto">
    <div class="grid items-center gap-8 md:grid-cols-2">
        <!-- Bio Section -->
        <div>
            <h2 class="mb-6 text-3xl font-bold text-light-text-dark dark:text-white">
                About Me
            </h2>
            <p class="leading-relaxed text-light-text-muted dark:text-dark-text-muted mb-6">
                {{ $bio }}
            </p>
            <div class="mb-4">
                <h3 class="text-xl font-semibold text-light-text-dark dark:text-white">
                    Personal Details
                </h3>
                <ul class="space-y-2 text-light-text-muted dark:text-dark-text-muted">
                    @foreach ($personalDetails as $key => $value)
                        <li>
                            <strong>{{ $key }}:</strong> {{ $value }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-4">
                <h3 class="text-xl font-semibold text-light-text-dark dark:text-white">
                    Key Strengths
                </h3>
                <ul class="space-y-2 text-light-text-muted dark:text-dark-text-muted">
                    @foreach ($keyStrengths as $strength)
                        <li class="flex items-center space-x-2">
                            <span class="text-green-500">&#10003;</span>
                            <span>{{ $strength }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex space-x-4">

                <a href="#" wire:click.prevent="$parent.setTab('contact')"
                class="px-6 py-3 transition border rounded-lg border-light-text-muted dark:border-dark-accent text-light-text-muted dark:text-white hover:bg-light-text-muted dark:hover:bg-dark-accent hover:text-white">
                Contact Me
            </a>
            </div>

        </div>

        <!-- Image Section -->
        <div class="relative flex justify-center">
            <div class="w-64 h-64 overflow-hidden rounded-full shadow-lg bg-gradient-to-br from-green-400 to-blue-500">
                <img src="{{ asset('Picture/Kagiso.png') }}" alt="Kagiso Ramogayana"
                    class="object-cover object-top w-full h-full transform transition duration-300 hover:scale-110" />
            </div>
        </div>
        <div >
                <h3 class="mb-6 text-2xl font-semibold text-light-text-dark dark:text-white">
                    Certifications
                </h3>
                <ul class="list-none pl-0 text-light-text-muted dark:text-dark-text-muted space-y-4">
                    @foreach ($certifications as $certification)
                        <li class="flex items-center space-x-4">
                            <img src="{{ $certification['icon'] }}" alt="{{ $certification['name'] }}" class="w-20 h-20">
                            <span>{{ $certification['name'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
    </div>
</div>
