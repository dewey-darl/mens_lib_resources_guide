@extends('layouts.app')

@section('content')
	@foreach($users as $user)
		@include('templates.user', ['user' => $user])
	@endforeach
@endsection