@include('templates.tag_button', [
									'tag' => $tag, 
									'hidden' => isset($hidden) ? $hidden : false
								]
		)