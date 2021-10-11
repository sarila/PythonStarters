<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/backend/assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/font-awesome.min.css') }}">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/line-awesome.min.css') }}">

    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/morris/morris.css') }}">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/dataTables.bootstrap4.min.css') }}">

    <!-- Sweet Alert CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/sweetalert.css') }}">


    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/style.css') }}">

    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/dropzone.css') }}">

    <style>
        .active_2{
            color: #fff;
            background-color: rgba(0, 0, 0, 0.2);
        }
        .alert-danger li{
            list-style: none;
        }
        .header-left{
            background: white;
        }
    </style>
</head>
