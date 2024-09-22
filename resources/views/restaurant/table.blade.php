@extends('layouts.restaurant')

@section('content')
    <div class="flex flex-col justify-center items-center mt-20">
        <div class="border-2 border-blue-500 p-4 rounded-lg">
            <h1 class="text-3xl mb-2">Registratie succesvol</h1>
            <p class="text-lg">Bestelling nummer: {{ $bestelling->id }}</p>
            <p class="text-lg">Tafel nummer: {{ $tafel->id }}</p>
        </div>
    </div>
@endsection
