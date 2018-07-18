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

		if ($(this).data('id') === undefined) {

			url = SITE_URL + '/menu';
			type = 'post';

		} else {
			url = SITE_URL + '/menu/'+$(this).data('id');
			type = 'put';
		}

		$.ajax({

			url: url,
			type: type,
			dataType: 'json',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: {
				name_en: $('#form-add [name="name_en"]').val(),
				name_id: $('#form-add [name="name_id"]').val(),
				url: $('#form-add [name="url"]').val(),
				widget_id: $('#form-add [name="widget_id"]').val(),
				is_mega: $('#form-add [name="is_mega"]').is(':checked') ? 1 : 0,
				widget_name_en: $('#form-add [name="widget_name_en"]').val(),
				widget_name_id: $('#form-add [name="widget_name_id"]').val(),
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
				on_refresh();
			}
		});
		
	});


	$('.btn-cancel').click(function(){
		on_refresh();
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

	if (data_menu.widget_id === null) {

		$('[name="name_en"]').val(data_menu.name_en);
		$('[name="name_id"]').val(data_menu.name_id);
		$('[name="url"]').val(data_menu.url);

		if (data_menu.is_mega) {
			$('[name="is_mega"]').prop('checked', true);
			$('[name="is_mega"]').parent('div.checkbox').addClass('checked');
		}

		$('#btn-cancel-url').show();
		$('#btn-add-url').text('Save changes');

	} else {

		$('[name="widget_name_en"]').val(data_menu.name_en);
		$('[name="widget_name_id"]').val(data_menu.name_id);
		$('[name="widget_id"]').val(data_menu.widget_id).trigger('change');
		$('#btn-add-widget').text('Save changes');
		$('#btn-cancel-widget').show();
	}

	$('.btn-add').data('id', data_menu.id);

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

function on_refresh()
{
	$('[name="name_en"]').val('');
	$('[name="name_id"]').val('');
	$('[name="url"]').val('');
	$('[name="is_mega"]').prop('checked', false);
	$('[name="is_mega"]').parent('div.checkbox').removeClass('checked');
	$('[name="widget_name_en"]').val('');
	$('[name="widget_name_id"]').val('');
	$('[name="widget_id"]').val('').trigger('change');
	$('#btn-cancel-widget').hide();
	$('#btn-cancel-url').hide();
	$('.btn-add').text('Add to menu');
}