
<div class="row">
	<div class="col-xs-12 col-md-10 col-md-offset-1 panel">
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
</div>
