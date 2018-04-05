var tableProduct;
$(document).ready(function(){
	tableProduct = $('#table-product').DataTable({
		ajax : SITE_URL + '/product',
		columns: [
			{
                "className":      'details-control text-center',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": '',
            },
			{ data: 'name', name: 'name' },
			{ data: 'price', name: 'price', class:'text-right' },
			{ data: 'stock.amount', name: 'stock.amount', class: 'text-center' },
			{ data: 'categories.name', name: 'categories.name' },
			{ data: 'tags.name', name: 'tags.name' },
		],
		order: [1, 'asc']
	});

	$('#table-product tbody').on('click', 'td.details-control', function () {
	    var tr = $(this).closest('tr');
	    var row = tableProduct.row( tr );

	    if ( row.child.isShown() ) {
	        // This row is already open - close it
	        row.child.hide();
	        tr.removeClass('shown');
	    }
	    else {
	        // Open this row
	        row.child( template(row.data()) ).show();
	        tr.addClass('shown');
	    }
	});

	function template(d) {

		description = d.description === null ? 'No Description attached' : d.description;
		galleries = '';

		$.each(d.galleries, function(i, v){
			galleries += '<div class="col-md-6 no-gutters" style="margin-bottom: 10px"><img src="'+ BASE_URL + '/uploads/thumbs/' + v.picture +'" class="img img-thumbnail img-responsive"></div>';
		});

		return ' <div class="col-md-row">' +
			        '<div class="col-md-3">' +
			            '<p class="text-primary">Feature Image</p class="text-primary">' +
			            '<img src="'+ BASE_URL + '/uploads/' + d.picture +'" class="img img-thumbnail img-responsive">' +
			        	'<div class="row" style="margin-top: 20px">' + galleries + '</div>' +
			        '</div>' +
			        '<div class="col-md-9">' +
			            '<p class="text-primary">Description</p class="text-primary">' +
			            '<p>'+ description +'</p>' +
			        '</div>' +
			    '</div>';
	}

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