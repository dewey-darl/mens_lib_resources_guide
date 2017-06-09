
<?php
	$tags = \App\Tag::orderBy('name')->get();
?>

@extends('layouts.app')

@section('content')

<div class="col-xs-8">
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
	{!! Form::submit('Submit Resource', ['class' => 'btn btn-default']) !!}
	{!! Form::close() !!}
</div>

<div class="col-xs-3 col-xs-offset-1">
	{!! Form::model(new \App\Tag, ['action' => 'TagController@store']) !!}
	<div class="form-group">
		{!! Form::label('tag_name', 'Name') !!}
		{!! Form::text('tag_name', null, ['class' => 'form-control', 'required' => true]) !!}
	</div>
	{!! 
		Form::submit(
			'Add Tag',
			['class' => 'btn btn-info']
		)
	!!}
	{!! Form::close() !!}
</div>
<br/><br/><br/>
@endsection