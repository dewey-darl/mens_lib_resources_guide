
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
				<div class="col-xs-1">
				<a target="_blank" href="<?= action('ResourceController@edit', ['resource' => $resource->id]); ?>" 
					class="btn btn-info">
					Edit
				</a>
				</div>

				<?php 
					$publishFormAction = $resource->is_published ? 'unpublish' : 'publish';
				?>
				{!! 
					Form::open(
						[
							'method' => 'put', 
							'action' => ["ResourceController@$publishFormAction", $resource],
							'class' => 'col-xs-2'
						]
					) 
				!!}
					{!! Form::submit(ucwords($publishFormAction), ['class' => 'btn btn-info']) !!}
				{!! Form::close() !!}

				@include('templates.safe_delete_form', ['model' => $resource])
				
			</div>
		@endif
	</div>
</div>
