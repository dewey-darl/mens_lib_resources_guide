<?php
	if (!isset($text))
		$text = 'No';
	if (!isset($type))
		$type = 'button';
	//Base class just for safe delete. Classes like btn and btn-danger will be added by _button
	$classes= 'submit-cancel-btn ';
	if (isset($class))
		$classes .= $class;
?>
@include('templates.buttons._button', 
			['text' => $text, 'action' => 'cancel', 'button_type' => $type, 'extra_classes' => $classes])