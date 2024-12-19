<?php
use function Livewire\Volt\{state, computed};

state([
    'name' => 'Kagiso Ramogayana',
    'role' => 'Full Stack Developer',
    'activeTab' => 'home',
]);

$setTab = fn($tab) => ($this->activeTab = $tab);
?>

<div
    class="min-h-screen transition-colors duration-300 bg-light-background dark:bg-dark-background text-light-text-dark dark:text-white">
    <nav class="shadow-md bg-light-secondary dark:bg-dark-secondary">
        <div class="container px-4 py-4 mx-auto">
            <div class="flex justify-center space-x-8">
                @foreach (['home', 'about', 'skills', 'projects', 'contact'] as $tab)
                    <button wire:click="setTab('{{ $tab }}')"
                        class="px-4 py-2 transition-all duration-300 ease-in-out
                            {{ $activeTab == $tab
                                ? 'text-light-text-dark dark:text-dark-accent border-b-2 border-light-text-dark dark:border-dark-accent scale-105'
                                : 'text-light-text-muted dark:text-dark-text-muted hover:text-light-text-dark dark:hover:text-white' }}">
                        {{ ucfirst($tab) }}
                    </button>
                @endforeach
            </div>
        </div>
    </nav>

    <div class="container px-4 py-8 mx-auto">
        <div class="animate-fade-in">
            @switch($activeTab)
                @case('home')
                    <livewire:portfolio.home />
                @break

                @case('about')
                    <livewire:portfolio.about />
                @break

                @case('skills')
                    <livewire:portfolio.skills />
                @break

                @case('projects')
                    <livewire:portfolio.projects />
                @break

                @case('contact')
                    <livewire:portfolio.contact />
                @break
            @endswitch
        </div>
    </div>
</div>
