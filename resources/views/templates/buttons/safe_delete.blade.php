<?php
	if (!isset($text))
		$text = 'Delete';
	if (!isset($type))
		$type = 'button';
	//Base class just for safe delete. Classes like btn and btn-danger will be added by _button
	$classes= 'safe-submit-btn ';
	if (isset($class))
		$classes .= $class;
?>
@include('templates.buttons.delete', 
			['text' => $text, 'type' => $type, 'class' => $classes])