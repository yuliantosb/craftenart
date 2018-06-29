$(document).ready(function(){

	$('[name="fee"]').click(function(){
		$('#btn-shipping').removeAttr('disabled');
		$(this).prev().find('[name="selected"]').attr('selected', 'selected');
	});

	$('.select2').select2();

	$('[name="province_id"]').change(function(){
		var province_id = $(this).val();
		var cities = getCity(province_id);
			
		$('[name="city_id"]').find('option').remove();
		$('[name="city_id"]').select2({
			data: cities
		});

	});

	$('[name="city_id"]').change(function(){
		var city_id = $(this).val();
		$('#btn-shipping').attr('disabled', 'disabled');

		$.ajax({
			url: SITE_URL + '/region/cost',
			type: 'post',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'html',
			data: {
				destination: city_id
			},
			beforeSend: function(){
				$('#loading').show();
			},
			success: function(html){
				$('#shipping').html(html);

				$('[name="fee"]').click(function(){
					$('#btn-shipping').removeAttr('disabled');
					$(this).prev().find('[name="selected"]').attr('selected', 'selected');
				});
			},
			complete: function()
			{
				$('#loading').hide();
			}
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
