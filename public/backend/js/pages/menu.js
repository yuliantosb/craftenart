$(document).ready(function(){

	var ns = $('ol.sortable').nestedSortable({
		forcePlaceholderSize: true,
		handle: 'div',
		helper:	'clone',
		items: 'li',
		opacity: .6,
		placeholder: 'placeholder',
		revert: 250,
		tabSize: 25,
		tolerance: 'pointer',
		toleranceElement: '> div',
		maxLevels: 3,
		isTree: true,
		expandOnHover: 700,
		startCollapsed: false,
		change: function(){
			console.log('Relocated item');
		}
	});

	$('.btn-add').click(function(){

		$.ajax({
			url: SITE_URL + '/menu',
			type: 'post',
			dataType: 'json',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: {
				name: $('#form-add [name="name"]').val(),
				url: $('#form-add [name="url"]').val(),
				widget_id: $('#form-add [name="widget_id"]').val(),
				is_mega: $('#form-add [name="is_mega"]').is(':checked') ? 1 : 0,
				widget_name: $('#form-add [name="widget_name"]').val(),
				type: $(this).data('type'),
			},
			beforeSend: function(){
				$(this).html('Loading...');
			},
			success: function(data){
				show_notification(data.title, data.type, data.message);
				get_data();
			},
			error: function(error, sts, xhr){
  				show_notification('Error', 'error', xhr);
  			},
  			complete: function(){
  				$(this).html('Add to menu');
  				$('input[type="text"]').val('');
  				$('input[type="checkbox"]').prop('checked', false);
  				$('select').val(null).trigger('change');
  			}
		});
	});


	$('#btn-save').click(function(){
		var id = $(this).data('value');
		var data = $('#form-edit').serializeArray();
		var form = $('#form-edit').validate();

		if (form.form()) {

			$.ajax({
				url: SITE_URL + '/menu/'+id,
				type: 'put',
				dataType: 'json',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: data,
				beforeSend: function(){
					$('#btn-save').html('Loading...');
					$('#btn-save').attr('disabled', 'disabled');
				},
				success: function(data){
					show_notification(data.title, data.type, data.message);
				},
				error: function(error, sts, xhr){
	  				show_notification('Error', 'error', xhr);
	  			},
	  			complete: function(){
	  				$('#btn-save').html('Save Changes');
					$('#btn-save').removeAttr('disabled');

	  				get_data();

	  				$('#modal-edit').modal('hide');
	  			}
			});

		}

	});

	get_data();

});

function on_bulk_edit() {
	var data = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
	
	$.ajax({

		url: SITE_URL + '/menu/bulk_edit',
		type: 'post',
		dataType: 'json',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data: {
			data: data
		},
		success: function(data){
			show_notification(data.title, data.type, data.message);
			get_data();
		},
		error: function(error, sts, xhr){
			show_notification('Error', 'error', xhr);
		}

	});
}

function get_data() {
	$.ajax({

		url: SITE_URL + '/menu',
		type: 'get',
		dataType: 'html',
		success: function(html){

			$('#menu-content').html(html);

			$('.sortable').nestedSortable({
				forcePlaceholderSize: true,
				handle: 'div',
				helper:	'clone',
				items: 'li',
				toleranceElement: '> div',
				maxLevels: 3,
				placeholder: 'placeholder',
				tolerance: 'pointer',
				isTree: true,
				relocate: function(){
					on_bulk_edit();
				}
			});

		}
	});
}

function on_edit(val) {

	$('#modal-edit').modal('show');
	var data_menu = get_menu_by_id(val);
	$('[name="name"]').val(data_menu.name);
	$('[name="url"]').val(data_menu.url);
	$('[name="parent_id"]').val(data_menu.parent_id).trigger('change');
	$('[name="order_number"]').val(data_menu.order_number);
	$('#btn-save').data('value', val);

}

function get_menu_by_id(id)
{
	var res = $.ajax({
		url: SITE_URL + '/menu/'+id+'/edit',
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

function on_delete(id)
{

	$.ajax({
		url: SITE_URL + '/menu/'+id,
		type: 'delete',
		dataType: 'json',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success: function(data){
			show_notification(data.title, data.type, data.message);
		},
		error: function(error, sts, xhr){
			show_notification('Error', 'error', xhr);
		},
		complete: function(){
			get_data();
		}
	});
}