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

  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('backend/assets/examples/css/tables/datatable.min599c.css?v4.0.2') }}">
    
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
@include('layouts.front.head')
<!-- main header end -->

<!-- Sidenav start -->
<nav id="sidebar" class="nav-sidebar">
    <!-- Close btn-->
    <div id="dismiss">
        <i class="fa fa-close"></i>
    </div>
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <img src="assets/img/logo.png" alt="sidebarlogo">
        </div>
        
        <div class="sidebar-navigation">
            <div class="dropdown p-2 pb-3">
                <a data-mdb-dropdown-init class="dropdown-toggle" href="#" id="Dropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <i class="flag-united-kingdom flag m-0"></i> English
                </a>
            
                <ul class="dropdown-menu mobile" aria-labelledby="Dropdown">
                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-united-kingdom flag"></i>English <i class="fa fa-check text-success ms-2"></i></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-netherlands flag"></i>Nederlands</a>
                    </li>

                </ul>
            </div>
            <ul class="menu-list">
                <li><a href="#" class="active pt0">Home</a>
                </li>
                <li>
                    <a href="#">Properties</a>
                </li>
                <li>
                    <a href="#">About Us</a>
                </li>
                <li>
                    <a href="#"> Contact Us </a>
                </li>
                
                <li>
                    <a href="#full-page-search">
                        <i class="fa fa-search"></i> Search Property
                    </a>
                </li>
            </ul>
        </div>
        <div class="get-in-touch">
            <h3 class="heading">Get in Touch</h3>
            <div class="media">
                <i class="fa fa-phone"></i>
                <div class="media-body">
                    <a href="tel:06 82 746 368">06 82 746 368</a>
                </div>
            </div>
            <div class="media">
                <i class="fa fa-envelope"></i>
                <div class="media-body">
                    <a href="#">info@ryanrent.com</a>
                </div>
            </div>

        </div>
        <div class="get-social">
            <h3 class="heading">Get Social</h3>
            <a href="#" class="facebook-bg">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="#" class="twitter-bg">
                <i class="fa fa-twitter"></i>
            </a>
            <a href="#" class="instagram-bg">
                <i class="fa fa-instagram"></i>
            </a>
        </div>
    </div>
</nav>
<!-- Sidenav end -->

<!-- Sub banner start -->

<!-- Sub banner end -->

<!-- User page start -->
@yield('content')
<!-- User page end -->

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
<!-- Datatables -->
 <!-- End DataTables -->
<script src="{{ asset('front/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4omYJlOaP814WDcCG8eubXcbhB-44Uac"></script>
<script src="{{ asset('front/assets/js/ie-emulation-modes-warning.js') }}"></script>
<!-- Custom JS Script -->
<script  src="{{ asset('front/assets/js/app.js') }}"></script>
@yield('script')
</body>
</html>