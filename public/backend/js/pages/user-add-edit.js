$(document).ready(function(){

	$('#form-add-edit').validate({
		rules: {
			retype_password: {
		      equalTo: '[name="password"]'
		    }
		},

	    messages: {
			retype_password: {
	        	equalTo: 'Password not match'
	        }
	    }
	});

	$('[name="province_id"]').change(function(){
		var province_id = $(this).val();
		var cities = getCity(province_id);
			
		$('[name="city_id"]').find('option').remove();
		$('[name="city_id"]').select2({
			data: cities
		});

	});


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


});

function getCity(province_id)
{
	var res = $.ajax({
		url: SITE_URL + '/region/city',
		type: 'get',
		dataType: 'json',
		data: {
			province_id: province_id
		},
		async: false
	});

	return res.responseJSON;
}