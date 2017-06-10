
<div class="row">
	<div class="col-xs-12 col-md-10 col-md-offset-1 panel">
		<div class="col-xs-12">
			<h4><a href="{{$resource->url}}">{{$resource->name}}</a></h4>
			<div>
				{{$resource->description}}
			</div>
			<div>
				@foreach ($resource->tags as $tag)
					@include('templates.tag', ['tag' => $tag])
				@endforeach
			</div>
		</div>
		@if(Auth::user() && Auth::user()->isAdmin())
			
			<div class="col-xs-12">
				<hr/>
				{!! 
					Form::open(
						[
							'method' => 'get', 
							'action' => ["ResourceController@edit", $resource],
							'class' => 'col-xs-3',
							'target' => '_blank'
						]
					) 
				!!}
					@include('templates.buttons.edit')
				{!! Form::close() !!}

				<?php 
					$publishFormAction = $resource->is_published ? 'unpublish' : 'publish';
				?>
				{!! 
					Form::open(
						[
							'method' => 'put', 
							'action' => ["ResourceController@$publishFormAction", $resource],
							'class' => 'col-xs-3'
						]
					) 
				!!}
					@include('templates.buttons.edit', ['text' => ucfirst($publishFormAction)])
				{!! Form::close() !!}

				@include('templates.safe_delete_form', ['model' => $resource, 'class' => 'col-xs-3'])
				
			</div>
		@endif
	</div>
</div>
