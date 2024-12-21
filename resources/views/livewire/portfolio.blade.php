<?php

use function Livewire\Volt\{state, computed};

state([
    'name' => 'Kagiso Ramogayana',
    'role' => 'Full Stack Developer',
    'activeTab' => request()->query('tab', 'home'),
    'isMobileMenuOpen' => false,
]);

$setTab = function($tab = null) {
    $this->activeTab = $tab ?: request()->query('tab', 'home');
    $this->isMobileMenuOpen = false;

    $this->dispatch('replace-url', [
        'url' => url()->current() . '?tab=' . $this->activeTab,
    ]);
};

$toggleMobileMenu = function() {
    $this->isMobileMenuOpen = !$this->isMobileMenuOpen;
    $this->dispatch('body-scroll', $this->isMobileMenuOpen);
};

?>

<div class="flex flex-col min-h-screen transition-colors duration-300 bg-light-background dark:bg-dark-background text-light-text-dark dark:text-white">
    <nav class="fixed top-0 left-0 right-0 z-50 shadow-md bg-light-secondary dark:bg-dark-secondary">
        <div class="container px-4 py-4 mx-auto">
            <div class="flex items-center justify-between">
                <div class="font-mono text-lg tracking-widest uppercase md:hidden text-light-text-dark dark:text-dark-accent">
                    {{ $activeTab }}
                </div>

                <div class="md:hidden">
                    <button wire:click="toggleMobileMenu" class="text-light-text-dark dark:text-dark-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>

                <div class="justify-center hidden w-full space-x-8 md:flex">
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

            <div x-show="$wire.isMobileMenuOpen"
                 class="absolute left-0 right-0 py-2 shadow-lg md:hidden bg-light-secondary dark:bg-dark-secondary"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0">
                @foreach (['home', 'about', 'skills', 'projects', 'contact'] as $tab)
                    <button wire:click="setTab('{{ $tab }}')"
                        class="block w-full px-4 py-2 text-left transition-all duration-300 ease-in-out
                            {{ $activeTab == $tab
                                ? 'text-light-text-dark dark:text-dark-accent bg-light-background/10 dark:bg-dark-background/10'
                                : 'text-light-text-muted dark:text-dark-text-muted hover:text-light-text-dark dark:hover:text-white' }}">
                        {{ ucfirst($tab) }}
                    </button>
                @endforeach
            </div>
        </div>
    </nav>

    <div class="pt-5 md:pt-20">
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

    <footer class="mt-auto bg-light-secondary dark:bg-dark-secondary">
        <div class="container px-4 py-6 mx-auto">
            <div class="flex flex-col items-center justify-between space-y-4 md:flex-row md:space-y-0">
                <div class="text-center md:text-left">
                    <h3 class="text-lg font-semibold">{{ $name }}</h3>
                    <p class="text-light-text-muted dark:text-dark-text-muted">{{ $role }}</p>
                </div>
                <div class="flex space-x-4">
                    <a href="https://github.com/KGRamzii" class="text-light-text-muted dark:text-dark-text-muted hover:text-light-text-dark dark:hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.17 6.839 9.49.5.092.682-.217.682-.48 0-.237-.008-.866-.013-1.7-2.782.604-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.022A9.606 9.606 0 0112 6.82c.85.004 1.705.115 2.504.337 1.909-1.29 2.747-1.022 2.747-1.022.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.137 20.167 22 16.42 22 12c0-5.523-4.477-10-10-10z"></path>
                        </svg>
                    </a>
                    <a href="https://linkedin.com/in/kagiso-ramogayana-15a6921a0" class="text-light-text-muted dark:text-dark-text-muted hover:text-light-text-dark dark:hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M22.23 0H1.77C.8 0 0 .77 0 1.72v20.56C0 23.23.8 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.2 0 22.23 0zM7.27 20.1H3.65V9.24h3.62V20.1zM5.47 7.76h-.03c-1.22 0-2-.83-2-1.87 0-1.06.8-1.87 2.05-1.87 1.24 0 2 .8 2.02 1.87 0 1.04-.78 1.87-2.05 1.87zM20.34 20.1h-3.63v-5.8c0-1.45-.52-2.45-1.83-2.45-1 0-1.6.67-1.87 1.32-.1.23-.11.55-.11.88v6.05H9.28s.05-9.82 0-10.84h3.63v1.54a3.6 3.6 0 0 1 3.26-1.8c2.39 0 4.18 1.56 4.18 4.89v6.21z"></path>
                        </svg>
                    </a>
                </div>
                <div class="text-sm text-light-text-muted dark:text-dark-text-muted">
                    © {{ date('Y') }} All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
window.addEventListener('replace-url', event => {
    window.history.pushState({}, '', event.detail.url);
});
</script>
