var tArticle;
$(document).ready(function(){

	tArticle = $('#table-post').DataTable({
		ajax : SITE_URL + '/post',
		columns: [
			{ data: 'title', name: 'title' },
			{ data: 'comment.count', name: 'comment.count' },
			{ data: 'user.name', name: 'user.name' },
			{ data: 'categories.name', name: 'categories.name' },
			{ data: 'tags.name', name: 'tags.name' },
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