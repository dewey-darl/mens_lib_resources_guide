<?php
	//Default type for delete is button. For everything else it's submit
	if (!isset($text))
		$text = 'Delete';
	if (!isset($type))
		$type = 'Button';
?>
@include('templates._button', 
			['action' => 'delete', 'text' => $text, 'button_type' => $type], 'classes' => isset($class) ? $class : null);