var thumb;
$(document).ready(function(){
	$('.btn-open-media').click(function(){
		$('#modal-media').modal('show');
		thumb = $(this).data('type');
	});

	$('#btn-use').click(function(){

		var img = $('.image-browser').find('.selected').children().attr('src');
		var id = $('.image-browser').find('.selected').children().data('value');
		var filename = $('.image-browser').find('.selected').children().data('name');

		$('#input-'+thumb).val(filename);
		
		get_data();
		$('.details').hide();

	});

	$('#form-add-edit').validate();
})