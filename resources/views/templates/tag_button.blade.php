
<span 
	class="tag tag-btn" data-name="{{$tag->name}}" 
	data-id="{{$tag->id}}"
	@if(isset($hidden) && $hidden)
		style="display: none;"
	@endif
>
	{{ $tag->readableName() }}
</span>