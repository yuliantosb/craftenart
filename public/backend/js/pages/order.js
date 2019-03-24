var tOrder;
$(document).ready(function(){
	tOrder = $('#table-order').DataTable({
		serverSide: true,
		ajax : SITE_URL + '/order',
		columns: [
			{ name: 'first_name' },
			{ name: 'number' },
			{ name: 'payment_type' },
			{ name: 'total', class: 'text-right' },
			{ name: 'status', class: 'text-center' },
		],
		order: [1, 'desc']
	});

	$('#btn-confirm').click(function(){
		var id = $(this).data('id');
		$('#form-delete-'+id).submit();
	});

});

function on_delete(id)
{
	$('#modal-delete-confirm').modal('show');
	$('#btn-confirm').data('id', id);
}