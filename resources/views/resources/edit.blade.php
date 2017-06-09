
@extends('layouts.app')

@section('content')

{!! 
	Form::model(
		$resource, 
		[
			'method' => 'put', 
			'action' => ['ResourceController@update', $resource],
			'id' => 'update-resource-form'
		]
	) 
!!}
	<div class="form-group">
		{!! Form::label('name') !!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('url') !!}
		{!! Form::text('url', null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('description') !!}
		{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
	</div>
		@include('templates.tag_selector', ['selected_tags' => $resource->tags()->get()])
		<br/>
		{!! Form::hidden('is_published') !!}
		{!! Form::submit('Update Resource', ['class' => 'btn btn-info']) !!}
		{!! Form::button('Update and Publish', ['class' => 'btn btn-info update-and-publish']) !!}
		<script>
			$(".update-and-publish").click(function(){
				$('[name=is_published]').val(1);
				$("#update-resource-form").submit();
			});
		</script>
{!! Form::close() !!}
<br/><br/>
@endsection