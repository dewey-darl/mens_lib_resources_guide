
<?php
	//$action is required
	//$text is required
	$baseClass = 'btn ';
	if (!isset($extra_classes))
		$extra_classes = '';
	if (!isset($button_type))
		$button_type = 'submit';
	
	if ($action === 'delete') : //For removing things
		$baseClass .= 'btn-danger';
		$glyphiconType = 'trash';
	elseif ($action === 'edit') : //For editing things
		$baseClass .= 'btn-info';
		$glyphiconType = 'pencil';
	elseif ($action === 'post') : //For creating/updating things
		$baseClass .= 'btn-info';
		$glyphiconType = 'ok';
	elseif ($action === 'cancel') : //For cancelling safe deletes
		$baseClass .= 'btn-default';
		$glyphiconType = 'remove';
	elseif ($action === 'search') :
		$baseClass .= 'btn-info';
		$glyphiconType = 'search';
	endif;

	$class = $baseClass . ' ' . $extra_classes;
	$glyphicon = view('templates.glyphicon', ['type' => $glyphiconType])->render();
	$text = $glyphicon . '&nbsp;' . $text;
?>
@if ($button_type === 'submit')
	{!! Form::button($text, ['class' => $class, 'type' => 'submit']) !!}
@elseif ($button_type === 'button')
	{!! Form::button($text, ['class' => $class]) !!}
@endif