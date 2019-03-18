$(document).ready(function(){
	$('.disabled').click(function(e){
		e.preventDefault();
	});

	$('[name="qty[]"]').change(function(){
		var qty = $(this).val();
		var id = $(this).data('id');
		var formData = {
			qty: qty,
			id: id
		};

		var data = updateCart(formData);

		$('#total-'+id).text(data.data.total_cart);
		$('#subtotal').text(data.data.subtotal);
		$('#discount').text(data.data.discount);
		$('#taxes').text(data.data.taxes);
		$('#shipping_fee').text(data.data.shipping_fee);
		$('#total').text(data.data.total);

	});

	$('[name="qty[]"]').on('scroll', function(){
		var qty = $(this).val();
		var id = $(this).data('id');
		var formData = {
			qty: qty,
			id: id
		};

		var data = updateCart(formData);

		$('#total-'+id).text(data.data.total_cart);
		$('#subtotal').text(data.data.subtotal);
		$('#discount').text(data.data.discount);
		$('#taxes').text(data.data.taxes);
		$('#shipping_fee').text(data.data.shipping_fee);
		$('#total').text(data.data.total);
	});

	$('[name="fee"]').click(function(){
		$('#btn-shipping').removeAttr('disabled');
		$('#btn-checkout').removeClass('disabled');
		
		var index = $(this).val();
		var formdata = {

					'country_id': $('[name="country_id"]').val(),
					'province_id': $('[name="province_id"]').val(),
					'city_id': $('[name="city_id"]').val(),
					'total_weight': $('[name="total_weight"]').val(),
					'courier_id': $('[name="courier_id['+index+']"]').val(),
					'courier_name': $('[name="courier_name['+index+']"]').val(),
					'cost': $('[name="cost['+index+']"]').val(),
					'service_name': $('[name="service_name['+index+']"]').val(),
					'service_description': $('[name="service_description['+index+']"]').val(),
					'estimate_delivery': $('[name="estimate_delivery['+index+']"]').val()
				};
		
				var data = calculateShip(formdata);

				$('#subtotal').text(data.data.subtotal);
				$('#discount').text(data.data.discount);
				$('#taxes').text(data.data.taxes);
				$('#shipping_fee').text(data.data.shipping_fee);
				$('#total').text(data.data.total);
				
				console.log(data.data);
		


		// $(this).prev().find('[name="selected"]').attr('selected', 'selected');
	});

	$('[name="delete"]').click(function(){
		var id = $(this).val();
		var data = deleteCart(id);

		$('#subtotal').text(data.data.subtotal);
		$('#discount').text(data.data.discount);
		$('#taxes').text(data.data.taxes);
		$('#shipping_fee').text(data.data.shipping_fee);
		$('#total').text(data.data.total);
		$('#row-'+id).fadeOut('fast');

		if (data.count < 1) {
			location.reload();
		}
				
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
					$('#btn-checkout').removeClass('disabled');
					
					var index = $(this).val();
					var formdata = {
			
								'country_id': $('[name="country_id"]').val(),
								'province_id': $('[name="province_id"]').val(),
								'city_id': $('[name="city_id"]').val(),
								'total_weight': $('[name="total_weight"]').val(),
								'courier_id': $('[name="courier_id['+index+']"]').val(),
								'courier_name': $('[name="courier_name['+index+']"]').val(),
								'cost': $('[name="cost['+index+']"]').val(),
								'service_name': $('[name="service_name['+index+']"]').val(),
								'service_description': $('[name="service_description['+index+']"]').val(),
								'estimate_delivery': $('[name="estimate_delivery['+index+']"]').val()
							};
					
					var data = calculateShip(formdata);

					$('#subtotal').text(data.data.subtotal);
					$('#discount').text(data.data.discount);
					$('#taxes').text(data.data.taxes);
					$('#shipping_fee').text(data.data.shipping_fee);
					$('#total').text(data.data.total);
					
					console.log(data.data);
			
			
					// $(this).prev().find('[name="selected"]').attr('selected', 'selected');
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

function calculateShip(formdata)
{
	var res = $.ajax({
		url: SITE_URL + '/cart/shipping',
		type: 'post',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		dataType: 'json',
		data:formdata,
		async: false
	});

	return res.responseJSON;

}

function updateCart(formData)
{
	var res = $.ajax({
		url: SITE_URL + '/cart/update',
		type: 'put',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		dataType: 'json',
		data:formData,
		async: false
	});

	return res.responseJSON;
}

function deleteCart(id)
{
	var res = $.ajax({
		url: SITE_URL + '/cart/remove/'+id,
		type: 'delete',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}