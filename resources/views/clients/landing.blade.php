<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-100 to-purple-200 dark:from-blue-900/40 dark:to-purple-900/40 py-12">
        <!-- Logo -->
        <div class="mb-8 flex justify-center">
            <img src="{{ asset('Picture/Logo.svg') }}" alt="Logo" class="h-20 w-auto drop-shadow-lg" />
        </div>
    <div class="w-full max-w-6xl mx-auto px-6 py-12 bg-white/90 dark:bg-gray-900/90 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-800">
        <h1 class="text-5xl font-extrabold mb-6 text-gray-900 dark:text-white tracking-tight text-center">Welcome, Clients!</h1>
        <p class="mb-10 text-xl text-gray-700 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed text-center">This portal is dedicated to our valued clients and those interested in working together. You can send inquiries, request quotes, or get in touch for support.</p>

        <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white text-center">Let's Work Together</h2>
        <p class="mb-10 text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-center">Have a project in mind or just want to say hello? I'd love to hear from you. Fill out the form below or reach out through any of the contact methods.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-10">
            <div class="w-full">
                @livewire('portfolio.contact')
            </div>
            <div class="w-full flex flex-col justify-center items-center">
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 p-8 rounded-2xl shadow-lg w-full">
                    <h3 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-white text-center">Contact Information</h3>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center justify-center w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <div>
                                <span class="block text-gray-800 dark:text-white font-medium">Email</span>
                                <a href="mailto:kagiso1382@gmail.com" class="text-blue-600 dark:text-blue-400 hover:underline">kagiso1382@gmail.com</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center justify-center w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <div>
                                <span class="block text-gray-800 dark:text-white font-medium">Phone</span>
                                <a href="tel:+27817342820" class="text-green-600 dark:text-green-400 hover:underline">+27 81 734 2820</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center justify-center w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <div>
                                <span class="block text-gray-800 dark:text-white font-medium">Location</span>
                                <span class="text-gray-600 dark:text-gray-400">Johannesburg, South Africa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-center items-center gap-6 mt-8">
            <a href="{{ route('login') }}" class="px-8 py-4 rounded-xl bg-blue-600 text-white font-bold text-lg shadow hover:bg-blue-700 transition">Client Login</a>
            <a href="{{ route('register') }}" class="px-8 py-4 rounded-xl bg-purple-600 text-white font-bold text-lg shadow hover:bg-purple-700 transition">Register as a Client</a>
        </div>
    </div>
</x-guest-layout>
