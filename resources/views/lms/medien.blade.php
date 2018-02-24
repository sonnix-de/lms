@extends('layouts.app')

@section('content')
<books-search-component 
    restgetbooks="{{route('restGetBooks')}}"
></books-search-component>
@endsection