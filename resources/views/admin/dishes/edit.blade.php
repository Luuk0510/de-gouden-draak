@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">gerecht aanpassen</h1>
        <x-formError />
        <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="number" class="block text-sm font-medium text-gray-700">nummer</label>
                <input type="text" name="nummer" id="nummer" class="mt-1 block w-full" value="{{ $dish->nummer }}" required>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">naam</label>
                <input type="text" name="naam" id="naam" class="mt-1 block w-full" value="{{ $dish->naam }}" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">prijs</label>
                <input type="text" name="prijs" id="prijs" class="mt-1 block w-full" value="{{ $dish->prijs }}" required>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Soort</label>
                <select name="soort" id="category" class="mt-1 block w-full" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($dish->category_id == $category->id) selected @endif>{{ $category->naam }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
@endsection
