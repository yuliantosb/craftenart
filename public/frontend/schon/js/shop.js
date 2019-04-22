$(document).ready(function(){
	$(".slider").slider().on('slide', function(val){
		$('#range-from').number(val.value[0], 0, decimal_separator, thousand_separator);
		$('#range-to').number(val.value[1], 0, decimal_separator, thousand_separator);
	});
});