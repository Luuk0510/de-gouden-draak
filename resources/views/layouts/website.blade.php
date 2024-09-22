<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Golden Dragon')</title>
    @vite('resources/css/website.css')
    @vite('resources/js/app.js')
</head>
<body>
    <main>
        <div id="website">
            @yield('content')
        </div>
    </main>
</body>
</html>
