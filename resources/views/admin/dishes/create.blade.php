@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Create New Dish</h1>

        <x-formError />
        <form action="{{ route('admin.dishes.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nummer" class="block text-sm font-medium text-gray-700">Nummer</label>
                <input type="text" name="nummer" id="nummer" class="mt-1 block w-full" value="{{ $newNumber }}" required>
            </div>

            <div class="mb-4">
                <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                <input type="text" name="naam" id="naam" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs</label>
                <input type="text" name="prijs" id="prijs" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="soort" class="block text-sm font-medium text-gray-700">Soort</label>
                <select name="soort" id="soort" class="mt-1 block w-full" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->naam }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700">Save</button>
            </div>
        </form>
    </div>
@endsection
