$('#btn-check').click(function(){
	var res = $.ajax({
		url: `${SITE_URL}/coupon`,
		type: 'post',
		dataType: 'json',
		data: {
			coupon_code: $('[name="coupon_code"]').val()
		},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		async: false
	});

	response = res.responseJSON;

	if (response.type === 'success') {

		$('#coupon-code').modal('hide');
		$('#form-coupon').hide();
		$('#coupon-applied').html(response.data.coupon_applied);
		$('#discount').text(`(${response.data.discount})`);
		$('#total').text(response.data.total);
		
	} else {
		$('#coupon-input').addClass('has-error');
		$('#coupon-block').text(response.message);
	}

	$('#btn-remove-coupon').click(function(){
		var id = $(this).data('id');
		removeCoupon(id);
	});

});

$('#btn-remove-coupon').click(function(){
	var id = $(this).data('id');
	removeCoupon(id);
});

$('[name="card_number"]').keyup(function(){
	var card = $(this).val();
	if (card.length === 6) {
		getCardInfo(card);
	}
	if (card.length < 6) {
		$('#card-image').removeAttr('src');
	}
});

$('[name="card_number"]').blur(function(){
	var string = $(this).val();
	var card = string.split(' ').join('');
	$(this).val(card);
	getCardInfo(card);
});

function getCardInfo(card) {
	var cardcheck = checkCard(card);
	if (cardcheck.type == 'success') {
		if (cardcheck.image != null) {
			$('#card-image').attr('src', cardcheck.image);
			$('#error-card').text('');
		}
	} else {
		$('#card-image').removeAttr('src');
		$('#error-card').text(cardcheck.message);
	}
}

function checkCard(cardNumber) {
	var res = $.ajax({
		url: `${SITE_URL}/checkout/check_card/${cardNumber}`,
		type: 'get',
		dataType: 'json',
		async: false
	});
	return res.responseJSON;
}

$.extend(true, $.fn.datetimepicker.defaults, {
	icons: {
		time: "fa fa-clock",
		date: "fa fa-calendar",
		up: "fa fa-arrow-up",
		down: "fafas fa-arrow-down",
		previous: "fa fa-chevron-left",
		next: "fa fa-chevron-right",
		today: "fa fa-calendar-check",
		clear: "fa fa-trash-alt",
		close: "fa fa-times-circle"
	}
});

$('[name="expiration_date"]').datetimepicker({
	format: 'MM/YY',
	useCurrent: false
});

function removeCoupon(id){
	var res = $.ajax({
		url: `${SITE_URL}/coupon/${id}`,
		type: 'delete',
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		async: false
	});

	var response = res.responseJSON;

	$('#discount').text(`(${response.data.discount})`);
	$('#total').text(response.data.total);	

	$('#form-coupon').show();
	$('#coupon-applied').html('');
	$('#coupon-code').modal('hide');
}