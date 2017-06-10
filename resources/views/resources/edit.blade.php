
@extends('layouts.app')

@section('content')

<div class="col-xs-12 col-md-8">
	<h2>Edit Resource</h2>
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
		@if (!$resource->is_published)
			{!! Form::button('Update and Publish', ['class' => 'btn btn-info update-and-publish']) !!}
			<script>
				$(".update-and-publish").click(function(){
					$('[name=is_published]').val(1);
					$("#update-resource-form").submit();
				});
			</script>
		@endif
{!! Form::close() !!}
</div>
<div class="col-xs-12 col-md-4">
	<h2>Add a Tag</h2>
	@include('templates.new_tag_form')
</div>
@endsection



