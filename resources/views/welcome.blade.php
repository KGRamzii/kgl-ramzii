<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Kagiso Ramogayana - Portfolio">
    <meta name="author" content="Kagiso Ramogayana">
    <title>{{ config('app.name', 'Kagiso Ramogayana - Portfolio') }}</title>
    <link rel="icon" href="{{ asset('Picture/newLogo2.svg') }}" type="image/svg">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="min-h-screen font-sans antialiased bg-light-background dark:bg-dark-background text-light-text-dark dark:text-white">
    <div id="app">
        <livewire:portfolio />
    </div>

    @livewireScripts
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

</body>

</html>
