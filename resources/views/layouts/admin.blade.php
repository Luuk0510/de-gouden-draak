<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/website.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-gray-800 p-4 shadow-lg">
            <div class="container mx-auto flex justify-between">
                <a href="{{ route('admin.index') }}" class="text-white text-lg font-semibold">Admin Paneel</a>
                <div>
                    <a href="{{ route('admin.dishes.index') }}" class="text-gray-300 hover:text-white ml-4">gerechten</a>
                    <a href="{{ route('planning.index') }}" class="text-gray-300 hover:text-white ml-4">planning</a>
                    <a href="{{ route('logout') }}" class="text-gray-300 hover:text-white ml-4">Logout</a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white text-center p-4">
            &copy; {{ date('Y') }} De gouden draak. All Rights Reserved.
        </footer>
    </div>
</body>
</html>
