
@extends('layouts.app')

@section('content')

<div class="col-xs-8">
	{!! Form::model($resource, ['action' => 'ResourceController@store']) !!}
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
	<!-- Hidden checkbox field for tags -->
	<div class="display-none">
		@foreach($tags as $tag)
			{!! Form::checkbox('tags', $tag->id) !!}
		@endforeach
	</div>
	{!! Form::submit('Submit Resource') !!}
	{!! Form::close() !!}
	<br/>
	<div class="tag-cloud">
		@foreach($tags as $tag)
			<span class="tag">{{ $tag->name }}</span>
		@endforeach
	</div>
</div>

<div class="col-xs-3 col-xs-offset-1">
	{!! Form::model($tag, ['action' => 'TagController@store']) !!}
	<div class="form-group">
		{!! Form::label('name') !!}
		{!! Form::text('name', null, ['class' => 'form-control', 'required' => true]) !!}
	</div>
	{!! Form::submit('Add Tag') !!}
	{!! Form::close() !!}
</div>

@endsection