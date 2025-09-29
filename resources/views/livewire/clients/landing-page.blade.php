
<div>
    <div class="min-h-screen bg-gradient-to-b from-blue-900 to-black text-white">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 to-black/90"></div>
        </div>

        <div class="container relative z-10 px-4 py-20 mx-auto">
            <div class="max-w-5xl mx-auto text-center">
                <h1 class="mb-6 text-4xl font-bold md:text-6xl animate-fade-in">
                    Welcome to Your Digital Success Partner
                </h1>
                <p class="max-w-2xl mx-auto mb-8 text-xl text-blue-300 animate-fade-in-up">
                    Transform your ideas into powerful digital solutions. Let's create exceptional web experiences together.
                </p>
                <div class="flex flex-wrap justify-center gap-4 animate-fade-in-up">
                    <a href="{{ route('register') }}" class="px-8 py-3 text-lg font-semibold text-white transition-all bg-purple-600 rounded-lg hover:bg-purple-700 hover:scale-105">
                        Start Your Project
                    </a>
                    <a href="#services" class="px-8 py-3 text-lg font-semibold transition-all border rounded-lg text-blue-300 border-blue-300 hover:bg-blue-300 hover:text-blue-900 hover:scale-105">
                        Explore Services
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Professional Expertise -->
    <div id="services" class="py-20 bg-gradient-to-b from-blue-900/50 to-black/50">
        <div class="container px-4 mx-auto">
            <div class="max-w-4xl mx-auto mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold">Professional Expertise</h2>
                <p class="text-blue-300">Delivering high-quality solutions across multiple domains</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->highlights as $highlight)
                    <div class="p-6 transition-all bg-blue-800/30 rounded-xl hover:bg-blue-800/40 hover:scale-105">
                        <h3 class="mb-3 text-xl font-semibold">{{ Str::title($highlight) }}</h3>
                        <p class="text-blue-300">{{ $highlight }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Portfolio Showcase -->
    <div id="portfolio" class="py-20 bg-gradient-to-b from-blue-900/50 to-black/50">
        <div class="container px-4 mx-auto">
            <div class="max-w-4xl mx-auto mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold">Featured Projects</h2>
                <p class="text-blue-300">Explore my latest work and innovative solutions</p>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @foreach ($projects as $project)
                    <article
                        wire:click="$set('modalProject', {{ json_encode($project) }})"
                        class="transition-all duration-300 transform rounded-lg shadow-lg cursor-pointer bg-blue-800/30 hover:bg-blue-800/40 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 group"
                        tabindex="0"
                        role="button"
                        aria-label="View details for {{ $project['name'] }}"
                        @keydown.enter="$wire.set('modalProject', {{ json_encode($project) }})"
                    >
                        <!-- Project Preview Image -->
                        <div class="relative h-48 overflow-hidden rounded-t-lg">
                            @if (!empty($project['preview']))
                                <img
                                    src="{{ asset($project['preview']) }}"
                                    alt="{{ $project['name'] }} Preview"
                                    loading="lazy"
                                    class="absolute inset-0 object-cover w-full h-full transition-all duration-500 ease-in-out transform opacity-80 group-hover:opacity-100 scale-100 group-hover:scale-110 brightness-90 group-hover:brightness-100 blur-[1px] group-hover:blur-none"
                                    width="300"
                                    height="200"
                                />
                            @else
                                <div class="absolute inset-0 flex items-center justify-center w-full h-full bg-blue-800/30">
                                    <span class="text-xl font-semibold text-blue-300">
                                        Coming Soon
                                    </span>
                                </div>
                            @endif

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/40"></div>

                            <!-- Status Badge -->
                            <span class="absolute px-3 py-1 text-xs font-semibold text-white rounded-full top-3 left-3 {{ $project['status'] === 'In Progress' ? 'bg-orange-500' : ($project['status'] === 'Completed' ? 'bg-green-500' : 'bg-gray-500') }}">
                                {{ $project['status'] }}
                            </span>
                        </div>

                        <!-- Project Details -->
                        <div class="p-5">
                            <h3 class="mb-2 text-xl font-bold text-white">
                                {{ $project['name'] }}
                            </h3>
                            <p class="mb-4 text-blue-300 line-clamp-2">
                                {{ $project['description'] }}
                            </p>

                            <!-- Technologies -->
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($project['technologies'] as $tech)
                                    <span class="px-2 py-1 text-xs text-blue-200 bg-blue-800/50 rounded-full">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>

                            <!-- Project Meta Info -->
                            <div class="flex items-center justify-between text-xs text-blue-300">
                                <span>{{ $project['difficulty'] }}</span>
                                <span>{{ $project['timeline'] }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Contact & Portal Section -->
    <div class="py-20 bg-gradient-to-b from-black/50 to-blue-900/50">
        <div class="container px-4 mx-auto">
            <div class="max-w-5xl mx-auto">
                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Contact Options -->
                    <div class="p-8 bg-blue-800/30 rounded-xl">
                        <h2 class="mb-6 text-2xl font-bold">Let's Connect</h2>
                        <div class="space-y-6">
                            <!-- Email Option -->
                            <a href="{{ $this->socialLinks['email'] }}" class="flex items-start p-4 transition-all bg-blue-800/30 rounded-lg hover:bg-blue-800/50 group">
                                <div class="p-3 mr-4 bg-blue-700 rounded-full">
                                    <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-blue-300">Email Us</h3>
                                    <p class="mt-2 text-blue-200">Professional correspondence</p>
                                    <span class="inline-block mt-3 text-blue-400 group-hover:text-blue-300">
                                        kagiso1382@gmail.com →
                                    </span>
                                </div>
                            </a>

                            <!-- WhatsApp Option -->
                            <a href="{{ $this->socialLinks['whatsapp'] }}" target="_blank" class="flex items-start p-4 transition-all bg-blue-800/30 rounded-lg hover:bg-blue-800/50 group">
                                <div class="p-3 mr-4 bg-blue-700 rounded-full">
                                    <svg class="w-6 h-6 text-blue-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-blue-300">WhatsApp</h3>
                                    <p class="mt-2 text-blue-200">Quick and convenient chat</p>
                                    <span class="inline-block mt-3 text-blue-400 group-hover:text-blue-300">
                                        Start Chat →
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="p-8 bg-blue-800/30 rounded-xl">
                        <h2 class="mb-6 text-2xl font-bold">Why Work With Me</h2>
                        <p class="mb-8 text-blue-300">I offer professional web development services with a focus on quality, communication, and timely delivery.</p>

                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-white">What You Get</h3>
                            <ul class="space-y-4 text-blue-300">
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 mr-3 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Professional web development with modern technologies</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 mr-3 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Clear communication and regular project updates</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 mr-3 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Secure and reliable web solutions</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Project Modal -->
        @if ($modalProject)
        <div
            x-data="{
                open: true,
                currentImageIndex: 0,
                images: {{ json_encode($modalProject['screenshots'] ?? []) }},
                closeModal() {
                    $wire.set('modalProject', null);
                }
            }"
            x-init="$watch('open', value => { document.body.style.overflow = value ? 'hidden' : 'auto'; })"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-title"
            @keydown.escape.window="closeModal()"
        >
            <div class="bg-blue-900/90 rounded-lg shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-blue-800">
                    <h3 id="modal-title" class="text-2xl font-bold text-white">
                        {{ $modalProject['name'] }}
                    </h3>
                    <button
                        @click="closeModal()"
                        class="p-1 text-blue-300 hover:text-white"
                        aria-label="Close modal"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6 space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <!-- Media Section -->
                        <div>
                            <!-- Image Viewer -->
                            <div class="space-y-4">
                                <div class="relative h-64 overflow-hidden rounded-lg">
                                    <template x-if="images.length > 0">
                                        <img
                                            :src="images[currentImageIndex]"
                                            :alt="'{{ $modalProject['name'] }} Screenshot ' + (currentImageIndex + 1)"
                                            class="object-contain w-full h-full transition-transform duration-300 ease-in-out bg-blue-800/30"
                                            loading="lazy"
                                        />
                                    </template>

                                    <!-- Navigation Arrows -->
                                    <template x-if="images.length > 1">
                                        <div>
                                            <button
                                                @click="currentImageIndex = (currentImageIndex - 1 + images.length) % images.length"
                                                class="absolute p-2 text-white transform -translate-y-1/2 rounded-full left-2 top-1/2 bg-black/50 hover:bg-black/70"
                                            >
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            <button
                                                @click="currentImageIndex = (currentImageIndex + 1) % images.length"
                                                class="absolute p-2 text-white transform -translate-y-1/2 rounded-full right-2 top-1/2 bg-black/50 hover:bg-black/70"
                                            >
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>

                                <!-- Thumbnails -->
                                <template x-if="images.length > 1">
                                    <div class="flex pb-2 space-x-2 overflow-x-auto">
                                        <template x-for="(image, index) in images" :key="index">
                                            <img
                                                :src="image"
                                                @click="currentImageIndex = index"
                                                :class="{
                                                    'border-2 border-blue-500': currentImageIndex === index,
                                                    'opacity-60': currentImageIndex !== index
                                                }"
                                                class="flex-shrink-0 object-cover w-16 h-16 transition-all duration-300 rounded-lg cursor-pointer hover:opacity-100 bg-blue-800/30"
                                                loading="lazy"
                                            />
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Project Details -->
                        <div class="space-y-4">
                            <p class="leading-relaxed text-blue-200">
                                {{ $modalProject['description'] }}
                            </p>

                            <!-- Technologies -->
                            <div>
                                <h4 class="mb-2 font-semibold text-white">Technologies</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($modalProject['technologies'] as $tech)
                                        <span class="px-3 py-1 text-sm text-blue-200 bg-blue-800/50 rounded-full">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Project Info Grid -->
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-semibold text-white">Difficulty:</span>
                                    <span class="block text-blue-300">{{ $modalProject['difficulty'] }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold text-white">Timeline:</span>
                                    <span class="block text-blue-300">{{ $modalProject['timeline'] }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold text-white">Completed:</span>
                                    <span class="block text-blue-300">{{ $modalProject['completion_date'] }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold text-white">Status:</span>
                                    <span class="block text-blue-300">{{ $modalProject['status'] }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-3 pt-4">
                                @if ($modalProject['link'] && $modalProject['link'] !== '#')
                                    <a
                                        href="{{ $modalProject['link'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center px-4 py-2 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        View Project
                                    </a>
                                @endif
                                @if ($modalProject['repository'])
                                    <a
                                        href="{{ $modalProject['repository'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center px-4 py-2 text-white transition bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                    >
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
                                        </svg>
                                        View Code
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end px-6 py-4 border-t border-blue-800">
                    <button
                        @click="closeModal()"
                        class="px-6 py-2 text-white transition bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
