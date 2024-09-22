@extends('layouts.website')

@section('content')
    <x-website.background>
        <div class="border border-black bg-white mt-12 mx-12">
            <img src="{{ asset('images/menu/restaurant-menukaart-1-2.jpg') }}">
            <img src="{{ asset('images/menu/restaurant-menukaart-1.jpg') }}">
        </div>
        <div class="mt-2 text-center text-lg"><x-website.button route="download.menu" name="website.menu_page.download" /></div>
    </x-website.background>
@endsection
