<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/jquery.selectBox.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/dropzone.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/rangeslider.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/leaflet.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/slick.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/slick-theme.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/slick-theme.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/map.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/jquery.mCustomScrollbar.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/fonts/flaticon/font/flaticon.css') }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('front/assets/img/favicon.ico') }}" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" id="" href="{{ asset('front/assets/css/skins/default.css') }}">
   @yield('style')
</head>
<body id="top" class="index-body">
<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDTWJ3Z"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) -->
@include('layouts.front.head')
<!-- main header end -->
@yield('content')
@include('layouts.front.footer')


<!-- External JS libraries -->
<script src="{{ asset('front/assets/js/jquery-2.2.0.min.js') }}"></script>
<script src="{{ asset('front/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.selectBox.js') }}"></script>
<script src="{{ asset('front/assets/js/rangeslider.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.filterizr.js') }}"></script>
<script src="{{ asset('front/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('front/assets/js/backstretch.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.countdown.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.scrollUp.js') }}"></script>
<script src="{{ asset('front/assets/js/particles.min.js') }}"></script>
<script src="{{ asset('front/assets/js/typed.min.js') }}"></script>
<script src="{{ asset('front/assets/js/dropzone.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.mb.YTPlayer.js') }}"></script>
<script src="{{ asset('front/assets/js/leaflet.js') }}"></script>
<script src="{{ asset('front/assets/js/leaflet-providers.js') }}"></script>
<script src="{{ asset('front/assets/js/leaflet.markercluster.js') }}"></script>
<script src="{{ asset('front/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front/assets/js/maps.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4omYJlOaP814WDcCG8eubXcbhB-44Uac"></script> -->
<script src="{{ asset('front/assets/js/ie-emulation-modes-warning.js') }}"></script>
<!-- Custom JS Script -->
<script  src="{{ asset('front/assets/js/app.js') }}"></script>
@yield('script')
</body>
</html>