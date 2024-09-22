@extends('layouts.website')

@section('content')
    <x-website.background>
        <div class="border border-black bg-white p-5 mt-12 mx-12 font-bold text-xl">
            <p>{{ __('website.news_page.first') }}</p>
            <p>{{ __('website.news_page.second') }}</p>
        </div>
    </x-website.background>
@endsection
