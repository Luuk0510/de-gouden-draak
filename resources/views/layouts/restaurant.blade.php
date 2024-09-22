<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Restaurant')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/restaurant.css')
    @vite('resources/js/app.js')
</head>
<body class="m-2">
    <x-restaurant.header />
    <main>
        @yield('content')
    </main>
</body>
</html>
