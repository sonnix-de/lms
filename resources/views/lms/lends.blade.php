@extends('layouts.app')

@section('content')
{{var_dump (route('restGetUser'))}}
    <div id="ausleihen">
        <h1 class="title">Ausleihen</h1>
        <service-book-lends-component 
            rest-get-user="{{route('restGetUser')}}"
            rest-get-book="{{route('restGetBook')}}"
            >

        </service-book-lends-component>
    </div>

@endsection