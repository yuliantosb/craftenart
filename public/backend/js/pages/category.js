var tCategory;
$(document).ready(function(){
	tCategory = $('#table-category').DataTable({
		ajax : SITE_URL + '/category',
		columns: [
			{ data: 'name', name: 'name' },
			{ data: 'description', name: 'description' }
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