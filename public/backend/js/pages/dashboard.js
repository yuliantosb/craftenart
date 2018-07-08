var getChart;
var getDonut;
var line;

$(document).ready(function(){

	getChart = getData();
	getDonut = getDataDonut();

	Morris.Donut({
		element: 'chart-top-product',
		data: getDonut.data,
		colors: getDonut.colors
	});


	line = new Morris.Line({
	  
	  	element: 'chart-payment',
	  	data: getChart.data,
	  	xkey: 'y',
	 	ykeys: getChart.ykeys,
	    labels: getChart.label,
	    hideHover: true,
        parseTime:false,
        lineColors: getChart.colors,
	
	});

	$('[name="year"]').change(function(){
        getChart = getData();
        line.setData(getChart.data);
    });



});

function getData() {

	var res = $.ajax({
		url: SITE_URL + '/dashboard/get_data_payment',
		type: 'get',
		dataType: 'json',
		data: {
			year: $('[name="year"]').val()
		},
		async: false
	});

	return res.responseJSON;
}

function getDataDonut()
{
	var res = $.ajax({
		url: SITE_URL + '/dashboard/get_data_top',
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}