<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GoodPay Kassa')</title>
    @vite('resources/css/register.css')
    @vite('resources/js/app.js')
</head>
<body class="m-2 bg-gray-100">
    <x-register.header />
        <main>
            @yield('content')
        </main>
</body>
</html>
