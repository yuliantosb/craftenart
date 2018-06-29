var tTag;
$(document).ready(function(){
	tTag = $('#table-tag').DataTable({
		ajax : SITE_URL + '/tag',
		columns: [
			{ data: 'name', name: 'name' },
			{ data: 'description', name: 'description' },
			{ data: 'type', name: 'type' },
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