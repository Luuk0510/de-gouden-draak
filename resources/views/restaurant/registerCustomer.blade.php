@extends('layouts.restaurant')

@section('content')
    <form method="POST" action="{{ route('restaurant.storeCustomer') }}">
        @csrf
        <div id="registerCustomer" class="flex flex-col justify-center items-center">
            <!-- H1 title centered -->
            <h1 class="text-3xl font-bold mb-4 text-center">Nieuwe klant registeren</h1>
            <div class="border-2 border-blue-500 rounded-lg shadow-xl max-w-6xl">
                <div class="mx-10 my-4">
                    <div class="mb-4">
                        <div class="max-w-64 mb-1">
                            <x-input type="text" id="firstname" name="firstname" label="Voornaam" />
                            @error('firstname')
                                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="max-w-64 mb-1">
                            <x-input type="text" id="infix" name="infix" label="Tussenvoegsel" />
                            @error('infix')
                                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="max-w-64 mb-1">
                            <x-input type="text" id="surname" name="surname" label="Achternaam" />
                            @error('surname')
                                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="max-w-64 mb-4">
                            <x-input type="date" id="birthday_0" name="birthday[0]" label="Geboortedatum" />
                            @error('birthday.0')
                                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="flex my-4">
                            <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 transition"
                                name="extra_menu" id="extra-deluxe-menu">
                            <label for="extra-deluxe-menu" class="text-sm ms-3">Extra DELUXE menu</label>
                        </div>
                        @error('extra_menu')
                            <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                        @enderror
                        <div class="max-w-64 mb-4">
                            <select name="table"
                                class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition">
                                <option selected disabled>Kies een tafel</option>
                                @foreach ($tafels as $tafel)
                                    <option value="{{ $tafel->id }}">
                                        Tafel nummer: {{ $tafel->id }} - Capaciteit: {{ $tafel->capiciteit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tafel_nummer')
                                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <h1 class="text-xl font-bold mb-2 mt-4 text-center">Extra personen</h1>
                    <person-form></person-form>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="py-3 px-4 inline-flex items-center gap-x-2 font-bold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 transition">
                            Registeren
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
