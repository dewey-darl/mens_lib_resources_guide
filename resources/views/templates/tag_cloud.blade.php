
<?php 
	if (!isset($tags))
		$tags = \App\Tag::all();
	if (!isset($selected_tags))
		$selected_tags = collect([]);
?>
<div class="tag-cloud">
	@foreach($tags as $tag)
		@include('templates.tag_button', ['tag' => $tag, 'hidden' => $selected_tags->where('id', $tag->id)->count()])
	@endforeach
</div>