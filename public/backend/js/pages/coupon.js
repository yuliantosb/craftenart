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