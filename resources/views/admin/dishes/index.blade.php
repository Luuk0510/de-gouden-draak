<!-- resources/views/admin/gerechten/index.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Gerechten Beheren</h1>

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.dishes.create') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700">Nieuw Gerecht</a>
        </div>

        <!-- Scrollable table container -->
        <div class="overflow-y-auto max-h-96">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b">Nummer</th>
                        <th class="py-2 px-4 border-b">Naam</th>
                        <th class="py-2 px-4 border-b">Prijs</th>
                        <th class="py-2 px-4 border-b">Soort</th>
                        <th class="py-2 px-4 border-b">Aangemaakt op</th>
                        <th class="py-2 px-4 border-b">Gewijzigd op</th>
                        <th class="py-2 px-4 border-b">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dishes as $dish)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $dish->nummer }}</td>
                            <td class="py-2 px-4 border-b">{{ $dish->naam }}</td>
                            <td class="py-2 px-4 border-b">&euro;{{ number_format($dish->prijs, 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ $dish->soort->naam ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $dish->aangemaakt_op ? $dish->aangemaakt_op->format('d-m-Y H:i') : 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $dish->gewijzigd_op ? $dish->gewijzigd_op->format('d-m-Y H:i') : 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700">Wijzigen</a>
                                <a href="{{ route('admin.dishes.copy', $dish->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-yellow-700">Kopiëren</a>
                                <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je dit gerecht wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-red-700">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
