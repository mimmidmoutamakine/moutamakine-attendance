<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Moutamakine') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 via-sky-50 to-orange-50">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 py-4 sm:py-6">
                {{-- Top navigation --}}
                @include('layouts.navigation')

                {{-- Page content --}}
                <main class="mt-5 sm:mt-6 lg:mt-8">
                    <div class="section-card p-4">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>