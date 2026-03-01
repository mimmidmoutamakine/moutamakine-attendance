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
        <div class="min-h-screen bg-gradient-to-br from-slate-50 via-sky-50 to-orange-50 flex items-center justify-center px-4">
            <div class="w-full max-w-md">
                <div class="flex flex-col items-center mb-6">
                    <div class="mb-3">
                        <x-application-logo class="h-14 w-auto" />
                    </div>
                    <h1 class="text-xl font-semibold text-slate-900 tracking-tight">
                        Moutamakine Attendance
                    </h1>
                    <p class="text-xs text-slate-500 mt-1 text-center">
                        Designed for teachers – quick, simple, classroom-friendly.
                    </p>
                </div>

                <div class="section-card px-6 py-6 sm:px-8 sm:py-7">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>