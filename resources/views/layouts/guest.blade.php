<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Kagiso Ramogayana — Full Stack Developer' }}</title>
        <meta name="description" content="{{ $description ?? 'Full Stack Developer specialising in Laravel, Livewire, and cloud-native solutions. Based in Johannesburg, South Africa.' }}">

        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $title ?? 'Kagiso Ramogayana — Full Stack Developer' }}">
        <meta property="og:description" content="{{ $description ?? 'Full Stack Developer specialising in Laravel, Livewire, and cloud-native solutions.' }}">
        <meta property="og:image" content="{{ asset('Picture/Kagiso.png') }}">

        <link rel="icon" href="{{ asset('Picture/newLogo.svg') }}" type="image/svg">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preload" as="style" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @fluxAppearance
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <main>
            {{ $slot }}
            <x-mary-toast />
            @livewireScriptConfig()
            @fluxScripts
        </main>
    </body>
</html>
