
<?php
	use \Illuminate\Support\Facades\Input;
	use \App\Resource;
	use \App\Tag;


	$tags = Tag::all();

	//Fill old resource data with cookies
	$rname = isset($_COOKIE['name']) ? $_COOKIE['name'] : null;
	$rurl = isset($_COOKIE['url']) ? $_COOKIE['url'] : null;
	$rdesc = isset($_COOKIE['description']) ? $_COOKIE['description'] : null;

	$selected_tag_ids;
	if (!empty(Input::old('tags'))){
		$selected_tag_ids = Input::old('tags');
	}
	else if (isset($_COOKIE['tags'])){
		$selected_tag_ids = json_decode($_COOKIE['tags']);
		//The tag hidden checkboxes will default to the (empty) Input value, so set it to the cookie value
		Input::merge(['tags' => $selected_tag_ids]);
	}
	else{
		$selected_tag_ids = [];
	}
	
	$selected_tags = Tag::whereIn('id', $selected_tag_ids)->get();

	//Unset the cookies
	setcookie('name', '', time()-3600, '/');
	setcookie('url', '', time()-3600, '/');
	setcookie('description', '', time()-3600, '/');
	setcookie('tags', '', time()-3600, '/');

?>



@extends('layouts.app')

@section('content')

<div class="col-xs-8">
	<h2>Add a Resource</h2>
	{!! Form::model(new Resource, ['action' => 'ResourceController@store', 'id' => 'new-resource-form']) !!}
		<div class="form-group">
			{!! Form::label('name') !!}
			{!! Form::text('name', $rname, ['class' => 'form-control', 'required' => true]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('url') !!}
			{!! Form::text('url', $rurl, ['class' => 'form-control', 'required' => true]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('description') !!}
			{!! Form::textarea('description', $rdesc, 
					['class' => 'form-control', 'required' => true, 'id'=>'description-field']) !!}
		</div>
		@include('templates.tag_selector', ['selected_tags' => $selected_tags])
		<br/><br/>
		@include('templates.buttons.post', 
					['text' => 'Add Resource', 'type' => 'button', 'class' => 'new-resources-submit-btn'])
	{!! Form::close() !!}
	<script>
		var simplemde = new SimpleMDE({ element: $("textarea")[0] });
		$('#new-resource-form .new-resources-submit-btn').click(function(){
			$('#description-field').val(simplemde.value());
			$('#new-resource-form').submit();
		})
	</script>
</div>

<div class="col-xs-3 col-xs-offset-1">
	<h2>Add a Tag</h2>
	@include('templates.new_tag_form')
	<script>
		//This is a hacky script that takes the current resource input, puts it into cookies
		//so it can be retrieved after the tag is submitted
		$('#new-tag-form').submit(function(){
			//Get the form data as a js object, just because it's easier
			var resource_data = $('#new-resource-form').serializeObject();
			//If there aren't any tags set, set it to an empty array just so the cookie is always there
			if (!('tags' in resource_data))
				resource_data.tags = [];
			//Fill the 'description' field with whatever's in the markdown textarea
			resource_data.description = simplemde.value();
			for (field_name in resource_data){
				Cookies.set(field_name, resource_data[field_name]);
			}
			console.log(Cookies.get('tags'));
		});
	</script>
</div>

@endsection







