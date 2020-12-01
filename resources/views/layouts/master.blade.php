<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/theme/images/favicon.png')}}">
    <title>E-Office</title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/chartist-js/dist/chartist-init.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/css-chart/css-chart.css')}}" rel="stylesheet">
    <link href="{{asset('assets/theme/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/theme/css/blue.css')}}" id="theme" rel="stylesheet">
    <link href="{{asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{mix('css/dev.css')}}">
    @stack('style')
    <script src="{{asset('assets/plugins/calendar/main.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        @include('layouts.header')
        @yield('content')
    </div>
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/theme/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/theme/js/waves.js')}}"></script>
    <script src="{{asset('assets/theme/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('assets/theme/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <script src="{{asset('assets/plugins/toast-master/js/jquery.toast.js')}}"></script>
    <!-- This is data table -->
    <script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="http://malsup.github.io/jquery.blockUI.js"></script>
    <script src="{{asset('assets/js/wrapper.js')}}"></script>
    <script src="{{mix('js/dev.js')}}"></script>
    <script>
        var BASE_URL = '{{url('')}}';
        var route_prefix = "/admin/filemanager";
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        $( document ).ready(function() {
            @if(session()->has('message'))
                toast("{!! session()->get('message') !!}", "{!! session()->get('level') !!}")
            @endif
        });
    </script>
    @stack('script')
</body>

</html>