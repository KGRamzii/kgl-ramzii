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
        ['name' => 'Kubernetes and Cloud Native Associate (KCNA)', 'icon' => 'https://www.cncf.io/wp-content/uploads/2021/09/kcna_color.svg'],
        ['name' => 'Microsoft Certified: Azure Fundamentals (AZ900)', 'icon' => 'https://learn.microsoft.com/en-us/media/learn/certification/badges/microsoft-certified-fundamentals-badge.svg'],


    ],
]);
?>

<div class="container py-12 mx-auto">
    <div class="grid gap-12 md:grid-cols-2">
        <!-- Left Column: Bio & Details -->
        <div class="space-y-8">
            <!-- About Me -->
            <div>
                <h2 class="mb-4 text-3xl font-bold text-light-text-dark dark:text-white">
                    About Me
                </h2>
                <p class="leading-relaxed text-light-text-muted dark:text-dark-text-muted">
                    {{ $bio }}
                </p>
            </div>

            <!-- Personal Details -->
            <div>
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

            <!-- Key Strengths -->
            <div>
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

            <!-- Contact Button -->
            <div>
                <a href="#" wire:click.prevent="$parent.setTab('contact')"
                   class="inline-block px-6 py-3 transition border rounded-lg border-light-text-muted dark:border-dark-accent text-light-text-muted dark:text-white hover:bg-light-text-muted dark:hover:bg-dark-accent hover:text-white">
                    Contact Me
                </a>
            </div>
        </div>

        <!-- Right Column: Image & Certifications -->
        <div class="flex flex-col items-center space-y-12">
            <!-- Profile Image -->
            <div class="w-64 h-64 overflow-hidden rounded-full shadow-lg bg-gradient-to-br from-green-400 to-blue-500">
                <img src="{{ asset('Picture/Kagiso.png') }}" alt="Kagiso Ramogayana"
                     class="object-cover object-top w-full h-full transition duration-300 transform hover:scale-110" />
            </div>

            <!-- Certifications -->
            <div class="w-full">
                <h3 class="mb-6 text-2xl font-semibold text-center text-light-text-dark dark:text-white md:text-left">
                    Certifications
                </h3>
                <ul class="space-y-4 text-light-text-muted dark:text-dark-text-muted">
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
</div>

