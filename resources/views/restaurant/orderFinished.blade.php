@extends('layouts.order')

@section('content')
<div class="h-screen flex flex-col justify-center items-center text-center -mt-20">
    <div class="bg-white border-4 p-6 shadow-lg rounded-2xl">
        <h1 class="text-3xl font-bold">Bestelling klaar</h1>
        <p class="mt-4 text-lg">Uw laatste bestelling is succesvol afgerond.</p>
        <p class="mt-4 text-lg">Uw bestelling nummer: {{ $bestelling->id }}</p>
    </div>
</div>
@endsection

@section('scripts')
@vite('resources/js/app.js')
@endsection
