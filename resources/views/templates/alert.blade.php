<?php
	if (!isset($type))
		$type = 'info';
?>
<p class="alert alert-{{ $type }}">{{ $message }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>