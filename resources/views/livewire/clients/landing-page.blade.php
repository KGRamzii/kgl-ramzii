<div class="min-h-screen bg-slate-100 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors">

    <!-- Hero Section -->
    <section class="container mx-auto px-6 py-20 md:py-28 grid md:grid-cols-2 gap-12 items-center animate-fade-in">
        
        <!-- Text Content -->
        <div class="text-center md:text-left animate-slide-in-left">
            <!-- Availability Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 border rounded-full bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 shadow-sm">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-medium text-green-700 dark:text-green-400">Available for New Projects</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Hi, I'm <span class="gradient-text-primary">{{ $name }}</span>
            </h1>
            <p class="text-xl text-blue-600 dark:text-blue-400 font-semibold mb-6">
                {{ $role }}
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                Whether you need a fresh logo, a professional website, a mobile application, 
                or the complete package — I create solutions that help your business grow and stand out.
            </p>

            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                <a href="#services" 
                   class="px-6 py-3 bg-blue-600 dark:bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition btn-hover-lift shadow-glow-colored">
                    <span class="flex items-center gap-2">
                        Explore Services
                        <x-heroicon-o-arrow-down class="w-5 h-5"/>
                    </span>
                </a>
                <a href="#portfolio" 
                   class="px-6 py-3 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition btn-hover-lift">
                    <span class="flex items-center gap-2">
                        View My Work
                        <x-heroicon-o-eye class="w-5 h-5"/>
                    </span>
                </a>
            </div>
        </div>

        <!-- Your Picture -->
        <div class="flex justify-center md:justify-end animate-slide-in-right">
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-purple-500 rounded-3xl opacity-20 dark:opacity-30 blur-2xl animate-pulse-glow"></div>
                <img src="{{ asset('Picture/Kagiso.png') }}" 
                     alt="Photo of {{ $name }}" 
                     class="relative w-72 h-72 object-cover rounded-2xl shadow-glow border-4 border-white dark:border-gray-800">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gradient-to-b from-gray-200 dark:from-gray-900 to-gray-50 dark:to-gray-950">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto mb-16 text-center animate-slide-up">
                <h2 class="text-4xl font-bold mb-6 gradient-text-primary">Design & Development Solutions</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    Need a logo, a website, a mobile app — or all of the above? 
                    I deliver professional solutions tailored to your business.
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Logo Design -->
                <div class="p-8 card-glass rounded-2xl hover:shadow-glow transition-all duration-300 group btn-hover-lift">
                    <div class="w-14 h-14 flex items-center justify-center mb-4 rounded-xl bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/40 dark:to-purple-900/40 border-2 border-blue-200 dark:border-blue-700 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-swatch class="w-7 h-7 text-blue-600 dark:text-blue-400"/>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">Logo & Branding</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Stand out with a modern, professional logo and brand identity.
                    </p>
                </div>

                <!-- Websites -->
                <div class="p-8 card-glass rounded-2xl hover:shadow-glow transition-all duration-300 group btn-hover-lift">
                    <div class="w-14 h-14 flex items-center justify-center mb-4 rounded-xl bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/40 dark:to-purple-900/40 border-2 border-blue-200 dark:border-blue-700 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-globe-alt class="w-7 h-7 text-blue-600 dark:text-blue-400"/>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">Websites</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Custom websites that look great, load fast, and bring you clients.
                    </p>
                </div>

                <!-- Mobile Apps -->
                <div class="p-8 card-glass rounded-2xl hover:shadow-glow transition-all duration-300 group btn-hover-lift">
                    <div class="w-14 h-14 flex items-center justify-center mb-4 rounded-xl bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/40 dark:to-purple-900/40 border-2 border-blue-200 dark:border-blue-700 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-device-phone-mobile class="w-7 h-7 text-blue-600 dark:text-blue-400"/>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">Mobile Applications</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Easy-to-use apps for Android & iOS to expand your reach.
                    </p>
                </div>

                <!-- Complete Package -->
                <div class="p-8 card-glass rounded-2xl hover:shadow-glow transition-all duration-300 group btn-hover-lift">
                    <div class="w-14 h-14 flex items-center justify-center mb-4 rounded-xl bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/40 dark:to-purple-900/40 border-2 border-blue-200 dark:border-blue-700 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-cube class="w-7 h-7 text-blue-600 dark:text-blue-400"/>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">Complete Package</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Logo, website, and mobile app — all consistent and aligned with your brand.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Highlights -->
    <section class="py-20 bg-white dark:bg-gray-950">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <h2 class="text-4xl font-bold mb-6 gradient-text-primary">My Expertise</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">Core competencies that drive exceptional results</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 max-w-6xl mx-auto">
                @foreach ($highlights as $index => $highlight)
                    <div class="p-6 card-glass rounded-xl hover:shadow-glow transition-all duration-300 border-l-4 border-blue-500 dark:border-blue-400 btn-hover-lift"
                         style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-blue-600 dark:text-blue-400"/>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">{{ $highlight }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 bg-gradient-to-b from-gray-50 dark:from-gray-900 to-white dark:to-gray-950">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <h2 class="text-4xl font-bold mb-6 gradient-text-primary">Featured Projects</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">A selection of my recent work</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                @foreach ($projects as $project)
                    <article
                        wire:click="$set('modalProject', {{ json_encode($project) }})"
                        class="cursor-pointer card-glass rounded-2xl overflow-hidden hover:shadow-glow transition-all duration-300 group btn-hover-lift"
                    >
                        <div class="relative h-64 overflow-hidden bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/20 dark:to-purple-900/20">
                            @if (!empty($project['preview']))
                                <img 
                                    src="{{ Storage::url($project['preview']) }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                    alt="{{ $project['name'] }}"
                                >
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="text-white font-semibold flex items-center gap-2">
                                    View Details
                                    <x-heroicon-o-arrow-right class="w-5 h-5"/>
                                </span>
                            </div>

                            <!-- Status Badge -->
                            <span class="absolute top-4 right-4 px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full {{ $project['status'] === 'In Progress' ? 'bg-orange-500' : 'bg-green-500' }} text-white shadow-lg">
                                {{ $project['status'] }}
                            </span>
                        </div>

                        <div class="p-6 bg-white dark:bg-gray-900/50">
                            <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $project['name'] }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2 mb-4">{{ $project['description'] }}</p>
                            
                            <!-- Tech Stack -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach (array_slice($project['technologies'], 0, 3) as $tech)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                                @if (count($project['technologies']) > 3)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-700">
                                        +{{ count($project['technologies']) - 3 }}
                                    </span>
                                @endif
                            </div>

                            <!-- Meta -->
                            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                                <span class="flex items-center gap-1">
                                    <x-heroicon-o-clock class="w-4 h-4"/>
                                    {{ $project['timeline'] }}
                                </span>
                                <span class="px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-medium">
                                    {{ $project['difficulty'] }}
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-white dark:bg-gray-950">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <h2 class="text-4xl font-bold mb-6 gradient-text-primary">What Clients Say</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">Some kind words from people I've worked with</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach ($testimonials as $index => $testimonial)
                    <div class="p-8 card-glass rounded-2xl hover:shadow-glow transition-all duration-300 btn-hover-lift">
                        <!-- Quote Icon -->
                        <x-heroicon-o-chat-bubble-left-ellipsis class="w-10 h-10 text-blue-400 dark:text-blue-500 mb-4"/>
                        
                        <p class="text-gray-700 dark:text-gray-300 mb-6 italic">"{{ $testimonial['quote'] }}"</p>
                        
                        <!-- Rating -->
                        <div class="mb-6 flex gap-1">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $testimonial['rating'])
                                    <x-heroicon-s-star class="w-5 h-5 text-yellow-400"/>
                                @else
                                    <x-heroicon-o-star class="w-5 h-5 text-gray-300 dark:text-gray-600"/>
                                @endif
                            @endfor
                        </div>

                        <div class="flex items-center gap-4">
                            <img src="{{ asset($testimonial['photo']) }}" 
                                 alt="{{ $testimonial['name'] }}" 
                                 class="w-12 h-12 rounded-full object-cover border-2 border-blue-200 dark:border-blue-700"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($testimonial['name']) }}&background=3b82f6&color=fff'">
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $testimonial['name'] }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $testimonial['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gradient-to-b from-gray-50 dark:from-gray-900 to-white dark:to-gray-950">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2 class="text-4xl font-bold mb-6 gradient-text-primary">Let's Work Together</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">Have a project in mind? Reach out and let's make it real.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-12">
                <!-- Email Card -->
                <a href="{{ $socialLinks['email'] }}" 
                   class="group p-10 card-glass rounded-2xl hover:shadow-glow transition-all duration-300 btn-hover-lift">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center mb-4 rounded-full bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/40 dark:to-purple-900/40 border-2 border-blue-200 dark:border-blue-700 group-hover:scale-110 transition-transform">
                            <x-heroicon-o-envelope class="w-8 h-8 text-blue-600 dark:text-blue-400"/>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-gray-100">Email Me</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">For detailed inquiries and professional correspondence</p>
                        <span class="text-blue-600 dark:text-blue-400 font-semibold group-hover:gap-3 transition-all inline-flex items-center gap-2">
                            kagiso1382@gmail.com
                            <x-heroicon-o-arrow-right class="w-5 h-5"/>
                        </span>
                    </div>
                </a>

                <!-- WhatsApp Card -->
                <a href="{{ $socialLinks['whatsapp'] }}" target="_blank"
                   class="group p-10 card-glass rounded-2xl hover:shadow-glow transition-all duration-300 btn-hover-lift">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center mb-4 rounded-full bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/40 dark:to-emerald-900/40 border-2 border-green-200 dark:border-green-700 group-hover:scale-110 transition-transform">
                            <x-heroicon-o-chat-bubble-left-right class="w-8 h-8 text-green-600 dark:text-green-400"/>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-gray-100">WhatsApp</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Quick response for urgent questions</p>
                        <span class="text-green-600 dark:text-green-400 font-semibold group-hover:gap-3 transition-all inline-flex items-center gap-2">
                            Start a conversation
                            <x-heroicon-o-arrow-right class="w-5 h-5"/>
                        </span>
                    </div>
                </a>
            </div>

            <!-- Why Work With Me -->
            <div class="max-w-4xl mx-auto p-10 rounded-3xl bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-950/30 dark:to-purple-950/30 border-2 border-blue-100 dark:border-blue-800 shadow-glow">
                <h3 class="text-2xl font-bold text-center mb-8 text-gray-900 dark:text-gray-100">Why Partner With Me?</h3>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 mb-4 rounded-full bg-white dark:bg-gray-800 border-2 border-blue-200 dark:border-blue-700 shadow-sm">
                            <x-heroicon-o-code-bracket class="w-7 h-7 text-blue-600 dark:text-blue-400"/>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-2">Modern Tech Stack</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Built with the latest technologies for optimal performance</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 mb-4 rounded-full bg-white dark:bg-gray-800 border-2 border-blue-200 dark:border-blue-700 shadow-sm">
                            <x-heroicon-o-chat-bubble-bottom-center-text class="w-7 h-7 text-blue-600 dark:text-blue-400"/>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-2">Clear Communication</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Regular updates and transparent project management</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 mb-4 rounded-full bg-white dark:bg-gray-800 border-2 border-blue-200 dark:border-blue-700 shadow-sm">
                            <x-heroicon-o-shield-check class="w-7 h-7 text-blue-600 dark:text-blue-400"/>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-2">Reliable & Secure</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Enterprise-grade security and dependability</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4"
            @keydown.escape.window="closeModal()"
            wire:click.self="$set('modalProject', null)"
        >
            <div 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white dark:bg-gray-900 rounded-3xl max-w-5xl w-full max-h-[90vh] overflow-y-auto shadow-glow relative border border-gray-200 dark:border-gray-700"
            >
                <!-- Close Button -->
                <button 
                    @click="closeModal()"
                    class="absolute top-6 right-6 z-10 p-2 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors shadow-md"
                >
                    <x-heroicon-o-x-mark class="w-6 h-6 text-gray-700 dark:text-gray-300"/>
                </button>

                <div class="p-8 md:p-12">
                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Image Gallery -->
                        <div class="space-y-4">
                            <div class="relative h-80 overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700">
                                <template x-if="images.length > 0">
                                    <img
                                        :src="images[currentImageIndex]"
                                        class="object-contain w-full h-full"
                                        alt="Project screenshot"
                                    />
                                </template>

                                <!-- Navigation Arrows -->
                                <template x-if="images.length > 1">
                                    <div>
                                        <button
                                            @click="currentImageIndex = (currentImageIndex - 1 + images.length) % images.length"
                                            class="absolute left-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-800 shadow-lg transition-colors"
                                        >
                                            <x-heroicon-o-chevron-left class="w-6 h-6 text-gray-700 dark:text-gray-300"/>
                                        </button>
                                        <button
                                            @click="currentImageIndex = (currentImageIndex + 1) % images.length"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-800 shadow-lg transition-colors"
                                        >
                                            <x-heroicon-o-chevron-right class="w-6 h-6 text-gray-700 dark:text-gray-300"/>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <!-- Thumbnails -->
                            <template x-if="images.length > 1">
                                <div class="flex gap-3 overflow-x-auto pb-2">
                                    <template x-for="(image, index) in images" :key="index">
                                        <img
                                            :src="image"
                                            @click="currentImageIndex = index"
                                            :class="{'ring-2 ring-blue-500 dark:ring-blue-400': currentImageIndex === index, 'opacity-50': currentImageIndex !== index}"
                                            class="w-20 h-20 object-cover rounded-lg cursor-pointer hover:opacity-100 transition-all flex-shrink-0 border-2 border-gray-200 dark:border-gray-700"
                                        />
                                    </template>
                                </div>
                            </template>
                        </div>

                        <!-- Project Details -->
                        <div class="space-y-6">
                            <div>
                                <span class="inline-block px-3 py-1 mb-4 text-xs font-bold uppercase tracking-wider rounded-full {{ $modalProject['status'] === 'In Progress' ? 'bg-orange-100 dark:bg-orange-900/40 text-orange-700 dark:text-orange-400' : 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' }}">
                                    {{ $modalProject['status'] }}
                                </span>
                                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $modalProject['name'] }}</h2>
                                <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">{{ $modalProject['description'] }}</p>
                            </div>

                            <!-- Technologies -->
                            <div>
                                <h3 class="text-sm font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 mb-3">Technologies Used</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($modalProject['technologies'] as $tech)
                                        <span class="px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700 font-medium text-sm">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Project Info Grid -->
                            <div class="grid grid-cols-2 gap-4 p-6 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Difficulty</p>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $modalProject['difficulty'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Timeline</p>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $modalProject['timeline'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Completed</p>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ date('M Y', strtotime($modalProject['completion_date'])) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Category</p>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $modalProject['category'] }}</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-4 pt-4">
                                @if ($modalProject['link'] && $modalProject['link'] !== '#')
                                    <a
                                        href="{{ $modalProject['link'] }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white rounded-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl btn-hover-lift"
                                    >
                                        <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5"/>
                                        View Live Project
                                    </a>
                                @endif
                                @if ($modalProject['repository'])
                                    <a
                                        href="{{ $modalProject['repository'] }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 px-6 py-3 font-semibold rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 border-2 border-gray-300 dark:border-gray-600 transition-all btn-hover-lift"
                                    >
                                        <x-heroicon-o-code-bracket class="w-5 h-5"/>
                                        View Source Code
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>