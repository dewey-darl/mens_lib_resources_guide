{!! Form::model(new \App\Tag, ['action' => 'TagController@store']) !!}
	<div class="form-group">
		{!! Form::label('tag_name', 'Name') !!}
		{!! Form::text('tag_name', null, ['class' => 'form-control', 'required' => true]) !!}
	</div>
	@include('templates.buttons.post', ['text' => 'Add Tag'])
{!! Form::close() !!}