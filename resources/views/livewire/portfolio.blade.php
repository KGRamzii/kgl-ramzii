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

            <!-- Mobile Menu: Hamburger + Active Tab Title -->
            <div class="flex items-center space-x-4 md:hidden">
                <span class="text-lg font-semibold">{{ ucfirst($activeTab) }}</span>

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
                <a href="mailto:your@email.com"
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
