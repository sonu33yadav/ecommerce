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

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="{{asset('plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/toggle-sidebar/css/sidemenu.css')}}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{asset('plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/iconfonts/icons.css')}}" rel="stylesheet" />

    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}">

    <link href="{{asset('css/style.css')}}" rel="stylesheet" />

    @yield('page-css')

</head>
<body class="app">
<div id="global-loader" ></div>

<div class="page">
    <div class="page-main">
        @include('layouts.navbar')

        @include('layouts.sidebar')

        <div class="app-content my-3 my-md-5">
            @yield('content')

            {{--            @include('admin.layout.footer')--}}
        </div>
    </div>
</div>

@include('auth.logout')

<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>

<script src="{{asset('js/vendors/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/vendors/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/popover.js')}}"></script>
<script src="{{ asset('plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<script src="{{asset('js/custom.js')}}"></script>

@yield('page-js')

</body>
</html>
