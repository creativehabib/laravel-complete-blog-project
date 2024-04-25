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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <style>
            /* width */
            ::-webkit-scrollbar {
                width: .3rem;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                border-radius: 4px;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: gray;
                transition:all .5s;
                border-radius: 4px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: goldenrod;
            }

        </style>
    </head>
    <body class="font-sans antialiased">
        @include('layouts.navigation')

        @include('layouts.sidebar')
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
          <div class="p-4 sm:ml-64">
             <div class="p-4 rounded-lg mt-14">
                 <!-- Page Content -->
                {{ $slot }}
             </div>
          </div>
        </div>
    </body>
</html>
