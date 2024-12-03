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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-blue-500 text-white py-4 shadow-md">
                    <div class="container mx-auto flex justify-between items-center">
                        <h1 class="text-xl font-bold"><a href="{{ url('/') }}">Mon Application</a></h1>
                        <nav class="space-x-4">
                            <a href="{{ route('eleves.index') }}" class="hover:underline">Élèves</a>
                            <a href="{{ route('evaluations.index') }}" class="hover:underline">Évaluations</a>
                            <a href="{{ route('modules.index') }}" class="hover:underline">Modules</a>
                            <a href="{{ route('evaluations_eleves.index') }}" class="hover:underline">Évaluations Élèves</a>
                        </nav>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <div class="container">
                @yield('content')
            </div>
        </div>
    </body>
</html>
