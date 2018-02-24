@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card-deck">
                <!-- erst die Features und dann die Articles -->
                @foreach ($features as $feature)
                    <feature-display feature="{{$feature}}" rest-route="{{route('restGetFeature',['name'=>$feature])}}"></feature-display>
                @endforeach
            </div>
</div>
@endsection
