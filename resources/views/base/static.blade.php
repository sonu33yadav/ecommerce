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
    <!-- Plugin Style -->
    <link href="{{asset('plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
    <link href="{{asset('plugins/toggle-sidebar/css/sidemenu.css')}}" rel="stylesheet" />

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!---Font icons-->
    <link href="{{asset('plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/iconfonts/icons.css')}}" rel="stylesheet" />

    <link rel="icon" href="{{ asset('images/logo.jpeg') }}">
    @yield('page-css')

    <script src="{{asset('js/vendors/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/vendors/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/popover.js')}}"></script>

    <!-- Plugin js -->
    <script src="{{ asset('plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
    <script src="{{ asset('plugins/date-picker/spectrum.js') }}"></script>
    <script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.maskedinput.js') }}"></script>
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
</head>
<body class="app">
<div id="global-loader" ></div>
<!-- Header Area wrapper Starts -->
@include('base.navbar')
<!-- Header Area wrapper End -->

@include('base.auth_dialog')

@yield('content')

@include('auth.logout')
<!--Back to top-->
<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
<!-- Footer Section Start -->
@include('base.footer')
<!-- Footer Section End -->

<!-- Custom scroll bar Js-->
<script>
    let dashboard = '{{session('dashboard')}}';
</script>
<!-- Custom Js-->
<script src="{{asset('js/custom.js')}}"></script>
<!-- Auth Js-->
<script src="{{asset('js/auth.js')}}"></script>
@yield('page-js')
</body>
</html>
