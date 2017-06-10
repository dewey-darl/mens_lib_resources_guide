
<?php
	if (!isset($controller))
		$controller = class_basename($model) . 'Controller';
	if (!isset($deleteMethod))
		$deleteMethod = 'destroy';
	if (!isset($buttonText))
		$buttonText = 'Delete ' . ucfirst(class_basename($model));
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
@include('templates.safe_submit', ['buttonText' => $buttonText])
{!! Form::close() !!}