<?php

use Livewire\Volt\Component;

new class extends Component {
    public $name = 'Kagiso Ramogayana';
    public $role = 'Full Stack Developer';
    public $activeTab;
    public $isMobileMenuOpen = false;

    public $tabs = ['home', 'about', 'skills', 'projects', 'contact'];

    public function mount()
    {
        $this->activeTab = request()->query('tab', 'home');
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->isMobileMenuOpen = false;

        $this->dispatch('replace-url', [
            'url' => request()->fullUrlWithQuery(['tab' => $this->activeTab]),
        ]);
    }

    public function toggleMobileMenu()
    {
        $this->isMobileMenuOpen = !$this->isMobileMenuOpen;
        $this->dispatch('body-scroll', $this->isMobileMenuOpen);
    }
};
?>

<div class="flex flex-col min-h-screen transition-colors duration-300 bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-50">

    <!-- NAVIGATION -->
    <nav class="fixed top-0 left-0 right-0 z-50 shadow-md bg-white/80 dark:bg-zinc-800/80 backdrop-blur-sm">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">

            <!-- Brand -->
            <button wire:click="setTab('home')" class="flex-shrink-0 text-lg font-bold tracking-tight text-zinc-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                Kagiso R.
            </button>

            <!-- Desktop Tabs -->
            <div class="hidden space-x-6 md:flex">
                @foreach ($tabs as $tab)
                    <button wire:click="setTab('{{ $tab }}')"
                        class="relative px-2 py-1 text-base font-medium transition-colors
                            {{ $activeTab === $tab
                                ? 'text-secondary'
                                : 'text-zinc-600 dark:text-zinc-300 hover:text-secondary' }}">
                        {{ ucfirst($tab) }}
                        <span
                            class="absolute left-0 -bottom-0.5 h-0.5 w-full scale-x-0 transition-transform duration-300 ease-out
                                   {{ $activeTab === $tab ? 'scale-x-100 bg-secondary' : 'hover:scale-x-100 bg-orange-400' }}">
                        </span>
                    </button>
                @endforeach
            </div>

            <!-- Right side: Dark mode toggle + Mobile hamburger -->
            <div class="flex items-center space-x-2">
                <!-- Dark mode toggle -->
                <button
                    x-data="{ isDark: document.documentElement.classList.contains('dark') }"
                    @click="
                        isDark = !isDark;
                        window.Flux
                            ? window.Flux.applyAppearance(isDark ? 'dark' : 'light')
                            : (document.documentElement.classList.toggle('dark', isDark),
                               localStorage.setItem('flux.appearance', isDark ? 'dark' : 'light'));
                    "
                    class="p-2 transition rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700"
                    aria-label="Toggle dark mode"
                >
                    <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <!-- Mobile Menu: Hamburger + Active Tab Title -->
                <div class="flex items-center space-x-2 md:hidden">
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-200">{{ ucfirst($activeTab) }}</span>
                    <button wire:click="toggleMobileMenu"
                        class="p-2 transition rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-700">
                        @if ($isMobileMenuOpen)
                            <flux:icon.x-mark class="w-7 h-7 text-zinc-700 dark:text-zinc-200" />
                        @else
                            <flux:icon.bars-3 class="w-7 h-7 text-zinc-700 dark:text-zinc-200" />
                        @endif
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        @if ($isMobileMenuOpen)
            <div class="px-6 py-4 space-y-2 shadow-md md:hidden bg-white/95 dark:bg-zinc-800/95">
                @foreach ($tabs as $tab)
                    <button wire:click="setTab('{{ $tab }}')"
                        class="block w-full text-left px-3 py-2 rounded-lg transition
                            {{ $activeTab === $tab
                                ? 'bg-secondary text-white'
                                : 'hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300' }}">
                        {{ ucfirst($tab) }}
                    </button>
                @endforeach
            </div>
        @endif
    </nav>

    <!-- PAGE CONTENT -->
    <div class="pt-10">
        <div class="container px-6 py-4 mx-auto">
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

    <!-- FOOTER -->
    <footer class="mt-auto border-t bg-white/60 dark:bg-zinc-800/60 backdrop-blur-sm border-zinc-200 dark:border-zinc-700">
        <div class="container flex flex-col items-center justify-between px-6 py-6 mx-auto space-y-4 md:flex-row md:space-y-0">

            <div class="flex space-x-4">
                <a href="https://github.com/KGRamzii"
                   class="p-2 transition rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                    <x-bi-github class="w-6 h-6 text-zinc-600 dark:text-zinc-300" />
                </a>
                <a href="https://linkedin.com/in/kagiso-ramogayana-15a6921a0"
                   class="p-2 transition rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                    <x-bi-linkedin class="w-6 h-6 text-zinc-600 dark:text-zinc-300" />
                </a>
                <a href="mailto:kagiso1382@gmail.com"
                   class="p-2 transition rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                    <flux:icon.envelope class="w-6 h-6 text-zinc-600 dark:text-zinc-300" />
                </a>
            </div>

            <div class="text-sm text-zinc-500 dark:text-zinc-400">
                © {{ date('Y') }} All rights reserved.
            </div>
        </div>
    </footer>
</div>

<script>
window.addEventListener('replace-url', event => {
    window.history.pushState({}, '', event.detail.url);
});
</script>
