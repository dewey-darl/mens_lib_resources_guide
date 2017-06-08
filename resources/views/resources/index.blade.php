
@extends('layouts.app')

@section('title')
	| Resources
@endsection

@section('content')

@foreach ($resources as $resource)
	@include('templates.resource', ['resource' => $resource])
@endforeach

@endsection