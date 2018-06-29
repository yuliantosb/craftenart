var tCategory;
$(document).ready(function(){
	tCategory = $('#table-category').DataTable({
		ajax : {
			url : SITE_URL + '/category',
			data: function(d) {
				d.type = $('[name="type"]').val();
			}
		},
		columns: [
			{ data: 'name', name: 'name' },
			{ data: 'description', name: 'description' },
			{ data: 'type', name: 'type' }
		],
		order: [0, 'asc']
	});

	$('#btn-confirm').click(function(){
		var id = $(this).data('id');
		$('#form-delete-'+id).submit();
	});

	$('[name="type"]').change(function(){
		tCategory.draw();
	});

});

function on_delete(id)
{
	$('#modal-delete-confirm').modal('show');
	$('#btn-confirm').data('id', id);
}