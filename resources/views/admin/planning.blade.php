@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Weekplanning Maken</h1>

    <!-- Week selectie -->
    <form method="GET" action="{{ route('planning.index') }}" class="bg-white shadow-md rounded p-6 mb-6">
        <div class="form-group">
            <label for="week" class="block text-gray-700">Kies een Week:</label>
            <input type="week" name="week" id="week" class="form-control block w-full mt-1" value="{{ request('week') ?? now()->format('Y-\WW') }}">
        </div>
        <button type="submit" class="btn bg-blue-500 text-white mt-4 hover:bg-blue-600">Week Laden</button>
    </form>

    <!-- Centraal Formulier voor Inplanning -->
    <form method="POST" action="{{ route('planning.store') }}" class="bg-white shadow-md rounded p-6 mb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="dag" class="block text-gray-700">Dag van de Week:</label>
                <select name="dag" id="dag" class="form-control block w-full mt-1">
                    @foreach($dagen as $dagNaam => $tafels)
                        <option value="{{ \Carbon\Carbon::parse(request('week'))->startOfWeek()->addDays($loop->index)->toDateString() }}">{{ $dagNaam }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tafel" class="block text-gray-700">Kies een Tafel:</label>
                <select name="tafel" id="tafel" class="form-control block w-full mt-1">
                    @foreach($tafels->unique('id') as $tafel)
                        <option value="{{ $tafel->id }}">Tafel {{ $tafel->id }} (Capaciteit: {{ $tafel->capiciteit }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="medewerker" class="block text-gray-700">Kies een Medewerker:</label>
                <select name="medewerker" id="medewerker" class="form-control block w-full mt-1">
                    <option value="">Kies een Medewerker</option>
                    @foreach($medewerkers as $medewerker)
                        <option value="{{ $medewerker->id }}">{{ $medewerker->voornaam }} {{ $medewerker->achternaam }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn bg-green-500 text-white mt-4 hover:bg-green-600">Opslaan</button>
    </form>

    <!-- Weekoverzicht voor de tafels en medewerkers -->
    <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
        @foreach($dagen as $dagNaam => $tafels)
            <div class="bg-white shadow-md rounded p-4">
                <h2 class="text-xl font-semibold mb-4">{{ $dagNaam }}</h2>
                @foreach($tafels as $tafel)
                    <div class="bg-gray-100 shadow-sm rounded p-4 mb-4">
                        <h3 class="font-bold">Tafel {{ $tafel->id }} (Capaciteit: {{ $tafel->capiciteit }})</h3>
                        <div class="mt-2">
                            @if($tafel->medewerkers->isEmpty())
                                <span class="text-red-500">Geen medewerker ingepland</span>
                            @else
                                @foreach($tafel->medewerkers as $medewerker)
                                    <span>{{ $medewerker->voornaam }} {{ $medewerker->achternaam }}</span><br>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection
