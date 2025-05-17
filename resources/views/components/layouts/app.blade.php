<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance

</head>

<body class="font-sans antialiased min-h-screen bg-white dark:bg-zinc-800">
    {{--
    <livewire:layout.navigation />

    <!-- Page Heading -->
    @if (isset($header))
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endif --}}

    <livewire:sidebar />
    {{-- <flux:main>
        <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>

        <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>

        <flux:separator variant="subtle" />
    </flux:main> --}}

    <!-- Page Content -->
    <flux:main>
        {{ $slot }}
    </flux:main>
    @fluxScripts

</body>

</html>