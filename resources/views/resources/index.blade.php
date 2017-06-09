
<?php
	$tags = \App\Tag::orderBy('name')->get();
?>

@extends('layouts.app')

@section('title')
	| Resources
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12 col-md-10 col-md-offset-1">
	{!! Form::open() !!}
		<!-- Hidden checkbox field for tags -->
		<div class="display-none hidden-tag-fields">
			@foreach($tags as $i => $tag)
				{!! Form::checkbox('tags[]', $tag->id, in_array($tag->name, $selected_tags)) !!}
			@endforeach
		</div>
		<div class="form-group">
			{!! Form::label('tags') !!}
			<div class="tag-input form-control">
				@foreach($tags as $tag)
					@include('templates.tag_button', ['tag' => $tag, 'hidden' => !in_array($tag->name, $selected_tags)])
				@endforeach
			</div>
		</div>

		@include('templates.tag_cloud', ['hidden' => $selected_tags])

		<script>
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
		{!! Form::button('Get Resources With Any Of These Tags', ['class' => 'btn btn-info search-any']) !!}
		{!! Form::button('Get Resources With All Of These Tags', ['class' => 'btn btn-info search-all']) !!}
		{!! Form::close() !!}
		</div>
		<script>
			$(".search-any, .search-all").click(function(){
				var tagsSelected = [];
				$('.hidden-tag-fields input:checked').each(function(i, e){
					//Get tag name by finding the tag this checkbox references (the checkbox value is the tag id)
					tagsSelected.push(
						$('.tag-cloud').find('.tag[data-id=' + $(e).val() + ']').data('name')
					);
				});
				var queryString = tagsSelected.join('+');
				var redirectUrl = '/resources/';
				redirectUrl += $(this).hasClass('has-any') ? 'has-any/' : 'has-all/';
				redirectUrl += queryString;
				console.log(redirectUrl);
				window.location.href = redirectUrl; 
			});
		</script>
</div>
<br/><br/>
<div class="row">
	@foreach ($resources as $resource)
		@include('templates.resource', ['resource' => $resource])
	@endforeach
</div>
@endsection