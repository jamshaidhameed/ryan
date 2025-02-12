
<!-- Top header start -->
<header class="top-header top-header-bg" id="top-header-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <div class="list-inline">
                    <a href="tel:06 82 746 368"><i class="fa fa-phone"></i>06 82 746 368</a>
                    <a href="tel:info@ryanrent.com"><i class="fa fa-envelope"></i>info@ryanrent.com</a>
                    <div class="dropdown d-inline">
                        <a data-mdb-dropdown-init class="dropdown-toggle pb-3" href="#" id="Dropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">

                           @if(\Illuminate\Support\Facades\App::isLocale('en'))
                            <i class="flag-united-kingdom flag m-0"></i>
                           @else 
                            <i class="flag-netherlands flag"></i>
                           @endif
                        </a>
                    
                        <ul class="dropdown-menu" aria-labelledby="Dropdown">
                            <li>
                                <a class="dropdown-item" href="{{ url('greeting/en')}}"><i class="flag-united-kingdom flag"></i>English 
                                @if(\Illuminate\Support\Facades\App::isLocale('en'))
                                <i class="fa fa-check text-success ms-2"></i>
                                @endif
                            </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('greeting/nl')}}"><i class="flag-netherlands flag"></i>Nederlands
                             @if(\Illuminate\Support\Facades\App::isLocale('nl'))
                                <i class="fa fa-check text-success ms-2"></i>
                                @endif
                            </a>
                            </li>
        
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-5 col-md-5">
                <ul class="top-social-media pull-right">
                    
                    @if(empty(Auth::user()->first_name))
                    <li>
                        <a href="{{ route('login')}}" class="sign-in"><i class="fa fa-sign-in" style="margin-right:10px;"></i>{{ __('titles.login') }} </a>
                    </li>
                    <!-- <li>
                        <a href="{{ route('register') }}" class="sign-in"><i class="fa fa-user" style="margin-right:10px;"></i> {{ __('titles.register') }}</a>
                    </li>-->


                    <div class="dropdown d-inline mx-3">
                        <a data-mdb-dropdown-init class="dropdown-toggle pb-3" href="#" id="Dropdown2" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i> Register</a></a>
                    
                        <ul class="dropdown-menu register" aria-labelledby="Dropdown2">
                            <li>
                                <a class="dropdown-item" href="{{ route('register', ['flag' => 'landlord']) }}"><i class="fa fa-user mx-2"></i> {{ __('titles.landlord')}}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('register', ['flag' => 'tenant']) }}"><i class="fa fa-user mx-2"></i> {{ __('titles.tenant')}}</a>
                            </li>
        
                        </ul>
                    </div>
                    @else 
                        @php 
                        
                        $route = '' ;
                        if(Auth::user()->role != 'inspector' && Auth::user()->role != 'plumber') {
                             
                            $route = route(Auth::user()->role.".dashboard"); 
                        }else{

                            $route = route("technision.dashboard"); 
                        }
                        
                        
                        @endphp
                     <li>
                        <a href="{{ $route }}" class="sign-in"><i class="fa fa-dashboard" style="margin-right: 6px;"></i>@lang('titles.dashboard') </a>
                     </li>

                     <li>
                        <a class="ign-in" href="{{  route('logout') }}" role="menuitem"onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="fa fa-logout" style="margin-right:10px;"></i>
                        @lang('titles.logout')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> 
                     </li>
                    @endif
                    <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                    

                </ul>
                
            </div>
        </div>
    </div>
</header>
<!-- Top header end -->

<!-- main header start -->
<header class="main-header do-sticky" id="main-header-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light rounded">
                    <a class="navbar-brand logo-2" href="{{ route('home') }}">
                        <img src="{{ asset('front/assets/img/logo.png') }}" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" id="drawer">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="navbar-collapse collapse w-100" id="navbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown {{ Route::currentRouteName() == 'home' ? 'active' : ''}}">
                                <a class="nav-link dropdown-toggle" href="{{ route('home')}}" >
                                    @lang('titles.home')
                                </a>
                                
                            </li>
                            <li class="nav-item dropdown {{ Route::currentRouteName() == 'properties.list' ? 'active' : ''}}">
                                <a class="nav-link dropdown-toggle" href="{{ route('properties.list') }}">
                                    @lang('titles.properties')
                                </a>
                                
                            </li>
                            <li class="nav-item dropdown {{ Route::currentRouteName() == 'contact.us' ? 'active' : ''}}">
                                <a class="nav-link dropdown-toggle" href="{{ route('contact.us') }}">
                                    @lang('titles.contactus')
                                </a>

                            </li>
                            @foreach(\App\Models\cms::where('show_on','header')->get() as $page)
                            
                            <li class="nav-item dropdown {{ Route::currentRouteName() == route('cms.page',$page->slug) ? 'active' : ''}}">
                                <a class="nav-link dropdown-toggle" href="{{ route('cms.page',$page->slug) }}" >
                                    {{ ucwords($page->title)}}
                                </a>
                            </li>
                            @endforeach

                            <li class="nav-item dropdown">
                                <a href="#full-page-search" class="nav-link">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>