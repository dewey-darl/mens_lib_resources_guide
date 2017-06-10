
<?php
	use \Illuminate\Support\Facades\Input;
	use \App\Resource;
	use \App\Tag;

	$tags = Tag::all();

	if (!empty(Input::old('resource_form_input')))
		$old_resource_form_data = json_decode(Input::old('resource_form_input'));
	else
		$old_resource_form_data = new stdClass(); //Empty object
	//var_dump($old_resource_form_data);
	//echo '<br/>';

	if (!empty(Input::old('tags'))){
		$selected_tag_ids = Input::old('tags');
	}
	elseif (property_exists($old_resource_form_data, 'tags')){
		$selected_tag_ids = $old_resource_form_data->tags;
		Input::merge(['tags' => $selected_tag_ids]);
	}
	else{
		$selected_tag_ids = [];
	}

	//var_dump($selected_tag_ids);
	//echo '<br>';
	if (empty($selected_tag_ids))
		$selected_tags = null;
	else
		$selected_tags = Tag::whereIn('id', $selected_tag_ids)->get();
	//print_r($selected_tags);
	$orfd = $old_resource_form_data; //This just makes things easier
	unset($orfd->_token);
	if (!isset($orfd->name))
		$orfd->name = null;
	if (!isset($orfd->url))
		$orfd->url = null;
	if (!isset($orfd->description))
		$orfd->description = null;

?>



@extends('layouts.app')

@section('content')

<div class="col-xs-8">
	<h2>Add a Resource</h2>
	{!! Form::model(new Resource, ['action' => 'ResourceController@store', 'id' => 'new-resource-form']) !!}
		<div class="form-group">
			{!! Form::label('name') !!}
			{!! Form::text('name', $orfd->name, ['class' => 'form-control', 'required' => true]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('url') !!}
			{!! Form::text('url', $orfd->url, ['class' => 'form-control', 'required' => true]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('description') !!}
			{!! Form::textarea('description', $orfd->description, 
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
	@include('templates.new_tag_form', ['with_hidden_resource_fields' => true])
	<script>
		//This is a hacky script that takes the current resource input, puts it into a hidden field
		//in the tag form, then submits the tag form, so that the old resource input will be available
		//after the redirect
		$('#new-tag-form').submit(function(){
			console.log("works");
			e.preventDefault();
			$(this).find('#resource_form_input').val($('#new-resource-form').serializeJSON());
			$(this).submit();
		});
	</script>
</div>

@endsection







