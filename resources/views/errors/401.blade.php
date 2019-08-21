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
    <link href="{{ asset('backend/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/js/bootstrap.js') }}" rel="stylesheet">
    <link href="{{ asset('backend/js/jquery-1.10.2.js') }}" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="{{ asset('backend/css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/font-awesome/css/font-awesome.min.css') }}">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

</head>

<body>
    <div class="container flex-column justify-content-center">
        <div class="item text-center">
            <a href="{{route('backend.dashboard.index')}}" class="btn btn-primary"><i class="fa fa-home"></i> Quay lại
                Admin</a>
            <img src="{{asset('images/error/404.png')}}" class="img-circle"/>
        </div>
        <div class="messenge justify-content-center">
            <div class="alert alert-warning row">
                <h3><i class="fa fa-warning text text-warning"></i> OPSS ! Có lỗi xảy ra</h3>
                <h3><i class="fa fa-warning text text-warning"></i> Bạn không có quyền truy cập trang này</h3>
            </div>
        </div>
    </div>
</body>
