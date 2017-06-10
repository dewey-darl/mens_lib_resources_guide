
<?php
	$tags = \App\Tag::orderBy('name')->get();
?>

@extends('layouts.app')

@section('content')

<div class="col-xs-8">
	<h2>Add a Resource</h2>
	{!! Form::model(new \App\Resource, ['action' => 'ResourceController@store']) !!}
		<div class="form-group">
			{!! Form::label('name') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'required' => true]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('url') !!}
			{!! Form::text('url', null, ['class' => 'form-control', 'required' => true]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('description') !!}
			{!! Form::textarea('description', null, ['class' => 'form-control', 'required' => true]) !!}
		</div>
		@include('templates.tag_selector')
		<br/><br/>
		@include('templates.buttons.post', ['text' => 'Add Resource'])
	{!! Form::close() !!}
</div>

<div class="col-xs-3 col-xs-offset-1">
	<h2>Add a Tag</h2>
	@include('templates.new_tag_form')
</div>
<br/><br/><br/>
@endsection