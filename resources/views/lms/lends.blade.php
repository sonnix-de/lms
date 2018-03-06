@extends('layouts.app')

@section('content')
    <div id="ausleihen">
        <h1 class="title">Ausleihen</h1>
        <service-book-lends-component 
            rest-get-user="{{route('restGetUser')}}"
            rest-get-book="{{route('restGetBook')}}"
            >
    </div>

@endsection