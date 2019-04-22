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
		$('#discount').text(`(${data.data.discount})`);
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
		$('#discount').text(`(${data.data.discount})`);
		$('#taxes').text(data.data.taxes);
		$('#shipping_fee').text(data.data.shipping_fee);
		$('#total').text(data.data.total);
	});

	$('[name="fee"]').click(function(){
		addFee($(this).val());
	});

	$('[name="delete"]').click(function(){
		var id = $(this).val();
		var data = deleteCart(id);

		$('#subtotal').text(data.data.subtotal);
		$('#discount').text(`(${data.data.discount})`);
		$('#taxes').text(data.data.taxes);
		$('#shipping_fee').text(data.data.shipping_fee);
		$('#total').text(data.data.total);
		$('#row-'+id).fadeOut('fast');

		if (data.count < 1) {
			location.reload();
		}
				
	});

	$('[name="province_id"]').change(function(){
		var province_id = $(this).val();
		if (province_id != "") {
			var cities = getCity(province_id);
			
			$('[name="city_id"]').find('option').remove();
			$('[name="city_id"]').select2({
				data: cities
			});
		}

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

$('[data-toggle="tooltip"]').tooltip();

$('#btn-change-address').click(function(){
	$('#modal-edit-address').modal('show');
});

$('#btn-add-new-address').click(function(){
	var form = $('#form-add-address').validate();
	var data = $('#form-add-address').serializeArray();
	if (form.form()){
		var html = '';
		var result = addAddress(data);

		$.each(result.data, function(i, v){
			html += `<tr>
						<td>
							<input type="radio" name="address" value="${v.id}">
						</td>
						<td>
							${v.text}
						</td>
						<td>
							<button class="btn btn-sm btn-link text-danger" type="button" onclick="onDelete(${ v.id })"><i class="fa fa-times"></i></button>
						</td>
					</tr>
					`;
		});

		$('#table-addresses').html(html);

		resetForm();
		$('#addaddress').collapse('hide');
	}
});

function addAddress(data) {
	var res = $.ajax({
		url: `${SITE_URL}/cart/add_address`,
		data: data,
		type: 'post',
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		async: false,
	});

	return res.responseJSON;
}

function resetForm() {
	$('#form-add-address').trigger('reset');
	$('[name="province_id"').val(null).trigger('change');
	$('[name="city_id"]').find('option').remove();
}

function onDelete(id){
	var res = $.ajax({
		url: `${SITE_URL}/cart/remove_address/${id}`,
		type: 'delete',
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		async: false,
	});

	var html = '';
	var result = res.responseJSON;

	if (result.data.length > 0) {
		$.each(result.data, function(i, v){
			html += `<tr>
						<td>
							<input type="radio" name="address" value="${v.id}">
						</td>
						<td>
							${v.text}
						</td>
						<td>
							<button class="btn btn-sm btn-link text-danger" type="button" onclick="onDelete(${ v.id })"><i class="fa fa-times"></i></button>
						</td>
					</tr>
					`;
		});
	} else {
		html += `<tr>
					<td colspan="2" class="text-center">No address yet</td>
				</tr>`;
	}

	$('#table-addresses').html(html);
}

function changeAddress(id)
{
	var res = $.ajax({
		url: `${SITE_URL}/cart/change_addresses`,
		type: 'post',
		dataType: 'json',
		data: {
			address_id: id
		},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		async: false,
	});

	return res.responseJSON;
}


$('#button-change-address').click(function(){
	var data = changeAddress($('[name="address"]:checked').val());

	$('#empty-address').hide();
	$('#address-placeholder').text(data.cost.address);
	$('#title-shipping').show();
	$('#shipping-courier').html(data.cost.couriers);
	$('#subtotal').text(data.cost.subtotal);
	$('#discount').text(`(${data.cost.discount})`);
	$('#taxes').text(data.cost.taxes);
	$('#shipping_fee').text(data.cost.shipping_fee);
	$('#total').text(data.cost.total);

	$('#btn-checkout').attr('disabled', 'disabled');
	$('#btn-checkout').addClass('disabled');
	$('#btn-checkout').attr('title', 'You must select the courier first');

	$('[name="fee"]').click(function(){
		addFee($(this).val());
		$('#btn-checkout').removeAttr('disabled');
		$('#btn-checkout').removeClass('disabled');
		$('#btn-checkout').attr('title', '');
		$('#btn-checkout').click(function(){
			window.location.href = $(this).attr('href');
		});
	});

});

function addFee(index) {
	$('#btn-checkout').removeAttr('disabled');
	$('#btn-checkout').removeClass('disabled');
	$('#btn-checkout').attr('title', '');
	$('#btn-checkout').click(function(){
		window.location.href = $(this).attr('href');
	});

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
	$('#discount').text(`(${data.data.discount})`);
	$('#taxes').text(data.data.taxes);
	$('#shipping_fee').text(data.data.shipping_fee);
	$('#total').text(data.data.total);
}