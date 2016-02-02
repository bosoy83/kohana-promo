<?php defined('SYSPATH') or die('No direct access allowed.');

	$labels = $orm->labels();
	$required = $orm->required_fields();

/**** mode ****/
	
	echo View_Admin::factory('form/control', array(
		'field' => 'mode',
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'controls' => Form::select('mode', $mode_options, $orm->mode, array(
			'id' => 'mode_field',
			'class' => 'input-xxlarge',
		)),
	));
	
/**** embed_code ****/
	
	echo View_Admin::factory('form/control', array(
		'field' => 'embed_code',
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'controls' => Form::textarea('embed_code', $orm->embed_code, array(
			'id' => 'embed_code_field',
			'class' => 'text-area-clear',
		)),
	));
?>
<script>
$(function(){
	$("#mode_field").on("change", function(){
		if ($(this).val() !== "external") {
			$("#embed_code_field").prop("disabled", true);
		} else {
			$("#embed_code_field").prop("disabled", false);
		}
	}).triggerHandler("change");
});
</script>	