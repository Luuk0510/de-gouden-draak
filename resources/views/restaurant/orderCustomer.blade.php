@extends('layouts.restaurant')

@section('content')
<div class="flex flex-col items-center justify-center mt-6">
    <h1 class="text-3xl font-bold mb-4">Gegevens van bestelling</h1>
    <div class="border-2 border-blue-500 rounded-xl px-10 py-4 shadow-xl max-w-5xl">
        <p><strong>Bestelling nummer:</strong> {{ $order->id }}</p>
        <p><strong>Tafel nummer:</strong> {{ $order->tafel_nummer }}</p>

        <p><strong>Bestelling Datum:</strong> {{ \Carbon\Carbon::parse($order->datum)->format('d-m-Y H:i') }}</p>

        <h2 class="text-lg font-bold mt-4">Klantgegevens</h2>
        @foreach($order->klanten as $klant)
            <div class="mb-2">
                <p>{{ $klant->voornaam }} {{ $klant->tussenvoegsel }} {{ $klant->achternaam }}</p>
                <p><strong>Geboortedatum:</strong> {{ \Carbon\Carbon::parse($klant->geboortedatum)->format('d-m-Y') }}</p>
                <p><strong>Aantal Personen:</strong> {{ $numPersons }}</p>
            </div>
        @endforeach

        <div class="border rounded-xl mt-4">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-start font-medium text-gray-500">Gerecht</th>
                        <th class="bpx-6 py-3 text-center font-medium text-gray-500">Prijs</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($gerechten as $gerechtBestelling)
                        @if ($gerechtBestelling)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">{{ $gerechtBestelling['naam'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">&euro;{{ number_format($gerechtBestelling['prijs'], 2, ',', '.') }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-6">
            <form action="{{ route('restaurant.pdf', $order->id) }}" method="get">
                @csrf
                <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 font-bold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 transition">
                    Opslaan als PDF
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
