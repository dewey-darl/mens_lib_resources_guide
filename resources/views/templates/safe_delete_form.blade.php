
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
			'action' => ["$controller@$deleteMethod", $model],
			'class' => isset($class) ? $class : ''
		]
	) 
!!}
<?php unset($class); ?>
@include('templates.safe_submit', ['buttonText' => 'Delete ' . class_basename($model)])
{!! Form::close() !!}