
<span 
	class="tag tag-btn" data-name="{{$tag->name}}" 
	data-id="{{$tag->id}}"
	@if(isset($hidden) && $hidden)
		@if (isset($hide_with_visibility) && $hide_with_visibility)
			style="visibility: hidden;"
		@else
			style="display: none;"
		@endif
	@endif
>
	{{ $tag->readableName() }}
</span>