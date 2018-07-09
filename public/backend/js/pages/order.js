var tOrder;
$(document).ready(function(){
	tOrder = $('#table-order').DataTable({
		ajax : SITE_URL + '/order',
		columns: [
			{ data: 'fullname', name: 'fullname' },
			{ data: 'number', name: 'number' },
			{ data: 'payment_type', name: 'payment_type' },
			{ data: 'total', name: 'total', class: 'text-right' },
			{ data: 'status', name: 'status', class: 'text-center' },
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