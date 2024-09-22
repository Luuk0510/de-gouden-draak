@props(['route', 'name'])

<a href="{{ route($route) }}" class="bg-menu-bg-gradient border border-white text-white px-7 py-1">
    {{ __($name) }}
</a>