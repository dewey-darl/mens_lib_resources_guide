
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
		@include('templates.tag_selector', ['selected_tags' => $selected_tags])
		<br/><br/>
		{!! Form::button('Get Resources With Any Of These Tags', ['class' => 'btn btn-info search-any']) !!}
		&nbsp;
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

	@foreach ($resources as $resource)
		@include('templates.resource', ['resource' => $resource])
	@endforeach

@endsection