
<?php 
	if (!isset($tags))
		$tags = \App\Tag::all();
	if (!isset($selected_tags))
		$selected_tags = collect([]);
	if (!isset($columns))
		$columns = 4;
	$tagsPerColumn = ceil($tags->count() / $columns);
	$columnWidth = 12 / $columns; //For bootstrap
	$currentColumn = 1;
	$i = 0;
?>
<div class="tag-cloud row">
	<div class="col-xs-{{$columnWidth}} cloud-inner">
		@foreach($tags as $tag)
			<?php if ($i >= $tagsPerColumn) : $i = 0; ?>
				</div>
				<div class="col-xs-{{$columnWidth}} cloud-inner">
			<?php endif; ?>
			@include('templates.tag_button', 
				['tag' => $tag, 
				'hidden' => $selected_tags->where('id', $tag->id)->count(),
				'hide_with_visibility' => true,
				])
			<br/>
			<?php $i++;?>
		@endforeach
	</div>
	<div>&nbsp;</div>
</div>