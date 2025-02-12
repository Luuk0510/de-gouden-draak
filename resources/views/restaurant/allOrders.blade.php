@extends('layouts.restaurant')

@section('content')
<div class="flex flex-col justify-center items-center mt-6">
    <h1 class="text-3xl font-bold mb-2">Alle bestellingen</h1>
    <a href="{{ route('restaurant.order') }}" class="mb-6 my-2 px-4 py-2 inline-flex items-center justify-center gap-x-2 font-bold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 transition">Bestellingen van vandaag bekijken</a>
    <div class="mb-4 border-2 border-blue-500 rounded-lg p-6 shadow-xl">
        @if (isset($orders))
            @foreach($orders as $order)
            <div class="mb-4">
                <p><strong>Bestelling nummer:</strong> {{ $order->id }}</p>
                <p><strong>Tafel nummer:</strong> {{ $order->tafel_nummer }}</p>
                <p><strong>Tijd:</strong> {{ \Carbon\Carbon::parse($order->datum)->format('d-m-Y H:i') }}</p>
                @if($klant = $order->klanten->first())
                    <p><strong>Klant:</strong> {{ $klant->voornaam }} {{ $klant->achternaam }}</p>
                @endif
                <form action="{{ route('restaurant.orderCustomer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $order->id }}">
                    <div class="flex justify-center">
                        <button type="submit" class="my-2 px-4 py-2 inline-flex items-center justify-center gap-x-2 font-bold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 transition">
                            Bekijk Bestelling
                        </button>
                    </div>
                </form>
                <hr>
            </div>
            @endforeach     
        @else
            <p>Er zijn geen bestellingen gemaakt</p>
        @endif
    </div>
</div>
@endsection
