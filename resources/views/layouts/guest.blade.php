<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('Picture/newLogo.svg') }}" type="image/svg">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @fluxAppearance
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <!-- Navigation -->
        {{-- <nav class="bg-white shadow dark:bg-gray-800">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" wire:navigate class="flex-shrink-0">
                            <x-application-logo class="w-8 h-8 text-blue-600 fill-current" />
                        </a>
                        <div class="hidden md:ml-6 md:flex md:space-x-8">
                            <a href="/" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 dark:text-white hover:text-blue-500">
                                Home
                            </a>
                                @if (Route::has('clients.landing'))
                                    <a href="{{ route('clients.landing') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 dark:text-white hover:text-purple-500">
                                        Clients
                                    </a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav> --}}

        <!-- Main Content -->
        <main>

            {{ $slot }}
            <x-mary-toast />
            @livewireScriptConfig()
            @fluxScripts
        </main>

        {{-- @livewireScripts --}}
    </body>
</html>
