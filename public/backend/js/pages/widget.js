var tWidget;
$(document).ready(function(){
	tWidget = $('#table-widget').DataTable({
		ajax : SITE_URL + '/widget',
		columns: [
			{ data: 'name', name: 'name' },
			{ data: 'type', name: 'type' },
			{ data: 'limit', name: 'limit' }
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