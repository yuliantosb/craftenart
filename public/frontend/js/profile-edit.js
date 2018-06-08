$(document).ready(function(){

	$('[name="province_id"]').change(function(){
		var province_id = $(this).val();
		var cities = getCity(province_id);
			
		$('[name="city_id"]').find('option').remove();
		$('[name="city_id"]').select2({
			data: cities
		});

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