@extends('layouts.order')

@section('content')
<div id="customer-order" data-dishes="{{ json_encode($dishes) }}" data-table="{{ json_encode($table) }}" data-round="{{ json_encode($currentRound) }}" data-round-start-time="{{ json_encode($roundStartTime) }}">
    <customer-order 
        :dishes="{{ json_encode($dishes) }}" 
        :table="{{ json_encode($table) }}"
        :current-round="{{ json_encode($currentRound) }}" 
        :round-start-time="'{{ json_encode($roundStartTime) }}'"
    ></customer-order>
</div>
@endsection

@section('scripts')
@vite('resources/js/app.js')
@endsection
