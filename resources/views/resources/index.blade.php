
@extends('layouts.app')

@section('content')

@foreach ($resources as $resource)
<div class="row">
	<h3>{{ $resource->name }}</h3>
	<div><a href="{{ $resource->url }}">Link</a></div>
	<div>{{ $resource->description }}</div>
</div>
@endforeach

@endsection