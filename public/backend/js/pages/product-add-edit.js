var thumb;
$(document).ready(function(){

	$('.btn-open-media').click(function(){
		$('#modal-media').modal('show');
		thumb = $(this).data('type');
	});

	$('#btn-use').click(function(){

		var img = $('.image-browser').find('.selected').children().attr('src');
		var id = $('.image-browser').find('.selected').children().data('value');
		var filename = $('.image-browser').find('.selected').children().data('name');

		$('#input-'+thumb).val(filename);
		
		get_data();
		$('.details').hide();

	});


	$('#btn-add-row-galleries').click(function(){

		var table;

		$('#empty-row-galleries').remove();

  		var row_length = $('#table-galleries tbody tr').length;

		table = '<tr>' +
                    '<td>' +
                    		 '<div class="input-group">' +
	                            '<input type="text" class="form-control" placeholder="File" readonly="readonly" name="galleries[]" id="input-galleries-img-'+row_length+'">'+
	                            '<span class="input-group-btn">' +
	                                '<button class="btn btn-default btn-bordered waves-light waves-light btn-open-media" type="button" data-type="galleries-img-'+ row_length +'">Browse</button>'+
	                            '</span>' +
	                        '</div>' +
                    '</td>' +
                '</tr>';

        $('#table-galleries tbody').append(table);

        $('.btn-open-media').click(function(){
			$('#modal-media').modal('show');
			thumb = $(this).data('type');
		});

	});

	$('#btn-remove-row-galleries').click(function(){

		$('#table-galleries').find('tr').last().remove()

		if ($('#table-galleries tbody tr').length < 1) {
			$('#table-galleries tbody').append('<tr id="empty-row-galleries">' +
									'<td class="text-center">No data</td>' +
								'</tr>');
		}

	});



	$('#btn-add-row-attributes').click(function(){

		var table;

		$('#empty-row-attributes').remove();

  		var row_length = $('#table-attributes tbody tr').length;

		table = '<tr>' +
                    '<td>' +
	                     '<input type="text" class="form-control" placeholder="Attribute Name" name="attribute_name[]">'+
                    '</td>' +
                    '<td style="width: 350px">' +
	                    '<select class="form-control select2" data-tags="true" data-placeholder="Attribute Value" name="attribute_value['+row_length+'][]" multiple="true" style="width: 100% !important"></select>'+
                    '</td>' +
                '</tr>';

        $('#table-attributes tbody').append(table);
        $('.select2').select2();

	});

	$('#btn-remove-row-attributes').click(function(){

		$('#table-attributes').find('tr').last().remove()

		if ($('#table-attributes tbody tr').length < 1) {
			$('#table-attributes tbody').append('<tr id="empty-row-attributes">' +
									'<td class="text-center" colspan="2">No data</td>' +
								'</tr>');
		}

	});

	$('button[type="reset"]').click(function(){
		$('select').val(null).trigger('change');
	});

});