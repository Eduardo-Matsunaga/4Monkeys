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
    </head>
    <body class="font-sans text-gray-800 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500  to-purple-900 dark:bg-gray-900">
            <div class="w-full sm:max-w-md bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">
                <!-- Logo do login -->
                
    
                <!-- Logo adicional com o link (opcional) -->
                <div class="flex justify-center p-4">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-100 dark:text-gray-200" />
                    </a>
                </div>
    
                <!-- Conteúdo de login -->
                <div class="p-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
    
</html>
