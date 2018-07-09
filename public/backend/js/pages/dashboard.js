var getChart;
var getDonut;
var getChartBar;
var line;
var bar;

$(document).ready(function(){

	getChart = getData();
	getDonut = getDataDonut();
	getChartBar = getDataBar();

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

	bar = Morris.Bar({
		element: 'chart-order-status',
		barGap:4,
		barSizeRatio:0.55,
		xLabelMargin: 10,
		data: getChartBar.data,
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Orders'],
		hideHover: true,
		barColors: function (row, series, type) {

			if(row.label == 'Complete') return '#7AC29A';
			else if(row.label == 'Process') return '#7A9E9F';
			else if(row.label == 'Challenge') return '#F3BB45';
			else if(row.label == 'Pending') return '#427C89';
			else return '#EB5E28';
		}
	});

	$('[name="year"]').change(function(){
        getChart = getData();
        line.setData(getChart.data);
    });

    $('[name="year_order_status"]').change(function(){
        getChartBar = getDataBar();
        bar.setData(getChartBar.data);
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

function getDataBar() {

	var res = $.ajax({
		url: SITE_URL + '/dashboard/get_data_order_status',
		type: 'get',
		dataType: 'json',
		data: {
			year: $('[name="year_order_status"]').val()
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