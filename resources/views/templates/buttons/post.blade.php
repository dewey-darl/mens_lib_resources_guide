<?php
	if (!isset($text))
		$text = 'Submit';
	if (!isset($type))
		$type = 'submit';
?>
@include('templates.buttons._button', 
			['action' => 'post', 
			'text' => $text, 
			'button_type' => $type, 
			'extra_classes' => isset($class) ? $class : null
			]
		)