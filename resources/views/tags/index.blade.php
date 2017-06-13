
@extends('layouts.app')

@section('content')
	<div class="col-xs-8">
		<h2>Edit Tags</h2>
		@foreach ($tags as $tag)
			<div class="row">
				<h3 class='col-xs-12'>{{$tag->readableName()}}</h3>
				<div class="col-xs-12">
					Created 
					@if ($tag->user)
						by {!! link_to_action('UserController@show', $tag->user['username'], [$tag->user]) !!} 
					@else
						anonmyously
					@endif
					on {{date('F jS, Y', strtotime($tag->created_at))}}
				</div>
				<div class="col-xs-12">&nbsp;</div>
				<div class="col-xs-6">
					@include('templates.buttons.edit', ['text' => 'Edit', 'class' => 'edit-btn'])
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
							@include('templates.buttons.post', ['text' => 'Update'])
							@include('templates.buttons.cancel', ['text' => 'Cancel', 'class' => 'cancel-btn'])
						{!! Form::close() !!}
					</div>
				</div>
				<div class="col-xs-6">
					@include('templates.safe_delete_form', ['model' => $tag])
				</div>
			</div>
			<hr/>
		@endforeach
	</div>
	<div class="col-xs-3 col-xs-offset-7 affix">
		<h2>Add a Tag</h2>
		@include('templates.new_tag_form')
	</div>
	<script>
		$('.edit-btn').click(function(){
			$(this).parent().find('.edit-form').fadeIn();
		});
		$('.cancel-btn').click(function(){
			$(this).parent().fadeOut();
		});
	</script>
@endsection