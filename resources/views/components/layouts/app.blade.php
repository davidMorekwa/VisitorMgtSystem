<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @livewireStyles
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        @vite('resources/css/app.css')
        <title>SASRA VMS</title>
    </head>
    <body class="font-serif">
        {{ $slot }}
        {{-- @yield('content') --}}
        
        @livewireScripts
    </body>
    <x-footer />
</html>
