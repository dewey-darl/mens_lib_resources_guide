
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
		<h1>Welcome to the Men's Lib resources guide!</h1>
		Here you'll find a vast array of resources geared towards men in a variety of situatoins with a variate of backgrounds.
		<br/><br/>
		<a href="/resources/about">Click here</a> to find out how the search form works.
		<br/><br/>
		@if (!Auth::user())
			If you'd like to help the cause and add some resources of your own, 
			<a href="/register">sign up</a> or <a href="/login">log in</a>.
		@else
			<a href="/resources/create">Click here</a> to add resources to the database.
		@endif
	</div>
	<div class="col-xs-12">&nbsp;</div>
	<div class="col-xs-12">&nbsp;</div>
	<div class="col-xs-12 col-md-10 col-md-offset-1 panel">
		<button type="button" class="btn btn-info btn-lg collapse-btn" data-toggle='collapse' data-target='#resource-search-form'>
			<span class="text">
				Search for Resources&nbsp;@include('templates.glyphicon', ['type' => 'chevron-right'])
			</span> 
			<span class="text" style="display:none;">
				Hide Search Form&nbsp;@include('templates.glyphicon', ['type' => 'chevron-down'])
			</span> 
		</button>
		<script>
			$(".collapse-btn").click(function(){
				$(this).find('.text').toggle();
			});
		</script>
		{!! Form::open(['id' => 'resource-search-form', 'class' => 'collapse']) !!}
			<div class="col-xs-12">&nbsp;</div>
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
				redirectUrl += $(this).hasClass('search-any') ? 'has-any/' : 'has-all/';
				redirectUrl += queryString;
				window.location.href = redirectUrl; 
			});
		</script>
</div>
<br/><br/>

	@foreach ($resources as $resource)
		@include('templates.resource', ['resource' => $resource])
	@endforeach

@endsection