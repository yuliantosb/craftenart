var tReview;
$(document).ready(function(){
	tReview = $('#table-review').DataTable({
		ajax : SITE_URL + '/review',
		columns: [
			{ data: 'user.name', name: 'user.name' },
			{ data: 'rate', name: 'rate' },
			{ data: 'product.name', name: 'product.name' },
			{ data: 'content', name: 'content' },
			{ data: 'status', name: 'status' },
		],
		order: [1, 'asc']
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