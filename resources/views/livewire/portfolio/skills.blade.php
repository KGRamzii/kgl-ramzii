<?php
use function Livewire\Volt\{state, computed, mount};

state([
    'webDevSkills' => [
        ['name' => 'Laravel', 'level' => 70, 'icon' => 'https://raw.githubusercontent.com/devicons/devicon/1119b9f84c0290e0f0b38982099a2bd027a48bf1/icons/laravel/laravel-plain.svg', 'category' => 'Backend'],
        ['name' => 'Vue.js', 'level' => 40, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'category' => 'Frontend'],
        ['name' => 'PHP', 'level' => 70, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg', 'category' => 'Backend'],
        ['name' => 'JavaScript', 'level' => 40, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg', 'category' => 'Frontend'],
        ['name' => 'Tailwind CSS', 'level' => 60, 'icon' => 'https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg', 'category' => 'Frontend'],
    ],
    'cloudSkills' => [
        ['name' => 'Microsoft Azure', 'level' => 60, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/azure/azure-original.svg', 'category' => 'Cloud Platform'],
        ['name' => 'Cloud Architecture', 'level' => 75, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/googlecloud/googlecloud-original.svg', 'category' => 'Architecture'],
        ['name' => 'Serverless Computing', 'level' => 40, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/apache/apache-original.svg', 'category' => 'Architecture'],
        ['name' => 'Kubernetes', 'level' => 75, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/kubernetes/kubernetes-plain.svg', 'category' => 'Container Orchestration'],
        ['name' => 'Docker', 'level' => 75, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg', 'category' => 'Containerization'],
        ['name' => 'GitHub', 'level' => 80, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg', 'category' => 'Version Control'],
    ],
    'designSkills' => [
        ['name' => 'Adobe Photoshop', 'level' => 65, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/photoshop/photoshop-plain.svg', 'category' => 'Design'],
        ['name' => 'Adobe Illustrator', 'level' => 60, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/illustrator/illustrator-plain.svg', 'category' => 'Design'],
        ['name' => 'Adobe After Effects', 'level' => 45, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/aftereffects/aftereffects-original.svg', 'category' => 'Motion Graphics'],
        ['name' => 'Figma', 'level' => 50, 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg', 'category' => 'UI/UX'],
    ],
    'certifications' => [
        [
            'name' => 'Microsoft Certified: Azure Fundamentals',
            'issuer' => 'Microsoft',
            'date' => '2024',
            'credential_id' => 'AZ-900',
            'badge' => 'https://images.credly.com/size/340x340/images/be8fcaeb-c769-4858-b567-ffaaa73ce8cf/image.png'
        ],
        [
            'name' => 'Kubernetes and Cloud Native Associate',
            'issuer' => 'Cloud Native Computing Foundation',
            'date' => '2024',
            'credential_id' => 'KCNA',
            'badge' => 'https://images.credly.com/size/340x340/images/f28f1d88-428a-47f6-95b5-7da1dd6c1000/KCNA_badge.png'
        ],
    ],
    'selectedSkillCategory' => 'All',
    'animationEnabled' => true,
]);

$getSkillColor = function($level) {
    if ($level >= 80) return 'from-green-400 to-emerald-500';
    if ($level >= 60) return 'from-blue-400 to-cyan-500';
    if ($level >= 40) return 'from-yellow-400 to-orange-500';
    return 'from-red-400 to-pink-500';
};

$getAllSkills = computed(function () {
    return array_merge($this->webDevSkills, $this->cloudSkills, $this->designSkills);
});
?>

<div class="container px-4 py-12 mx-auto sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-12 text-center animate-slide-up">
        <h2 class="mb-4 text-3xl font-bold text-light-text-dark dark:text-white">My Skills & Expertise</h2>
        <p class="max-w-2xl mx-auto text-lg text-light-text-muted dark:text-dark-text-muted">
            A comprehensive overview of my technical skills, certifications, and areas of expertise
        </p>
    </div>

    <!-- Skills Filter -->
    <div class="flex justify-center mb-12 animate-slide-up">
        <div class="flex flex-wrap gap-2 p-2 rounded-lg bg-light-secondary dark:bg-dark-secondary">
            @php $categories = ['All', 'Web Development', 'Cloud & DevOps', 'Design']; @endphp
            @foreach ($categories as $category)
                <button
                    wire:click="$set('selectedSkillCategory', '{{ $category }}')"
                    class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300
                        {{ $selectedSkillCategory === $category
                            ? 'bg-blue-500 text-white'
                            : 'text-light-text-muted dark:text-dark-text-muted hover:bg-light-background dark:hover:bg-dark-background' }}">
                    {{ $category }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="space-y-16">
        @foreach (['Web Development' => 'webDevSkills', 'Cloud & DevOps' => 'cloudSkills', 'Design' => 'designSkills'] as $title => $var)
            @if ($selectedSkillCategory === 'All' || $selectedSkillCategory === $title)
                <section class="animate-slide-up">
                    <div class="flex items-center mb-8">
                        <div class="w-1 h-8 mr-4 rounded-full bg-gradient-to-b from-indigo-400 to-blue-500"></div>
                        <h3 class="text-2xl font-semibold text-light-text-dark dark:text-white">{{ $title }} Skills</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                        @foreach ($$var as $index => $skill)
                            <div class="p-6 bg-light-card dark:bg-gray-800 rounded-xl shadow-glow transition-all duration-300 hover:scale-[1.02] hover:shadow-xl group animate-slide-up"
                                 style="animation-delay: {{ $index * 100 }}ms;">
                                <div class="flex items-center mb-4 space-x-4">
                                    <div class="relative">
                                        <img src="{{ $skill['icon'] }}" alt="{{ $skill['name'] }} icon"
                                             class="w-12 h-12 transition-transform group-hover:scale-110"
                                             loading="lazy"
                                             onerror="this.style.display='none'" />
                                        <!-- Tooltip -->
                                        <div class="absolute px-3 py-1 text-sm text-white transition-opacity duration-200 transform -translate-x-1/2 bg-gray-900 rounded-lg opacity-0 pointer-events-none -top-10 left-1/2 dark:bg-gray-700 group-hover:opacity-100 whitespace-nowrap">
                                            {{ $skill['name'] }}
                                            <div class="absolute transform -translate-x-1/2 border-4 border-transparent top-full left-1/2 border-t-gray-900 dark:border-t-gray-700"></div>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-semibold text-light-text-dark dark:text-white">{{ $skill['name'] }}</h4>
                                        <span class="text-sm text-light-text-muted dark:text-dark-text-muted">{{ $skill['category'] }}</span>
                                    </div>
                                    <span class="text-lg font-bold text-light-text-dark dark:text-white">{{ $skill['level'] }}%</span>
                                </div>
                                <div class="w-full h-3 overflow-hidden rounded-full bg-light-secondary dark:bg-dark-secondary">
                                    <div class="h-full bg-gradient-to-r {{ $this->getSkillColor($skill['level']) }} rounded-full transition-all duration-1000 ease-out"
                                         style="width: {{ $animationEnabled ? $skill['level'] : 0 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach

        <!-- Certifications -->
        <section class="animate-slide-up">
            <div class="flex items-center mb-8">
                <div class="w-1 h-8 mr-4 rounded-full bg-gradient-to-b from-yellow-400 to-orange-500"></div>
                <h3 class="text-2xl font-semibold text-light-text-dark dark:text-white">Certifications & Achievements</h3>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach ($certifications as $index => $cert)
                    <div class="p-6 bg-light-card dark:bg-gray-800 rounded-xl shadow-glow border border-light-secondary dark:border-dark-secondary transition-all duration-300 hover:scale-[1.02] hover:shadow-xl group animate-slide-up"
                         style="animation-delay: {{ $index * 150 }}ms;">
                        <div class="flex items-start space-x-4">
                            @if (isset($cert['badge']))
                                <img src="{{ $cert['badge'] }}" alt="{{ $cert['name'] }} badge"
                                     class="w-16 h-16 transition-transform rounded-lg shadow-sm group-hover:scale-105"
                                     loading="lazy" />
                            @else
                                <div class="flex items-center justify-center w-16 h-16 rounded-lg bg-gradient-to-br from-yellow-400 to-orange-500">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-grow">
                                <h4 class="mb-2 font-semibold text-light-text-dark dark:text-white">{{ $cert['name'] }}</h4>
                                <div class="space-y-1 text-sm text-light-text-muted dark:text-dark-text-muted">
                                    <p><strong>Issuer:</strong> {{ $cert['issuer'] }}</p>
                                    <p><strong>Date:</strong> {{ $cert['date'] }}</p>
                                    @if (isset($cert['credential_id']))
                                        <p><strong>Credential ID:</strong> {{ $cert['credential_id'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
