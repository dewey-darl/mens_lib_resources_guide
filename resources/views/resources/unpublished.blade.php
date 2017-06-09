
@extends('layouts.app')

@section('content')
	@foreach ($resources as $resource)
		@include('templates.resource', ['resource' => $resource])
	@endforeach
@endsection