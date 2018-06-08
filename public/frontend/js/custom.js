$(document).ready(function(){
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});

	$('.datepicker').datepicker({
	    format: "yyyy-mm-dd",
	    autoclose: true,
	    todayHighlight: true
	});

	$('.select2').select2();
});

// toast
function show_notification(title, type, message){

    if (type === 'success') {
        icon = 'ti-check';
    } else if (type === 'warning') {
        icon = 'ti-alert';
    } else if (type === 'error') {
        icon = 'ti-close';
    } else {
        icon = 'ti-info';
    }

    $.notify({
        icon: icon,
        message: title +  "<br>" + message,

    },{
        type: type === 'error' ? 'danger' : type,
        timer: 4000
    });

}