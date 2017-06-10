
<?php
	if (!isset($buttonText))
		$buttonText = 'Delete';
	if (!isset($yesText))
		$yesText = 'Yes';
	if (!isset($noText))
		$noText = 'No';
?>

@include('templates.buttons.safe_delete')
<div class="submit-decision" style="display:none;">
	<br/>
	<div class="alert alert-warning">
		@include('templates.glyphicon', ['type' => 'alert'])&nbsp;
		{!! $confirmationMessage or '<strong>Are you sure?</strong> You can\'t undo this.' !!}
	</div>
	<br/>
	@include('templates.buttons.delete', ['text' => $yesText])
	@include('templates.buttons.cancel', ['text' => $noText])
</div>
<script>
	$(".safe-submit-btn").click(function(){
		//Show confirm and cancel buttons
		$(this).parent().find(".submit-decision").fadeIn();
	});
	$(".submit-cancel-btn").click(function(){
		$(this).parent().fadeOut();
	});
</script>