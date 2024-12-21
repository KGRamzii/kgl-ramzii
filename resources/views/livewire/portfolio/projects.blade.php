<?php
use function Livewire\Volt\{state, mount};

state([
    'projects' => [
        [
            'name' => 'FPS game Ranking',
            'description' => 'An application aimed to document, schedule and report custom challenges amongst friends in a popular fps game named Valorant.',
            'technologies' => ['Laravel', 'Livewire', 'Webhook'],
            'difficulty' => 'Intermediate',
            'timeline' => '3 months',
            'completion_date' => '2024-11-01',
            'status' => 'Completed',
            'link' => 'https://pleasedontshoot.fly.dev',
            'repository' => 'https://github.com/KGRamzii/pleasedontshoot',
            'preview' => '/storage/images/pds/1.png',
            'category' => 'Web Development',
            'screenshots' => ['/storage/images/pds/1.png'],
        ],
        [
            'name' => 'Bathusi Merakeng Logo Design',
            'description' => 'A portfolio showcasing creative logo designs for a Chicken Farm business.',
            'technologies' => ['Adobe Illustrator', 'Photoshop'],
            'difficulty' => 'Beginner',
            'timeline' => '2 weeks',
            'completion_date' => '2024-10-15',
            'status' => 'Completed',
            'link' => '#',
            'repository' => null,
            'preview' => '/storage/images/Bathusi/1.png',
            'category' => 'Graphic Design',
            'screenshots' => ['/storage/images/Bathusi/1.png'],
        ],
        [
            'name' => 'Bridal Vault Logo Design',
            'description' => 'A portfolio showcasing creative logo designs for a Wedding dress design business.',
            'technologies' => ['Adobe Illustrator', 'Photoshop'],
            'difficulty' => 'Beginner',
            'timeline' => '2 weeks',
            'completion_date' => '2024-10-15',
            'status' => 'Completed',
            'link' => '#',
            'repository' => null,
            'preview' => '/storage/images/bv/4.png',
            'category' => 'Graphic Design',
            'screenshots' => ['/storage/images/bv/1.png', '/storage/images/bv/2.png', '/storage/images/bv/3.png', '/storage/images/bv/4.png', '/storage/images/bv/5.png', '/storage/images/bv/6.png', '/storage/images/bv/7.png', '/storage/images/bv/8.png'],
        ],
        [
            'name' => 'PNP Logo Design',
            'description' => 'A portfolio showcasing creative logo designs for a petrolium supply business.',
            'technologies' => ['Adobe Illustrator', 'Photoshop'],
            'difficulty' => 'Beginner',
            'timeline' => '2 weeks',
            'completion_date' => '2024-10-15',
            'status' => 'Completed',
            'link' => '#',
            'repository' => null,
            'preview' => '/storage/images/pnp/1.jpg',
            'category' => 'Graphic Design',
            'screenshots' => ['/storage/images/pnp/1.jpg', '/storage/images/pnp/2.jpg', '/storage/images/pnp/3.jpg', '/storage/images/pnp/4.jpg'],
        ],
        [
            'name' => '3D Character Modeling',
            'description' => 'A collection of 3D models created for video games and animation projects.',
            'technologies' => ['Blender', 'ZBrush'],
            'difficulty' => 'Advanced',
            'timeline' => '4 months',
            'completion_date' => '2023-12-01',
            'status' => 'In Progress',
            'link' => '#',
            'repository' => null,
            'preview' => '',
            'model' => '/storage/3D/mic.glb',
            'category' => '3D Design',
            'screenshots' => ['/storage/images/screenshots/3d-model-1.png', '/storage/images/screenshots/3d-model-2.png'],
        ],
    ],
    'selectedCategory' => 'All',
    'modalProject' => null,
]);

mount(function () {
    return [];
});
?>

<div class="container px-4 py-8 mx-auto">
    <div class="flex flex-col items-center justify-between mb-8 md:flex-row">
        <h1 class="mb-4 text-3xl font-bold md:mb-0text-light-text-dark dark:text-white">
            My Projects
        </h1>

        <!-- Filter Dropdown -->
        <div class="relative ">
            <select wire:model.live="selectedCategory"
                class="w-full py-2 pl-4 pr-10 border rounded-lg shadow-sm appearance-none md:w-64 bg-light-background dark:bg-dark-background border-light-secondary dark:border-dark-secondary text-light-text-muted dark:text-dark-text-light focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="All">All Categories</option>
                <option value="Web Development">Web Development</option>
                <option value="Graphic Design">Graphic Design</option>
                <option value="3D Design">3D Design</option>
            </select>
            {{-- <div
                class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none dark:text-white">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div> --}}
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($projects as $project)
            @if ($selectedCategory === 'All' || $project['category'] === $selectedCategory)
                <div x-on:click.prevent="$wire.set('modalProject', {{ json_encode($project) }})"
                    class="transition-all duration-300 transform rounded-lg shadow-lg cursor-pointer bg-light-card dark:bg-gray-800 hover:shadow-2xl hover:scale-105 group">
                    <!-- Project Preview Image -->

                    <div class="relative h-48 overflow-hidden rounded-lg shadow-md">
                        @if ($project['preview'])
    <img src="{{ $project['preview'] }}" alt="{{ $project['name'] }} Preview" loading="lazy"
        class="absolute inset-0 object-cover w-full h-full transition-all duration-500
        ease-in-out transform
        opacity-80 group-hover:opacity-100
        scale-100 group-hover:scale-110
        brightness-90 group-hover:brightness-100
        blur-[1px] group-hover:blur-none"
        width="300" height="200">
@else
    <div class="absolute inset-0 flex items-center justify-center w-full h-full bg-gray-200 dark:bg-gray-800">
        <span class="text-xl font-semibold text-gray-600 dark:text-gray-400">
            Coming Soon
        </span>
    </div>
@endif

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/40"></div>

                        <!-- Category Badge -->
                        <span
                            class="absolute px-3 py-1 text-xs font-semibold text-white rounded-full bg-black/40 top-3 right-3 backdrop-blur-sm">
                            {{ $project['category'] }}
                        </span>
                    </div>

                    <!-- Project Details -->
                    <div class="p-5">
                        <h3 class="mb-2 text-xl font-bold text-white dark:text-white">
                            {{ $project['name'] }}
                        </h3>
                        <p class="mb-4 text-light-text-muted dark:text-dark-text-muted line-clamp-2">
                            {{ $project['description'] }}
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($project['technologies'] as $tech)
                                <span
                                    class="px-2 py-1 text-xs text-gray-600 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Modal -->
    @if ($modalProject)
        <div x-data="{
            open: true,
            currentImageIndex: 0,
            images: {{ json_encode($modalProject['screenshots'] ?? []) }},
            lightboxOpen: false,
            nextImage() {
                this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
            },
            prevImage() {
                this.currentImageIndex = (this.currentImageIndex - 1 + this.images.length) % this.images.length;
            },
            closeLightbox() {
                this.lightboxOpen = false;
            }
        }" x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">

            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="px-6 py-4 bg-gray-100 border-b border-gray-300 dark:bg-gray-900 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{ $modalProject['name'] }}
                    </h3>
                </div>

                <div class="p-6 space-y-4">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            @if ($modalProject['category'] === '3D Design' && $modalProject['model'])
                        <!-- 3D Viewer -->
                        <model-viewer src="{{ $modalProject['model'] }}" alt="{{ $modalProject['name'] }} 3D Model"
                            ar auto-rotate camera-controls class="w-full h-64">
                        </model-viewer>
                    @elseif (!empty($modalProject['screenshots']))
                        <!-- Image Viewer -->
                        <div class="relative h-64 overflow-hidden rounded-lg group cursor-zoom-in" @click="lightboxOpen = true">
                            <img x-show="images.length > 0" :src="images[currentImageIndex]"
                                :alt="'{{ $modalProject['name'] }} Screenshot ' + (currentImageIndex + 1)"
                                class="object-contain w-full h-full transition-transform duration-300 ease-in-out group-hover:scale-105 dark:bg-white">
                        </div>
                        <!-- Thumbnail Gallery -->
                        <template x-if="images.length > 1">
                            <div class="flex pb-2 mt-4 space-x-2 overflow-x-auto">
                                <template x-for="(image, index) in images" :key="index">
                                    <img :src="image" @click="currentImageIndex = index"
                                        :class="{ 'border-2 border-blue-500': currentImageIndex === index, 'opacity-60': currentImageIndex !== index }"
                                        class="object-cover w-16 h-16 transition-all duration-300 rounded-lg cursor-pointer hover:opacity-100 dark:bg-white">
                                </template>
                            </div>
                        </template>
                    @endif
                        </div>
                        <div>
                            <p class="mb-4 text-gray-600 dark:text-gray-300">
                                {{ $modalProject['description'] }}
                            </p>
                            <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                                <li><strong>Difficulty:</strong> {{ $modalProject['difficulty'] }}</li>
                                <li><strong>Timeline:</strong> {{ $modalProject['timeline'] }}</li>
                                <li><strong>Completion Date:</strong> {{ $modalProject['completion_date'] }}</li>
                                <li><strong>Status:</strong> {{ $modalProject['status'] }}</li>
                            </ul>
                            <div class="flex mt-4 space-x-2">
                                @if ($modalProject['link'] && $modalProject['link'] !== '#')
                                    <a href="{{ $modalProject['link'] }}" target="_blank"
                                        class="px-4 py-2 text-white transition bg-blue-500 rounded-lg hover:bg-blue-600">
                                        View Project
                                    </a>
                                @endif
                                @if ($modalProject['repository'])
                                    <a href="{{ $modalProject['repository'] }}" target="_blank"
                                        class="px-4 py-2 text-white transition bg-green-500 rounded-lg hover:bg-green-600">
                                        GitHub
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="flex justify-end px-6 py-4 bg-gray-100 border-t border-gray-300 dark:bg-gray-900 dark:border-gray-700">
                    <button x-on:click="$wire.set('modalProject', null)"
                        class="px-4 py-2 text-white transition bg-red-500 rounded-lg hover:bg-red-600">
                        Close
                    </button>
                </div>
            </div>

            {{-- Lightbox --}}
            <div x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="fixed inset-0 flex items-center justify-center z-60 bg-black/80 backdrop-blur-sm">
                <div class="relative">
                    <img :src="images[currentImageIndex]" :alt="'Lightbox Image ' + (currentImageIndex + 1)"
                        class="object-contain max-w-full max-h-screen transition-transform duration-300 ease-in-out dark:bg-white">

                    {{-- Close Button --}}
                    <button @click="closeLightbox()"
                        class="absolute p-2 text-white bg-red-500 rounded-full top-4 right-4 hover:bg-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    {{-- Previous Button --}}
                    <template x-if="images.length > 1">
                        <button @click="prevImage()"
                            class="absolute p-3 text-white -translate-y-1/2 rounded-full left-4 top-1/2 bg-black/50 hover:bg-black/70">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                    </template>

                    {{-- Next Button --}}
                    <template x-if="images.length > 1">
                        <button @click="nextImage()"
                            class="absolute p-3 text-white -translate-y-1/2 rounded-full right-4 top-1/2 bg-black/50 hover:bg-black/70">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </template>

                    {{-- Image Counter --}}
                    <template x-if="images.length > 1">
                        <div
                            class="absolute px-3 py-1 text-white transform -translate-x-1/2 rounded-lg bottom-4 left-1/2 bg-black/60">
                            <span x-text="(currentImageIndex + 1) + ' / ' + images.length"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    @endif

</div>
