
@extends('layouts.app')

@section('content')
	@foreach ($tags as $tag)
		<div class="row">
			<h3 class='col-xs-12'>{{$tag->readableName()}}</h3>
			<div class="col-xs-6">
				<div class='btn btn-info edit-btn'>
					Edit&nbsp;&nbsp;&nbsp;@include('templates.glyphicon', ['type' => 'pencil'])
				</div>
				<br/><br/>
				<div class="">
					{!! 
						Form::model(
							$tag,
							[
								'method' => 'put',
								'action' => ['TagController@update', $tag],
								'class' => 'edit-form',
								'style' => 'display: none;'
							]
						) 
					!!}
						<div class="form-group">
							{!! Form::text('tag_name', $tag->name, ['class' => 'form-control']) !!}
						</div>
						{!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
						{!! Form::button('Cancel', ['class' => 'btn btn-primary cancel-btn']) !!}
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-xs-6">
				@include('templates.safe_delete_form', ['model' => $tag])
			</div>
		</div>
		<hr/>
	@endforeach
	<script>
		$('.edit-btn').click(function(){
			$(this).parent().find('.edit-form').fadeIn();
		});
		$('.cancel-btn').click(function(){
			$(this).parent().fadeOut();
		});
	</script>
@endsection