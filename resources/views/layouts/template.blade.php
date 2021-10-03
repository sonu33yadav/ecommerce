<!DOCTYPE html>
<html lang="ja" translate="no">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="ja">

    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="{{asset('fonts/fonts/font-awesome.min.css')}}">

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!---Font icons-->
    <link href="{{asset('plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/iconfonts/icons.css')}}" rel="stylesheet" />

    <link rel="icon" href="{{ asset('images/logo.jpeg') }}">
    @yield('page-css')
</head>
<body class="app">
<div id="global-loader" ></div>

@yield('content')

<script src="{{asset('js/vendors/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/vendors/bootstrap.bundle.min.js')}}"></script>
<!-- Custom scroll bar Js-->
<script src="{{asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Custom Js-->
<script src="{{asset('js/custom.js')}}"></script>
@yield('page-js')
</body>
</html>
