$(document).ready(function(){
	$('#form-checkout').validate();
	$('#btn-shipping').click(function(){
		$('#form-checkout').submit();
	});
});