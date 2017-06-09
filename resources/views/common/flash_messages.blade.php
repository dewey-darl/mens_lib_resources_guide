<div class="flash-message">
	@foreach (['danger', 'warning', 'success', 'info'] as $type)
		@if(Session::has($type))
			@include('templates.alert', ['type' => $type, 'message' => Session::get($type)])
		@endif
	@endforeach
	@foreach ($errors->all() as $error)
        @include('templates.alert', ['type' => 'danger', 'message' => $error])
    @endforeach
</div> <!-- end .flash-message -->