<?php
	if (!isset($text))
		$text = 'Edit';
	if (!isset($type))
		$type = 'submit';
?>
@include('templates.buttons._button', 
			['action' => 'search', 'text' => $text, 'button_type' => $type, 'extra_classes' => isset($class) ? $class : null])