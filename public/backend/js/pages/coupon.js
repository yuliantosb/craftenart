var tCoupon;
$(document).ready(function(){
	tCoupon = $('#table-coupon').DataTable({
		ajax : SITE_URL + '/coupon',
		columns: [
			{
                "className":      'details-control text-center',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": '',
            },
			{ data: 'code', name: 'code' },
			{ data: 'amount', name: 'amount', class: 'text-right' },
			{ data: 'valid_thru', name: 'valid_thru' }
		],
		order: [1, 'asc']
	});

	$('#table-coupon tbody').on('click', 'td.details-control', function () {
	    var tr = $(this).closest('tr');
	    var row = tCoupon.row( tr );

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

		return ' <div class="col-md-row">' +
			        '<div class="col-md-12">' +
			        	'<table class="table table-primary">' +
			        		'<tr>' +
			        			'<td>Min Amount </td>' +
			        			'<td>'+ d.min_amount_values + '</td>' +
			        		'</tr>' +
			        		'<tr>' +
			        			'<td>Max Amount </td>' +
			        			'<td>'+ d.max_amount_values + '</td>' +
			        		'</tr>' +
			        		'<tr>' +
			        			'<td> Single Use </td>' +
			        			'<td>'+ d.is_single_use + '</td>' +
			        		'</tr>' +
			        		'<tr>' +
			        			'<td> Exclude User </td>' +
			        			'<td>'+ d.include_user_values + '</td>' +
			        		'</tr>' +
			        	'</table>' +
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