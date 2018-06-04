$(document).ready(function(){

	$('#form-add-edit').validate();

	$('#is_single_user').change(function(){
		if ($(this).is(':checked')) {
			$('[name="include_user[]"]').removeAttr('disabled');
		} else {
			$('[name="include_user[]"').val(null).trigger('change');
			$('[name="include_user[]"]').attr('disabled', 'disabled');
		}
		
	});

});