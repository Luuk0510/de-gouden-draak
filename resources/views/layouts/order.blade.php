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
<body class="background">
    <header class="bg-customRed shadow-2xl">
        <div class="text-center text-yellow font-chinese text-4xl">
            <img src="/images/dragon-small.png" alt="Golden Dragon" class="inline h-16 align-middle">
            <span class="align-middle">{{ __('website.golden_dragon') }}</span>
            <img src="/images/dragon-small-flipped.png" alt="Golden Dragon" class="inline h-16 align-middle">
        </div>
    </header>
    
    <main class="m-2">
        @yield('content')
    </main>
</body>
</html>
