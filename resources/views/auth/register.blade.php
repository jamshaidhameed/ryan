<!DOCTYPE html>
<html lang="zxx">
    <head>
        <title>Register your Self-{{ env('Business_title')}}</title>
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
        <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('front/assets/css/skins/default.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/global/vendor/formvalidation/formValidation.min599c.css?v4.0.2') }}">
    
    </head>
<body id="top" class="index-body">
<div class="page_loader"></div>

<!-- Contact section start -->
<div class="contact-section">
    <div class="container-fluid">
        <div class="row login-box">
            <div class="col-lg-6 align-self-center pad-0 form-section">
                <div class="form-inner">
                    <img src="{{ asset('front/assets/img/logo.png') }}" alt="logo" width="150">
                    <h3>{{ __('titles.register_account') }}</h3>
                    <p>{{ __('titles.get_your_free_account') }}</p>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item text-danger">
                                    {{ $error }}
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('register')}}" method="POST" class="form-horizontal" id="exampleConstraintsForm" autocomplete="off">
                        @csrf
                       
                         <div class="form-group">
                            
                            <input type="text" name="first_name" id="" class="input-text form-control" value="{{ old('first_name') }}" placeholder="{{ __('titles.first_name')}}" data-fv-notempty="true">
                         </div>
                         <div class="form-group">
                            
                            <input type="text" name="last_name" id="" class="input-text form-control" value="{{ old('last_name') }}" placeholder="{{ __('titles.last_name')}}">
                         </div>
                         <div class="form-group">
                            
                            <input type="email" name="email" id="" class="input-text form-control" value="{{ old('email') }}" placeholder="{{ __('titles.email')}}">
                         </div>
                         <div class="form-group">
                            <select name="user_type" id="" class="form-control input-text">
                                <option value="">{{ __('titles.i_am') }} </option>
                                <option value="landlord" <?php if($_REQUEST["flag"] == "landlord") echo "selected"; ?> @if(!empty(old('user_type')) && old('user_type') == 'landlord')selected @endif>{{ __('titles.landlord')}}</option>
                                <option value="tenant" <?php if($_REQUEST["flag"] == "tenant") echo "selected"; ?> @if(!empty(old('user_type')) && old('user_type') == 'tenant')selected @endif>{{ __('titles.tenant')}}</option>
                            </select>
                         </div>
                         <div class="form-group">
                            
                            <input type="password" name="password" id="" class="input-text form-control" value="{{ old('password') }}" placeholder="{{ __('titles.password')}}">
                         </div>
                         <div class="form-group">
                            
                            <input type="password" name="password_confirmation" id="" class="input-text form-control" value="{{ old('password_confirmation') }}" placeholder="{{ __('titles.confirm_password')}}">
                         </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-4 btn-block" style="background-color: #f26928;">{{ __('titles.register') }}</button>
                        </div>

                        <!-- <div class="extra-login form-group clearfix">
                            <span>Or Login With</span>
                        </div> -->
                        <div class="clearfix"></div>
                        <!-- <ul class="social-list clearfix">
                            <li><a href="#" class="facebook-bg">Facebook</a></li>
                            <li><a href="#" class="twitter-bg">Twitter</a></li>
                            <li><a href="#" class="google-bg">Google</a></li>
                        </ul> -->
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-lg-6 bg-color-15 pad-0 none-992 bg-img">
                <div class="info clearfix">
                    <h1>{{ __('titles.welcome_to')}} <a href="{{ route('home') }}">RyanRent</a></h1>
                    <p>{{ __('titles.welcome_to_desc')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact section end -->

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4omYJlOaP814WDcCG8eubXcbhB-44Uac"></script>
<script src="{{ asset('front/assets/js/ie-emulation-modes-warning.js') }}"></script>
<!-- Custom JS Script -->
<script  src="{{ asset('front/assets/js/app.js') }}"></script>
<script src="{{ asset('backend/global/vendor/formvalidation/formValidation.min599c.js?v4.0.2') }}"></script>
<script src="{{ asset('backend/global/vendor/formvalidation/framework/bootstrap4.min599c.js?v4.0.2') }}"></script>
<script src="{{ asset('backend/assets/examples/js/forms/validation.min599c.js?v4.0.2') }}"></script>
</body>
</html>