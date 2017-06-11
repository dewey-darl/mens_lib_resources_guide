<?php
	if (!isset($tags))
		$tags = \App\Tag::all();
	if (!isset($selected_tags))
		$selected_tags = collect([]);
?>
<!-- Hidden checkbox field for tags -->
<div>
	<div class="display-none hidden-tag-fields">
		@foreach($tags as $i => $tag)
			{{-- Tags that are in $selected_tags will have their checkbox checked --}}
			{!! Form::checkbox("tags[]", $tag->id, (bool)$selected_tags->where('id', $tag->id)->count()) !!}
		@endforeach
		<script>
			//This script 
		</script>
	</div>
	<div class="form-group">
		{!! Form::label('tags') !!}
		<div class="tag-input form-control">
			@foreach($tags as $tag)
				@include('templates.tag_button', ['tag' => $tag, 'hidden' => !$selected_tags->where('id', $tag->id)->count()])
			@endforeach
		</div>
	</div>

	@include('templates.tag_cloud', ['tags' => $tags, 'hidden' => $selected_tags])

	<script>
		$(".tag").click(function(){
			//Check if it's a tag in the tag cloud (i.e it hasn't been added to the resource)
			//  or a tag in the tag input (i.e. it has been added to the resource)
			//If it hasn't been added, add it
			if ($(this).parent().hasClass('cloud-inner')){
				//Fade the tag out
				$(this).fadeTo(200, 0, function(){$(this).css('visibility', 'hidden');});
				//Fade in the corresponding tag
				$('.tag-input .tag[data-id=' + $(this).data('id') + ']').fadeIn(200);
				$('.hidden-tag-fields input[value=' + $(this).data('id') + ']').attr('checked', true);
			}
			else{
				//Fade the tag out
				$(this).fadeOut(200);
				//Fade in the corresponding tag
				$('.tag-cloud .tag[data-id=' + $(this).data('id') + ']').css('visibility', 'visible').fadeTo(200, 1);
				$('.hidden-tag-fields input[value=' + $(this).data('id') + ']').attr('checked', false);
			}
		});
	</script>
</div>