
<?php if (!isset($tags))
		$tags = \App\Tag::all();
?>
<div class="tag-cloud">
	@foreach($tags as $tag)
		@include('templates.tag_button', ['tag' => $tag, 'hidden' => in_array($tag->name, $selected_tags)])
	@endforeach
</div>