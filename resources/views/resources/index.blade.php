
@extends('layouts.app')

@section('content')

@foreach ($resources as $resource)
	<div class="row panel">
		<h3>{{ $resource->name }}</h3>
		<div><a href="{{ $resource->url }}">Link</a></div>
		<div>{{ $resource->description }}</div>
		<div>
			@foreach ($resource->tags as $tag)
				<span class="tag tag-btn">{{ $tag->readableName() }}</span>
			@endforeach
		</div>
	</div>
	<br/><br/>
@endforeach

@endsection