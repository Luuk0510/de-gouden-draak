@extends('layouts.register')

@section('content')
<div id="register" data-dishes="{{ json_encode($dishes) }}">
    <app :dishes="dishes"></app>
</div>
@endsection

@section('scripts')
@vite('resources/js/app.js')
@endsection
