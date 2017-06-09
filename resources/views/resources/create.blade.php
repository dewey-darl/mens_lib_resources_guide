
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
	<!-- Hidden checkbox field for tags -->
	<div class="display-none hidden-tag-fields">
		@foreach($tags as $i => $tag)
			{!! Form::checkbox('tags[]', $tag->id) !!}
		@endforeach
	</div>
	<div class="form-group">
		{!! Form::label('tags') !!}
		<div class="tag-input form-control">
			@foreach($tags as $tag)
				<span class="tag tag-btn" data-id="{{ $tag->id }}">{{ $tag->readableName() }}</span>
			@endforeach
		</div>
	</div>

	@include('templates.tag_cloud')

	<script>
		//Hide all the tags in the tag-input element
		$(".tag-input .tag").hide();
		$(".tag").click(function(){
			//Check if it's a tag in the tag cloud (i.e it hasn't been added to the resource)
			//  or a tag in the tag input (i.e. it has been added to the resource)
			//If it hasn't been added, add it
			if ($(this).parent().hasClass('tag-cloud')){
				//Fade the tag out
				$(this).fadeOut(200);
				//Fade in the corresponding tag
				$('.tag-input .tag[data-id=' + $(this).data('id') + ']').fadeIn(200);
				$('.hidden-tag-fields input[value=' + $(this).data('id') + ']').attr('checked', true);
			}
			else{
				//Fade the tag out
				$(this).fadeOut(200);
				//Fade in the corresponding tag
				$('.tag-cloud .tag[data-id=' + $(this).data('id') + ']').fadeIn(200);
				$('.hidden-tag-fields input[value=' + $(this).data('id') + ']').attr('checked', false);
			}
		});
	</script>
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
	{!! Form::submit('Add Tag', ['class' => 'btn btn-default']) !!}
	{!! Form::close() !!}
</div>
<br/><br/><br/>
@endsection