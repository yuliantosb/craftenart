<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ url('uploads/'.App\Setting::getSetting('favicon')->img) }}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name') }} - @yield('title') </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ url('backend/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ url('backend/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ url('backend/css/paper-dashboard.css') }}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ url('backend/css/demo.css') }}" rel="stylesheet" />

    <!-- DataTables -->
    <link href="{{ url('backend/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" />

    <!-- dropzone -->
    <link href="{{ url('backend/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Select2 -->
    <link href="{{ url('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- datepicker -->
    <link href="{{ url('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- datetimepicker -->
    <link href="{{ url('backend/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!--  Fonts and icons     -->
    <link href="{{ url('backend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ url('backend/css/themify-icons.css') }}" rel="stylesheet">

    <!-- morrins -->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/plugins/morris/morris.css') }}">

</head>
<body>
<script type="text/javascript">
    var SITE_URL = "{{ url('admin') }}";
    var BASE_URL = "{{ url('') }}";
</script>
<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            @include('backend.layouts.sidebar')
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            @include('backend.layouts.navbar')
        </nav>


        <div class="content">
            @yield('content')
        </div>


        <footer class="footer">
            @include('backend.layouts.footer')
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{ url('backend/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
	<script src="{{ url('backend/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!-- sortable -->
    <script src="{{ url('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ url('backend/plugins/jquery-sortable/jquery.mjs.nestedSortable.js') }}"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{ url('backend/js/bootstrap-checkbox-radio.js') }}"></script>

	<!--  Charts Plugin -->
	<script src="{{ url('backend/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ url('backend/js/bootstrap-notify.js') }}"></script>

    <!-- datatable -->

    <!-- DataTable -->
    <script src="{{ url('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('backend/plugins/datatables/dataTables.bootstrap.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ url('backend/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Dropzone -->
    <script src="{{ url('backend/plugins/dropzone/dropzone.min.js') }}"></script>
    <!-- Jquery Validator -->
    <script src="{{ url('backend/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <!-- moment -->
    <script src="{{ url('backend/plugins/moment/moment.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ url('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- datetimepicker -->
    <script src="{{ url('backend/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    

    <!-- autoNumeric -->
    <script src="{{ url('backend/plugins/autoNumeric/autoNumeric.js') }}"></script>
    <!-- tinymce -->
    <script src="{{ url('backend/plugins/tinymce/tinymce.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="{{ url('backend/js/paper-dashboard.js') }}"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="{{ url('backend/js/demo.js') }}"></script>
    <script src="{{ url('backend/js/general.js') }}"></script>

    @stack('js')

</html>
