
<?php
	//$action is required
	$baseClass = 'btn ';
	if (!isset($extraClasses))
		$extraClasses = '';
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
	endif;

	$class = $baseClass . ' ' . $extraClasses;
	$glyphicon = view('templates.glyphicon', ['type' => $glyphiconType])->render();
	$text = $glyphicon . ' ' . $button_text;

?>

@if ($type === 'submit')
	{!! Form::submit($text, ['class' => $class]) !!}
@elseif ($type === 'button')
	{!! Form::button($text, ['class' => $class]) !!}
@endif