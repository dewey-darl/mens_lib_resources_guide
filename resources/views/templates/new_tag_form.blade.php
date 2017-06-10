{!! Form::model(new \App\Tag, ['action' => 'TagController@store', 'id' => 'new-tag-form']) !!}
	<div class="form-group">
		{!! Form::label('tag_name', 'Name') !!}
		{!! Form::text('tag_name', null, ['class' => 'form-control', 'required' => true]) !!}
	</div>
	{!! Form::hidden('resource_form_input', null, ['id' => 'resource_form_input']) !!}
	@include('templates.buttons.post', ['text' => 'Add Tag'])
{!! Form::close() !!}