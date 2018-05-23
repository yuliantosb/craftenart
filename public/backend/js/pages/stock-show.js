var tStock;
$(document).ready(function(){
	tStock = $('#table-stock-details').DataTable({
		ajax : SITE_URL + '/stock/'+$('[name="stock_id"]').val(),
		columns: [
			{ data: 'description', name: 'description' },
			{ data: 'amount', name: 'amount' },
		],
		ordering: false
	});

	$('#btn-add').click(function(){
		$('#modal-add').modal('show');
	});

	$('#btn-save').click(function(){
		var form = $('#form-add').validate();
		if (form.form()) {
			data = $('#form-add').serializeArray();
			$.ajax({
				url: SITE_URL + '/stock',
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				data: data,
				type: 'post',
				dataType: 'json',
				beforeSend: function() {
					$('#btn-save').attr('disabled', 'disabled');
					$('#btn-save').text('Loading ...');
				},
				success: function(data) {
					show_notification(data.title, data.type, data.message);
					$('#current-stock').text(data.current_stock);
				},
				error: function(xhr, status, error) {
					show_notification('Error', 'error', error);
				},
				complete: function() {
					$('#modal-add').modal('hide');

					$('#btn-save').removeAttr('disabled', 'disabled');
					$('#btn-save').text('Submit');

					$('#form-add input[type="text"]').val('');
					$('#form-add textarea').val('');

					$('#form-add').trigger('reset').validate().resetForm();
				  	$('.form-group').removeClass('has-error');
				  	$('.help-block').html('');

					tStock.draw();
				}
			});
		}
	});	

});

function on_delete(id)
{
	$('#modal-delete-confirm').modal('show');
	$('#btn-confirm').data('id', id);
}

