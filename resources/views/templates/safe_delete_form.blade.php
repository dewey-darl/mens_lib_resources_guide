
<?php
	if (!isset($controller))
		$controller = class_basename($model) . 'Controller';
	if (!isset($deleteMethod))
		$deleteMethod = 'destroy';
?>

{!! 
	Form::model(
		$model, 
		[
			'method' => 'delete',
			'action' => ["$controller@$deleteMethod", $model]
		]
	) 
!!}
@include('templates.safe_submit', ['buttonText' => 'Delete ' . class_basename($model)])
{!! Form::close() !!}