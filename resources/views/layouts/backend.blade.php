<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trang quản trị</title>

    <!-- Bootstrap core CSS -->
    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    <link href="{{ asset('backend/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/js/bootstrap.js') }}" rel="stylesheet">
    <link href="{{ asset('backend/js/jquery-1.10.2.js') }}" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="{{ asset('backend/css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/font-awesome/css/font-awesome.min.css') }}">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer>
    </script><script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>

<div id="wrapper">

    <!-- Sidebar -->
@include('backend.partitions.top')
@include('backend.partitions.left')
@include('flash-message')
@yield('content')

<!-- /#page-wrapper -->

</div><!-- /#wrapper -->

<!-- JavaScript -->
<script src="{{ asset('backend/js/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.js') }}"></script>
<!-- Page Specific Plugins -->
{{--<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>--}}
{{-- <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script> --}}
{{--<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>--}}
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="{{ asset('backend/js/morris/chart-data-morris.js') }}"></script>
<script src="{{ asset('backend/js/tablesorter/jquery.tablesorter.js') }}"></script>
<script src="{{ asset('backend/js/tablesorter/tables.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>--}}

</body>
</html>
