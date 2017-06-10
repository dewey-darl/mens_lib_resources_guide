@extends('layouts.app')

@section('content')
	@include('templates.user', ['user' => $user])
@endsection