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



	$('#btn-add-row-banner').click(function(){

		var table;

		$('#no-data-banner').remove();

  		var row_length = $('#table-banner > tbody > tr').length;

		table = '<tr>' + 
                    '<td style="vertical-align: top;">' +
                        '<div class="input-group"> ' +
                            '<input type="text" class="form-control" placeholder="Banner" readonly="readonly" name="banner[img][]" id="input-banner-img-'+ row_length +'"> ' +
                            '<span class="input-group-btn"> ' +
                                '<button class="btn btn-default btn-bordered waves-light waves-light btn-open-media" type="button" data-type="banner-img-'+ row_length +'">Browse</button> ' +
                            '</span> ' +
                        '</div> ' +
                        '<small class="text-primary">Resolution : 1714x564px</small> ' +
                    '</td> ' +
                    '<td>' +
                        '<table class="table-bordered" style="width: 100%">' +
                            '<tr>' +
                                '<td><strong>Text Align</strong></td>' +
                                '<td><input type="text" class="form-control" name="banner[align][]"></td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td><strong>Title</strong></td>' +
                                '<td><input type="text" class="form-control" name="banner[title][]"></td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td><strong>Header text</strong></td>' +
                                '<td><input type="text" class="form-control" name="banner[header][]"></td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td><strong>Sub header text</strong></td>' +
                                '<td><input type="text" class="form-control" name="banner[subheader][]"></td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td style="vertical-align: top"><strong>Content</strong></td>' +
                                '<td><textarea class="form-control" rows="5" name="banner[content][]"></textarea> </td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td><strong>URL</strong></td>' +
                                '<td><input type="text" class="form-control" name="banner[url][]"></td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td><strong>URL text</strong></td>' +
                                '<td><input type="text" class="form-control" name="banner[url_text][]"></td> ' +
                            '</tr>' +
                        '</table>' +
                        
                    '</td> ' +
                    
                '</tr>';

        $('#table-banner > tbody').append(table);

        $('.btn-open-media').click(function(){
			$('#modal-media').modal('show');
			thumb = $(this).data('type');
		});

	});


	$('#btn-remove-row-banner').click(function(){

		$('#table-banner > tbody > tr').last().remove();

		if ($('#table-banner > tbody > tr').length < 1) {
			$('#table-banner > tbody').append('<tr id="no-data-banner">' +
									'<td colspan="2" class="text-center">No data</td>' +
								'</tr>');
		}
	});


	$('#btn-add-row-footer-widget').click(function(){

		var table;

		$('#no-data-footer-widget').remove();

  		var row_length = $('#table-footer-widget tbody tr').length;

		table = '<tr>' +
                    '<td>' +
                    	
                    		'<input type="text" name="footer[title][]" class="form-control" placeholder="Title">' +	
                    	
                    '</td>' +

                     '<td>' +
                    	
                    		'<input type="text" name="footer[align][]" class="form-control" placeholder="Text Align">' +	
                    	
                    '</td>' +

                    '<td>' +
                    	
                    		'<select type="text" name="footer[widget_id][]" class="widget_id" data-placeholder="Select Widget" required="required"></select>' +	
                    	
                    '</td>' +

                '</tr>';

        $('#table-footer-widget tbody').append(table);

        arr_widget = get_widget();

       	$('.widget_id').select2({
       		data: arr_widget
       	});

	});


	$('#btn-remove-row-footer-widget').click(function(){

		$('#table-footer-widget').find('tr').last().remove()

		if ($('#table-footer-widget tbody tr').length < 1) {
			$('#table-footer-widget tbody').append('<tr id="no-data-footer-widget">' +
									'<td colspan="2" class="text-center">No data</td>' +
								'</tr>');
		}
	});


});

function get_widget(){

	var res = $.ajax({
		url: SITE_URL + '/settings/get_widget',
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}