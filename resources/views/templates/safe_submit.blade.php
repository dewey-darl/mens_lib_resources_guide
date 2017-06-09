
<?php
	if (!isset($buttonText))
		$buttonText = 'Delete';
	$buttonText .= ' ' . view('templates.glyphicon', ['type' => 'trash'])->render();
	if (!isset($yesText))
		$yesText = 'Yes';
	$yesText .= ' ' . view('templates.glyphicon', ['type' => 'ok'])->render();
	if (!isset($noText))
		$noText = 'No';
	$noText .= ' ' . view('templates.glyphicon', ['type' => 'remove'])->render();
?>

{!! Form::button($buttonText, ['class' => 'btn btn-danger safe-submit-btn']) !!}
<div class="submit-decision" style="display: none;">
	<br/>
	<div class="alert alert-warning">
		@include('templates.glyphicon', ['type' => 'alert'])&nbsp;
		{!! $confirmationMessage or '<strong>Are you sure?</strong> You can\'t undo this.' !!}
	</div>
	<br/>
	{!! Form::submit('Yes', ['class' => 'btn btn-danger']) !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	{!! Form::button($noText, ['class' => 'btn btn-default submit-cancel-btn']) !!}
</div>
<script>
	$(".submit-decision").hide();
	$(".safe-submit-btn").click(function(){
		//Show confirm and cancel buttons
		$(this).parent().find(".submit-decision").fadeIn();
	});
	$(".submit-cancel-btn").click(function(){
		$(this).parent().fadeOut();
	});
</script>