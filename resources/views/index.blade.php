@extends('layouts.website')

@section('content')
    <x-website.background>
        <div class="border border-black bg-white p-5 mt-12 mx-12 font-bold">
            <p class="text-lg mb-10">{{ __('website.index_page.first') }}<br>{{ __('website.index_page.second') }}</p>
            <h2 class="text-2xl mb-4 underline">{{ __('website.index_page.student_discound') }}</h2>
            <h3 class="text-3xl mb-4">{{ __('website.index_page.chinese_rice_table') }}</h3>
            <p class="text-lg mb-4">{{ __('website.index_page.choose_dishe') }}</p>
            <div class="text-lg grid grid-cols-2 mb-4 mx-auto">
                <div class="text-right pr-20">
                    <p>{{ __('website.index_page.first_dishe') }}</p>
                    <p>{{ __('website.index_page.second_dishe') }}</p>
                    <p>{{ __('website.index_page.third_dish') }}</p>
                </div>
                <div class="text-left pl-20">
                    <p>{{ __('website.index_page.fourth_dish') }}</p>
                    <p>{{ __('website.index_page.fifth_dish') }}</p>
                    <p>{{ __('website.index_page.sixth_dish') }}</p>
                </div>
            </div>

            <p class="mb-4">{{ __('website.index_page.side_dishe') }}</p>
            <p class="text-3xl">{{ __('website.index_page.price') }}</p>
        </div>
    </x-website.background>
@endsection
