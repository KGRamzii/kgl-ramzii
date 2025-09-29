<?php

use Livewire\Volt\Component;

new class extends Component {
    public array $projects = [];
    public string $selectedCategory = 'All';
    public ?array $modalProject = null;
    public bool $projectModalOpen = false;

    public function mount(): void
    {
        $this->projects = [
            [
                'id' => 1,
                'name' => 'FPS game Ranking',
                'description' => 'An application aimed to document, schedule and report custom challenges amongst friends in a popular fps game named Valorant.',
                'technologies' => ['Laravel', 'Livewire', 'Webhook','API', 'Tailwind CSS'],
                'difficulty' => 'Intermediate',
                'timeline' => '3 months',
                'completion_date' => '2025-09-12',
                'status' => 'Completed',
                'link' => 'https://pleasedontshoot.fly.dev',
                'repository' => 'https://github.com/KGRamzii/pleasedontshoot',
                'preview' => '/images/pds/pds1.png',
                'category' => 'Web Development',
                'screenshots' => ['/storage/images/pds/pds1.png','/storage/images/pds/pds2.png','/storage/images/pds/pdsMobile.png'],
            ],
            [
                'id' => 2,
                'name' => 'AmoShots',
                'description' => 'A landing page for a photography business, showcasing portfolio and services.',
                'technologies' => ['Laravel', 'Livewire', 'Tailwind CSS'],
                'difficulty' => 'Beginner',
                'timeline' => '4 weeks',
                'completion_date' => '2025-06-12',
                'status' => 'Completed',
                'link' => 'https://amoshots.com',
                'repository' => null,
                'preview' => '/images/amoshots/web.png',
                'category' => 'Web Development',
                'screenshots' => ['/storage/images/amoshots/web.png', '/storage/images/amoshots/mobile.png'],
            ],
            [
                'id' => 3,
                'name' => 'Bathusi Merakeng Logo Design',
                'description' => 'A portfolio showcasing creative logo designs for a Chicken Farm business.',
                'technologies' => ['Adobe Illustrator', 'Photoshop'],
                'difficulty' => 'Beginner',
                'timeline' => '2 weeks',
                'completion_date' => '2024-10-15',
                'status' => 'Completed',
                'link' => '#',
                'repository' => null,
                'preview' => 'images/Bathusi/1.png',
                'category' => 'Graphic Design',
                'screenshots' => ['/storage/images/Bathusi/1.png'],
            ],
            [
                'id' => 4,
                'name' => 'Bridal Vault Logo Design',
                'description' => 'A portfolio showcasing creative logo designs for a Wedding dress design business.',
                'technologies' => ['Adobe Illustrator', 'Photoshop'],
                'difficulty' => 'Beginner',
                'timeline' => '2 weeks',
                'completion_date' => '2024-10-15',
                'status' => 'Completed',
                'link' => '#',
                'repository' => null,
                'preview' => 'images/bv/BV.png',
                'category' => 'Graphic Design',
                'screenshots' => ['/storage/images/bv/BV.png','/storage/images/bv/bv-t2.png','/storage/images/bv/01.png','/storage/images/bv/02.png','/storage/images/bv/05.png','/storage/images/bv/Artboard 206.png','/storage/images/bv/dress.png','/storage/images/bv/stamp.png'],
            ],
            [
                'id' => 5,
                'name' => 'PNP Logo Design',
                'description' => 'A portfolio showcasing creative logo designs for a petroleum supply business.',
                'technologies' => ['Adobe Illustrator', 'Photoshop'],
                'difficulty' => 'Beginner',
                'timeline' => '2 weeks',
                'completion_date' => '2024-10-15',
                'status' => 'Completed',
                'link' => '#',
                'repository' => null,
                'preview' => 'images/pnp/PMP2.jpg',
                'category' => 'Graphic Design',
                'screenshots' => ['/storage/images/pnp/PMP2.jpg','/storage/images/pnp/PMP3.jpg','/storage/images/pnp/PMP4.jpg','/storage/images/pnp/PMP5.jpg'],
            ],
            [
                'id' => 6,
                'name' => '3D Character Modeling',
                'description' => 'A collection of 3D models created for video games and animation projects.',
                'technologies' => ['Blender', 'ZBrush'],
                'difficulty' => 'Advanced',
                'timeline' => '4 months',
                'completion_date' => '2025-05-25',
                'status' => 'In Progress',
                'link' => '#',
                'repository' => null,
                'preview' => '',
                'model' => '3D/mic.glb',
                'category' => '3D Design',
                'screenshots' => ['/storage/images/screenshots/3d-model-1.png','/storage/images/screenshots/3d-model-3.png'],
            ],
        ];
    }

    public function getFilteredProjectsProperty(): array
    {
        if ($this->selectedCategory === 'All') {
            return $this->projects;
        }

        return array_values(array_filter($this->projects, function ($project) {
            return ($project['category'] ?? '') === $this->selectedCategory;
        }));
    }

    public function selectProject(?int $id): void
    {
        if ($id === null) {
            $this->modalProject = null;
            $this->projectModalOpen = false;
            return;
        }

        $found = null;
        foreach ($this->projects as $p) {
            if (isset($p['id']) && (int)$p['id'] === (int)$id) {
                $found = $p;
                break;
            }
        }

        $this->modalProject = $found;
        $this->projectModalOpen = (bool) $found;
    }

    public function closeModal(): void
    {
        $this->projectModalOpen = false;
        $this->modalProject = null;
    }
};
?>

<!--
  IMPORTANT: single root element below — Livewire requires only one top-level node.
-->
<div class="livewire-portfolio-root">

    <div class="container px-6 py-16 mx-auto animate-fade-in">
        <div class="flex flex-col items-center justify-between mb-16 animate-slide-up md:flex-row">
            <div class="mb-8 md:mb-0">
                <h1 class="mb-4 text-5xl font-bold gradient-text-primary">My Projects</h1>
                <p class="text-xl text-light-text-muted dark:text-dark-text-muted opacity-90">
                    Explore my creative journey through various disciplines
                </p>
                <div class="w-24 h-1 mt-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-600"></div>
            </div>

            <div class="relative animate-slide-in-right">
                <select
                    wire:model.live="selectedCategory"
                    class="w-full py-4 pl-6 pr-12 text-lg font-medium transition-all duration-500 border-2 border-transparent appearance-none rounded-2xl md:w-72 card-glass focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 text-light-text-dark dark:text-white shadow-glow"
                    aria-label="Filter projects by category"
                >
                    <option value="All">All Categories</option>
                    <option value="Web Development">Web Development</option>
                    <option value="Graphic Design">Graphic Design</option>
                    <option value="3D Design">3D Design</option>
                </select>

                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-light-text-muted dark:text-dark-text-muted">
                    <x-heroicon-o-chevron-down class="w-6 h-6 transition-transform duration-300 fill-current group-focus-within:rotate-180"/>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3 animate-slide-up">
            @forelse ($this->filteredProjects as $index => $project)
                <article
                    wire:click="selectProject({{ $project['id'] }})"
                    wire:keydown.enter="selectProject({{ $project['id'] }})"
                    class="relative overflow-hidden transition-all duration-500 transform cursor-pointer card-glass rounded-3xl shadow-glow hover:shadow-glow-colored btn-hover-lift group focus:outline-none focus:ring-4 focus:ring-blue-500/50"
                    style="animation-delay: {{ $index * 0.1 }}s"
                    tabindex="0"
                    role="button"
                    aria-label="View details for {{ $project['name'] }}"
                >
                    <div class="relative h-64 overflow-hidden rounded-t-3xl">
                        @if (!empty($project['preview']))
                            <img
                                src="{{ Storage::url($project['preview']) }}"
                                alt="{{ $project['name'] }} Preview"
                                loading="lazy"
                                class="absolute inset-0 object-cover w-full h-full transition-all duration-700 ease-in-out transform scale-100 opacity-90 group-hover:opacity-100 group-hover:scale-110 brightness-95 group-hover:brightness-105"
                                width="400" height="250"
                            />
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
                                <div class="animate-float">
                                    <x-heroicon-o-photo class="w-20 h-20 mb-6 text-gray-400"/>
                                </div>
                                <span class="text-xl font-semibold text-gray-500 dark:text-gray-400">Coming Soon</span>
                            </div>
                        @endif

                        <div class="absolute inset-0 transition-opacity duration-500 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-80 group-hover:opacity-60"></div>

                        <div class="absolute flex items-start justify-between pointer-events-none top-4 left-4 right-4">
                            <span class="px-4 py-2 text-sm font-semibold text-white rounded-xl backdrop-blur-glass {{ $project['status'] === 'In Progress' ? 'bg-gradient-to-r from-orange-500 to-orange-600 shadow-glow-colored' : ($project['status'] === 'Completed' ? 'bg-gradient-to-r from-green-500 to-green-600 shadow-glow-colored' : 'bg-gradient-to-r from-gray-500 to-gray-600') }}">
                                {{ $project['status'] }}
                            </span>
                            <span class="px-4 py-2 text-sm font-semibold text-white rounded-xl backdrop-blur-glass bg-black/40">
                                {{ $project['category'] }}
                            </span>
                        </div>

                        <div class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-gradient-to-t from-blue-600/20 to-purple-600/20 group-hover:opacity-100"></div>
                    </div>

                    <div class="p-8">
                        <h3 class="mb-4 text-2xl font-bold transition-all duration-300 text-light-text-dark dark:text-white group-hover:gradient-text-primary">
                            {{ $project['name'] }}
                        </h3>

                        <p class="mb-6 leading-relaxed text-light-text-muted dark:text-dark-text-muted line-clamp-2">
                            {{ $project['description'] }}
                        </p>

                        <div class="flex flex-wrap gap-3 mb-6">
                            @foreach ($project['technologies'] as $tech)
                                <span class="px-3 py-2 text-sm font-medium transition-colors duration-300 border rounded-lg text-light-text-dark dark:text-dark-text-light bg-light-secondary dark:bg-dark-secondary border-light-secondary dark:border-dark-secondary hover:bg-blue-50 hover:border-blue-200 dark:hover:bg-blue-900/20 dark:hover:border-blue-700">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-light-secondary dark:border-dark-secondary">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 rounded-full {{ $project['difficulty'] === 'Beginner' ? 'bg-green-500' : ($project['difficulty'] === 'Intermediate' ? 'bg-yellow-500' : 'bg-red-500') }}"></div>
                                <span class="text-sm font-medium text-light-text-muted dark:text-dark-text-muted">{{ $project['difficulty'] }}</span>
                            </div>

                            <div class="flex items-center space-x-2">
                                <x-heroicon-s-clock class="w-4 h-4 text-light-text-muted dark:text-dark-text-muted"/>
                                <span class="text-sm font-medium text-light-text-muted dark:text-dark-text-muted">{{ $project['timeline'] }}</span>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="py-24 text-center col-span-full animate-slide-up">
                    <div class="animate-float">
                        <x-heroicon-o-document-text class="w-24 h-24 mx-auto mb-8 opacity-50 text-light-text-muted dark:text-dark-text-muted"/>
                    </div>
                    <h3 class="mb-4 text-2xl font-semibold text-light-text-dark dark:text-white">No projects found</h3>
                    <p class="text-lg text-light-text-muted dark:text-dark-text-muted">
                        No projects found for this category. Try selecting a different category.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- MaryUI modal (inside same root) -->
    <x-mary-modal
    wire:model="projectModalOpen"
    wire:key="project-modal-{{ $modalProject['id'] ?? 'none' }}"
    :title="$modalProject['name'] ?? 'Project Details'"
    :subtitle="($modalProject['category'] ?? '') . ' • ' . ($modalProject['status'] ?? '')"
    class="min-w-[40rem]"
>
    @if (empty($modalProject))
        <div class="flex flex-col items-center justify-center p-12 space-y-4">
            <x-mary-loading class="text-blue-500 loading-infinity" />
            <p class="text-lg text-light-text-muted dark:text-dark-text-muted">Loading project details...</p>
        </div>
    @else
        <div
            x-data="{
                currentImageIndex: 0,
                images: @js($modalProject['screenshots'] ?? []),
                lightboxOpen: false,
                nextImage() {
                    if (this.images.length) this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
                },
                prevImage() {
                    if (this.images.length) this.currentImageIndex = (this.currentImageIndex - 1 + this.images.length) % this.images.length;
                },
                closeLightbox() {
                    this.lightboxOpen = false;
                },
                closeModal() {
                    $wire.closeModal();
                },
                handleKeydown(event) {
                    if (event.key === 'Escape') {
                        if (this.lightboxOpen) this.closeLightbox();
                        else this.closeModal();
                    } else if (event.key === 'ArrowLeft' && this.images.length > 1) {
                        this.prevImage();
                    } else if (event.key === 'ArrowRight' && this.images.length > 1) {
                        this.nextImage();
                    }
                }
            }"
            x-init="
                $watch('lightboxOpen', value => {
                    document.body.style.overflow = value ? 'hidden' : 'auto';
                });
                window.addEventListener('keydown', (e) => handleKeydown(e));
            "
        >
            <!-- Modal Content -->
            <div class="max-w-md space-y-2">
                <div class="grid gap-2 lg:grid-cols-2">
                    <!-- Media Section -->
                    <div class="animate-slide-in-left">
                        @if (($modalProject['category'] ?? '') === '3D Design' && !empty($modalProject['model']))
                            <!-- 3D Model Viewer -->
                            <div class="relative overflow-hidden rounded-2xl shadow-glow">
                                <model-viewer
                                    src="{{ $modalProject['model'] ?? '' }}"
                                    alt="{{ $modalProject['name'] ?? '3D Model' }}"
                                    ar auto-rotate camera-controls
                                    class="w-full h-80"
                                    loading="lazy"
                                ></model-viewer>
                            </div>
                        @elseif (!empty($modalProject['screenshots'] ?? []))
                            <!-- Image Gallery -->
                            <div class="space-y-2">
                                <div
                                    class="relative overflow-hidden h-80 rounded-2xl group cursor-zoom-in shadow-glow"
                                    @click="lightboxOpen = true"
                                >
                                    <img
                                        x-show="images.length > 0"
                                        :src="images[currentImageIndex]"
                                        :alt="'{{ $modalProject['name'] ?? '' }} Screenshot ' + (currentImageIndex + 1)"
                                        class="object-contain w-full h-full transition-transform duration-500 ease-in-out bg-white group-hover:scale-105 rounded-2xl"
                                        loading="lazy"
                                    />
                                    <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/20 to-transparent group-hover:opacity-100 rounded-2xl"></div>

                                    <!-- Zoom hint -->
                                    <div class="absolute px-4 py-2 text-sm font-medium text-white transition-opacity duration-300 transform -translate-x-1/2 rounded-lg opacity-0 bottom-4 left-1/2 bg-black/60 backdrop-blur-sm group-hover:opacity-100">
                                        Click to zoom
                                    </div>
                                </div>

                                <!-- Thumbnails -->
                                <template x-if="images.length > 1">
                                    <div class="flex pb-2 space-x-2 overflow-x-auto">
                                        <template x-for="(image, index) in images" :key="index">
                                            <img
                                                :src="image"
                                                @click="currentImageIndex = index"
                                                :class="{
                                                    'ring-4 ring-blue-500 shadow-glow-colored': currentImageIndex === index,
                                                    'opacity-60 hover:opacity-100': currentImageIndex !== index
                                                }"
                                                class="flex-shrink-0 object-cover w-20 h-20 transition-all duration-300 bg-white cursor-pointer rounded-xl shadow-glow"
                                                loading="lazy"
                                                :alt="'Thumbnail ' + (index + 1)"
                                            />
                                        </template>
                                    </div>
                                </template>
                            </div>
                        @else
                            <!-- No Preview -->
                            <div class="flex flex-col items-center justify-center w-full h-80 card-glass rounded-2xl">
                                <div class="animate-float">
                                    <x-heroicon-o-photo class="w-16 h-16 mb-4 text-light-text-muted dark:text-dark-text-muted"/>
                                </div>
                                <span class="text-lg font-medium text-light-text-muted dark:text-dark-text-muted">No preview available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Details Section -->
                    <div class="space-y-2 animate-slide-in-right">
                        <!-- Description -->
                        <div class="px-6 py-3 card-glass rounded-2xl">
                            <h4 class="mb-4 text-xl font-semibold text-light-text-dark dark:text-white">Description</h4>
                            <p class="text-lg leading-relaxed text-light-text-muted dark:text-dark-text-muted">
                                {{ $modalProject['description'] ?? 'No description available.' }}
                            </p>
                        </div>

                        <!-- Technologies -->
                        @if(!empty($modalProject['technologies'] ?? []))
                            <div class="p-6 card-glass rounded-2xl">
                                <h4 class="mb-4 text-xl font-semibold text-light-text-dark dark:text-white">Technologies</h4>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($modalProject['technologies'] as $tech)
                                        <span class="px-4 py-2 text-sm font-medium text-blue-700 transition-all duration-300 border border-blue-200 rounded-lg bg-gradient-to-r from-blue-500/10 to-purple-500/10 dark:text-blue-300 dark:border-blue-800 hover:shadow-glow-colored">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Project Info Grid -->
                        <div class="grid grid-cols-2 gap-2">
                            @if(!empty($modalProject['difficulty']))
                                <div class="p-4 text-center card-glass rounded-xl">
                                    <div class="w-3 h-3 mx-auto mb-2 rounded-full
                                        {{ $modalProject['difficulty'] === 'Beginner' ? 'bg-green-500' :
                                           ($modalProject['difficulty'] === 'Intermediate' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                    </div>
                                    <span class="block text-sm font-medium text-light-text-muted dark:text-dark-text-muted">Difficulty</span>
                                    <span class="text-lg font-semibold text-light-text-dark dark:text-white">{{ $modalProject['difficulty'] }}</span>
                                </div>
                            @endif

                            @if(!empty($modalProject['timeline']))
                                <div class="p-4 text-center card-glass rounded-xl">
                                    <x-heroicon-o-clock class="w-6 h-6 mx-auto mb-2 text-blue-500" />
                                    <span class="block text-sm font-medium text-light-text-muted dark:text-dark-text-muted">Timeline</span>
                                    <span class="text-lg font-semibold text-light-text-dark dark:text-white">{{ $modalProject['timeline'] }}</span>
                                </div>
                            @endif

                            @if(!empty($modalProject['completion_date']))
                                <div class="p-4 text-center card-glass rounded-xl">
                                    <x-heroicon-o-calendar class="w-6 h-6 mx-auto mb-2 text-green-500" />
                                    <span class="block text-sm font-medium text-light-text-muted dark:text-dark-text-muted">Completed</span>
                                    <span class="text-lg font-semibold text-light-text-dark dark:text-white">{{ $modalProject['completion_date'] }}</span>
                                </div>
                            @endif

                            @if(!empty($modalProject['status']))
                                <div class="p-4 text-center card-glass rounded-xl">
                                    @if ($modalProject['status'] === 'Completed')
                                        <x-heroicon-s-check-circle class="w-6 h-6 mx-auto mb-2 text-green-500" />
                                    @else
                                        <x-heroicon-s-clock class="w-6 h-6 mx-auto mb-2 text-orange-500" />
                                    @endif
                                    <span class="block text-sm font-medium text-light-text-muted dark:text-dark-text-muted">Status</span>
                                    <span class="text-lg font-semibold text-light-text-dark dark:text-white">{{ $modalProject['status'] }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-4">
                            @if (!empty($modalProject['link']) && $modalProject['link'] !== '#')
                                <a href="{{ $modalProject['link'] }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-500 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl btn-hover-lift focus:outline-none focus:ring-4 focus:ring-blue-500/50 shadow-glow-colored">
                                    <x-heroicon-s-arrow-top-right-on-square class="w-5 h-5 mr-3" />
                                    View Project
                                </a>
                            @endif

                            @if (!empty($modalProject['repository']))
                                <a href="{{ $modalProject['repository'] }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-500 bg-gradient-to-r from-green-500 to-green-600 rounded-xl btn-hover-lift focus:outline-none focus:ring-4 focus:ring-green-500/50 shadow-glow-colored">
                                    <x-bi-github class="w-5 h-5 mr-3" />
                                    GitHub
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lightbox Overlay (sibling to content, not nested) -->
            <div
                x-show="lightboxOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/90 backdrop-blur-sm"
                @click.self="closeLightbox()"
                style="display: none;"
            >
                <div class="relative w-full h-full max-w-screen-xl max-h-screen p-6">
                    <img
                        :src="images[currentImageIndex]"
                        :alt="'Lightbox Image ' + (currentImageIndex + 1)"
                        class="object-contain w-full h-full transition-transform duration-500 ease-in-out rounded-2xl shadow-glow"
                        loading="lazy"
                    />

                    <!-- Close Button -->
                    <button
                        @click="closeLightbox()"
                        class="absolute p-3 text-white rounded-full bg-gradient-to-r from-red-500 to-red-600 top-6 right-6 btn-hover-lift focus:outline-none focus:ring-4 focus:ring-red-500/50 shadow-glow-colored"
                        aria-label="Close lightbox"
                    >
                        <x-heroicon-s-x-mark class="w-6 h-6" />
                    </button>

                    <!-- Navigation -->
                    <template x-if="images.length > 1">
                        <div>
                            <!-- Previous -->
                            <button
                                @click="prevImage()"
                                class="absolute p-4 text-white -translate-y-1/2 rounded-full left-6 top-1/2 backdrop-blur-glass bg-black/60 btn-hover-lift focus:outline-none focus:ring-4 focus:ring-white/50 hover:bg-black/80"
                                aria-label="Previous image"
                            >
                                <x-heroicon-s-chevron-left class="w-8 h-8" />
                            </button>

                            <!-- Next -->
                            <button
                                @click="nextImage()"
                                class="absolute p-4 text-white -translate-y-1/2 rounded-full right-6 top-1/2 backdrop-blur-glass bg-black/60 btn-hover-lift focus:outline-none focus:ring-4 focus:ring-white/50 hover:bg-black/80"
                                aria-label="Next image"
                            >
                                <x-heroicon-s-chevron-right class="w-8 h-8" />
                            </button>

                            <!-- Counter -->
                            <div class="absolute px-6 py-3 font-medium text-white transform -translate-x-1/2 rounded-xl bottom-6 left-1/2 backdrop-blur-glass bg-black/60">
                                <span x-text="(currentImageIndex + 1) + ' / ' + images.length"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Footer Slot (outside Alpine scope) -->
    <x-slot:actions>
        <x-mary-button
            label="Close"
            @click="$wire.closeModal()"
            class="btn-error"
        />
    </x-slot:actions>
</x-mary-modal>
</div>
