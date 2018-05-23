var tStock;
$(document).ready(function(){
	tStock = $('#table-stock').DataTable({
		ajax : SITE_URL + '/stock',
		columns: [
			{ data: 'product.name', name: 'product.name' },
			{ data: 'amount', name: 'amount' },
			{ data: 'last_record', name: 'last_record' }
		],
		order: [0, 'asc']
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