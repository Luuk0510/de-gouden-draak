@extends('layouts.restaurant')

@section('content')
    <div class="flex flex-col justify-center items-center mt-6">
        @if ($errors->has('error'))
        <div id="dismiss-alert" class="hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert" tabindex="-1" aria-labelledby="hs-dismiss-button-label">
            <div class="flex">
                <div class="shrink-0">
                    <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="m15 9-6 6"></path>
                        <path d="m9 9 6 6"></path>
                      </svg>
                </div>
                <div class="ms-2">
                    <h3 id="hs-dismiss-button-label" class="text-sm font-medium">
                        {{ $errors->first('error') }}
                    </h3>
                </div>
                <div class="ps-3 ms-auto">
                    <div class="-mx-1.5 -my-1.5">
                        <button type="button" class="inline-flex bg-red-50 rounded-lg p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:bg-red-100 transition" data-hs-remove-element="#dismiss-alert">
                            <span class="sr-only">Dismiss</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

        <h1 class="text-3xl font-bold mb-2 text-center">Bestelling beginnen</h1>
        <div class="border-2 border-blue-500 rounded-lg shadow-xl max-w-6xl p-4">
            <form action="{{ route('restaurant.processStartOrder') }}" method="post" class="w-full">
                @csrf
                <input type="hidden" name="current_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                <div class="mb-2">
                    <x-input type="text" min="1" id="order_id" name="order" label="Bestelling nummer" />
                    @error('order')
                        <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <x-input type="text" min="1" id="table_id" name="table" label="Tafel nummer" />
                    @error('table')
                        <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-center mt-4">
                    <button type="submit"
                        class="py-3 px-4 inline-flex items-center gap-x-2 font-bold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 transition">
                        Starten
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
