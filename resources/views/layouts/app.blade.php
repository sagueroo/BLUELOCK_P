{{--Base de toute nos pages, crée initialement avec Laravel et modifié pour notre projet--}}
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
        @vite(['resources/css/app.css','resources/js/app.js'])

    </head>
    <body class="bg-white ">
    <div class="sidebar">
        @include('components.sidebar')
    </div>


    <div class="min-h-screen bg-white max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 taille">
        <!-- Page Content -->


                {{ $slot }}

        </div>
    </body>
<style>

    .min-h-screen {
        height: 1%;
        overflow: auto;
    }


    .taille {
        width: 65%;
   }

</style>
</html>
