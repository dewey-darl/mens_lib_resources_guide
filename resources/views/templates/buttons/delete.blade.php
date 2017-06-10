<?php
	if (!isset($text))
		$text = 'Delete';
	if (!isset($type))
		$type = 'submit';
?>
@include('templates.buttons._button', 
			['action' => 'delete', 'text' => $text, 'button_type' => $type, 'extra_classes' => isset($class) ? $class : null])