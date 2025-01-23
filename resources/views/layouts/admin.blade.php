<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<!-- Mirrored from getbootstrapadmin.com/remark/base/dashboard/ecommerce.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Sep 2019 06:12:26 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <link rel="apple-touch-icon" href="{{ asset('backend/assets/images/logo.png') }}">
  <!-- <link rel="shortcut icon" href="{{ asset('backend/assets/images/uoch.ico') }}"> -->
  <link rel="shortcut icon" href="{{ asset('front/assets/img/favicon.ico') }}" type="image/x-icon" >

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('backend/global/css/bootstrap.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/css/bootstrap-extend.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/site.min599c.css?v4.0.2') }}">

  <!-- Skin tools (demo site only) -->
  <!-- <link rel="stylesheet" href="{{ asset('backend/global/css/skintools.min599c.css?v4.0.2') }}">
  <script src="{{ asset('backend/assets/js/Plugin/skintools.min599c.js?v4.0.2') }}"></script> -->

  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/animsition/animsition.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/asscrollable/asScrollable.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/switchery/switchery.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/intro-js/introjs.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/slidepanel/slidePanel.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/flag-icon-css/flag-icon.min599c.css?v4.0.2') }}">

  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/chartist/chartist.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/aspieprogress/asPieProgress.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min599c.css?v4.0.2') }}">

  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('backend/assets/examples/css/dashboard/ecommerce.min599c.css?v4.0.2') }}">

  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('backend/global/fonts/web-icons/web-icons.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/fonts/brand-icons/brand-icons.min599c.css?v4.0.2') }}">
  <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

  <link rel="stylesheet" href="{{ asset('backend/global/fonts/font-awesome/font-awesome.min599c.css?v4.0.2')}}">
 <link rel="stylesheet" href="{{ asset('backend/global/vendor/formvalidation/formValidation.min599c.css?v4.0.2') }}">

 <!-- Data Table -->
 <link rel="stylesheet" href="{{ asset('backend/global/vendor/datatables.net-bs4/dataTables.bootstrap4.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.min599c.css?v4.0.2') }}">

  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('backend/assets/examples/css/tables/datatable.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('backend/global/vendor/select2/select2.min599c.css?v4.0.2') }}">
   <link rel="stylesheet" href="{{ asset('backend/global/vendor/bootstrap-datepicker/bootstrap-datepicker.min599c.css?v4.0.2') }}">
   <link rel="stylesheet" href="{{ asset('backend/assets/examples/css/forms/masks.min599c.css?v4.0.2') }}">
   <link rel="stylesheet" href="{{ asset('backend/global/vendor/dropify/dropify.min599c.css?v4.0.2') }} ">
   
   <link rel="stylesheet" href="{{ asset('backend/global/vendor/toastr/toastr.min599c.css?v4.0.2') }}">

  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('backend/assets/examples/css/advanced/toastr.min599c.css?v4.0.2') }}">
 <!-- End Datatable -->

  <link rel="stylesheet" href="{{ asset('backend/global/vendor/animsition/animsition.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ asset('admin/style/style.css')}}">
  <!-- Scripts -->
  <script src="{{ asset('backend/global/vendor/breakpoints/breakpoints.min599c.js?v4.0.2') }}"></script>

   <link rel="stylesheet" href="{{ asset('backend/global/vendor/bootstrap-sweetalert/sweetalert.min599c.css?v4.0.2') }}">

  @yield('style')
  <script>
    Breakpoints();
  </script>
</head>
<body class="animsition ecommerce_dashboard">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-expand-md"
    role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
        data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
        data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center" data-toggle="">
        <!-- <img class="navbar-brand-logo" src="{{ asset('backend/assets/images/logo.png') }}" title="Remark"> -->
        
        
        <a href="{{ route('admin.dashboard') }}"> <img class="navbar-brand-logo" src="{{ asset('backend/assets/images/logo.png') }}" alt=""> 
        </a> 
        
        
      </div>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
        data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="nav-item hidden-float">
            <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
              role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li>

        </ul>
        <!-- End Navbar Toolbar -->

        <!-- Navbar Toolbar Right -->

        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
                aria-expanded="false" role="button">
                <span class="flag-icon flag-icon-us"></span>
            </a>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-us"></span> English</a>
                <!-- <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-fr"></span> French</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-cn"></span> Chinese</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-de"></span> German</a> -->
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                <span class="flag-icon flag-icon-nl"></span> Dutch</a>
            </div>
            </li>
          <li class="nav-item dropdown">
            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
              data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="{{ asset('backend/assets/images/no_image.png') }}" alt="...">
                <i></i>
              </span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="{{  route('logout') }}" role="menuitem"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>                  
            </div>
          </li> 
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->

      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
  <div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <!--  -->

         
          <ul class="site-menu" data-plugin="menu">

             <!-- Basic Settings -->
           
            <!-- <li class="site-menu-category">Properties Management</li> -->
            <li class="site-menu-item has-sub {{ Route::currentRouteName() == 'admin.properties' || Route::currentRouteName() == 'admin.property.types.list' || Route::currentRouteName() == 'admin.property.types.create' || Route::currentRouteName() == 'admin.property.types.edit' || Route::currentRouteName() == 'admin.property.feature.list' || Route::currentRouteName() == 'admin.property.feature.create' || Route::currentRouteName() == 'admin.property.feature.edit' ? 'active open' : ''}}">
                <a href="javascript:void(0)">
                  <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                  <span class="site-menu-title">Properties</span>
                  <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub {{ Route::currentRouteName() == 'admin.properties' || Route::currentRouteName() == 'admin.property.types.list' || Route::currentRouteName() == 'admin.property.types.create' || Route::currentRouteName() == 'admin.property.types.edit' ? 'active open' : ''}}">
               
                <li class="site-menu-item {{ Route::currentRouteName() == 'admin.property.types.list' || Route::currentRouteName() == 'admin.property.types.create' || Route::currentRouteName() == 'admin.property.types.edit' ? 'active' : ''}}">
                  <a href="{{ route('admin.property.types.list') }}">
                    <span class="site-menu-title">Property Types</span>
                  </a>
                </li>
                <li class="site-menu-item {{ Route::currentRouteName() == 'admin.properties' ? 'active' : ''}}">
                  <a href="{{ route('admin.properties') }}">
                    <span class="site-menu-title">Properties List</span>
                  </a>
                </li>
                <!-- Property Features -->
                 <li class="site-menu-item has-sub {{ Route::currentRouteName() == 'admin.property.feature.list' || Route::currentRouteName() == 'admin.property.feature.create' || Route::currentRouteName() == 'admin.property.feature.edit' ? 'active open' : ''}}">
                <a href="javascript:void(0)">
                  <!-- <i class="site-menu-icon wb-users" aria-hidden="true"></i> -->
                   <i class="icon fa-braille" aria-hidden="true" style="font-size: 15px;margin-right:10px;"></i>
                  <span class="site-menu-title">Property Features</span>
                  <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub {{ Route::currentRouteName() == 'admin.property.feature.list' || Route::currentRouteName() == 'admin.property.feature.create' || Route::currentRouteName() == 'admin.property.feature.edit' ? 'active open' : ''}}">
               
                <li class="site-menu-item {{ Route::currentRouteName() == 'admin.property.feature.list'? 'active' : ''}}">
                  <a href="{{ route('admin.property.feature.list') }}">
                    <span class="site-menu-title">All Features</span>
                  </a>
                </li>
                <li class="site-menu-item {{ Route::currentRouteName() == 'admin.property.feature.create' ? 'active' : ''}}">
                  <a href="{{ route('admin.property.feature.create') }}">
                    <span class="site-menu-title">Add Feature</span>
                  </a>
                </li>
              </ul>
            </li>
                 <!-- End Property Features -->
              </ul>
            </li>
            <!-- Province Menu Start -->
              <!-- <li class="site-menu-category">Province Management</li> -->
             <li class="site-menu-item has-sub {{ Route::currentRouteName() == 'admin.province.list' || Route::currentRouteName() == 'admin.province.create' || Route::currentRouteName() == 'admin.province.edit' ? 'active open' : ''}}">
                <a href="javascript:void(0)">
                  <!-- <i class="site-menu-icon wb-users" aria-hidden="true"></i> -->
                   <i class="icon fa-braille" aria-hidden="true" style="font-size: 15px;margin-right:10px;"></i>
                  <span class="site-menu-title">Provinces</span>
                  <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub {{ Route::currentRouteName() == 'admin.province.list' || Route::currentRouteName() == 'admin.province.create' || Route::currentRouteName() == 'admin.province.edit' ? 'active open' : ''}}">
               
                <li class="site-menu-item {{ Route::currentRouteName() == 'admin.province.list'? 'active' : ''}}">
                  <a href="{{ route('admin.province.list') }}">
                    <span class="site-menu-title">Province List</span>
                  </a>
                </li>
                <li class="site-menu-item {{ Route::currentRouteName() == 'admin.province.create' ? 'active' : ''}}">
                  <a href="{{ route('admin.province.create') }}">
                    <span class="site-menu-title">Add Province</span>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Landlord and Tenants -->
             <!-- <li class="site-menu-category">Landlords</li> -->
             <li class="site-menu-item {{ Route::currentRouteName() == 'admin.landlord.list' ? 'active' : ''}}">
                <a href="{{ route('admin.landlord.list') }}">
                  <!-- <i class="site-menu-icon wb-users" aria-hidden="true"></i> -->
                   <i class="icon fa-address-book-o" aria-hidden="true" style="font-size: 15px;margin-right:10px;"></i>
                  <span class="site-menu-title">Landlords</span>
                 
              </a>
            </li>
             <!-- Tenants -->
             <!-- <li class="site-menu-category">Tenants</li> -->
             <li class="site-menu-item {{ Route::currentRouteName() == 'admin.tenant.list' ? 'active' : ''}}">
                <a href="{{ route('admin.tenant.list') }}">
                  <!-- <i class="site-menu-icon wb-users" aria-hidden="true"></i> -->
                   <i class="icon fa-address-card" aria-hidden="true" style="font-size: 15px;margin-right:10px;"></i>
                  <span class="site-menu-title">Tenants</span>
                 
              </a>
            </li>

             <li class="site-menu-item {{ Route::currentRouteName() == 'admin.rented.properties' ? 'active' : ''}}">
                <a href="{{ route('admin.rented.properties') }}">
                  <!-- <i class="site-menu-icon wb-users" aria-hidden="true"></i> -->
                   <i class="icon wb-home" aria-hidden="true" style="font-size: 15px;margin-right:10px;"></i>
                  <span class="site-menu-title">Rented Properties</span>
                 
              </a>
            </li>
            <!-- Admin List -->
             <li class="site-menu-item {{ Route::currentRouteName() == 'admin.user.list' || Route::currentRouteName() == 'admin.user.create' || Route::currentRouteName() == 'admin.user.edit' ? 'active' : ''}}">
                <a href="{{ route('admin.user.list') }}">
                  <!-- <i class="site-menu-icon wb-users" aria-hidden="true"></i> -->
                   <i class="icon fa-user-secret" aria-hidden="true" style="font-size: 15px;margin-right:10px;"></i>
                  <span class="site-menu-title">Admin User List</span>
                 
              </a>
            </li>
             <li class="site-menu-item   {{ Route::currentRouteName() == 'admin.cms.pages.list' || Route::currentRouteName() == 'admin.cms.pages.create' || Route::currentRouteName() == 'admin.cms.pages.edit' ? 'active' : ''}}">
                <a href="{{ route('admin.cms.pages.list') }}">
                  <!-- <i class="site-menu-icon wb-users" aria-hidden="true"></i> -->
                   <i class="icon fa-user-secret" aria-hidden="true" style="font-size: 15px;margin-right:10px;"></i>
                  <span class="site-menu-title">CMS Pages</span>
                 
              </a>
            </li>
             <!-- End Admin List -->
          </ul>
          <!--  -->
        </div>
      </div>
    </div>
  </div>
  <div class="site-gridmenu">
    <div>
      <div>
        <ul>
          <li>
            <a href="../apps/mailbox/mailbox.html">
                <i class="icon wb-envelope"></i>
                <span>Mailbox</span>
              </a>
          </li>
          <li>
            <a href="../apps/calendar/calendar.html">
                <i class="icon wb-calendar"></i>
                <span>Calendar</span>
              </a>
          </li>
          <li>
            <a href="../apps/contacts/contacts.html">
                <i class="icon wb-user"></i>
                <span>Contacts</span>
              </a>
          </li>
          <li>
            <a href="../apps/media/overview.html">
                <i class="icon wb-camera"></i>
                <span>Media</span>
              </a>
          </li>
          <li>
            <a href="../apps/documents/categories.html">
                <i class="icon wb-order"></i>
                <span>Documents</span>
              </a>
          </li>
          <li>
            <a href="../apps/projects/projects.html">
                <i class="icon wb-image"></i>
                <span>Project</span>
              </a>
          </li>
          <li>
            <a href="../apps/forum/forum.html">
                <i class="icon wb-chat-group"></i>
                <span>Forum</span>
              </a>
          </li>
          <li>
            <a href="../index.html">
                <i class="icon wb-dashboard"></i>
                <span>Dashboard</span>
              </a>
          </li>
        </ul>
      </div>
    </div>
  </div>


  @yield('content')


  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© {{ date('Y') }} <a target="_blank" href="#"></a>Copy Rights are reserved to {{ ucfirst(env('business_title'))}}</div>
  </footer>
  <!-- Core  -->
  <script src="{{ asset('backend/global/vendor/babel-external-helpers/babel-external-helpers599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/jquery/jquery.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/popper-js/umd/popper.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/bootstrap/bootstrap.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/animsition/animsition.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/mousewheel/jquery.mousewheel599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/asscrollbar/jquery-asScrollbar.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/asscrollable/jquery-asScrollable.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/ashoverscroll/jquery-asHoverScroll.min599c.js?v4.0.2') }}"></script>

  <!-- Plugins -->
  <script src="{{ asset('backend/global/vendor/switchery/switchery.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/intro-js/intro.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/screenfull/screenfull599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/slidepanel/jquery-slidePanel.min599c.js?v4.0.2') }}"></script>

  <!-- Plugins For This Page -->
  <script src="{{ asset('backend/global/vendor/chartist/chartist.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/aspieprogress/jquery-asPieProgress.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min599c.js?v4.0.2') }}"></script>

  <!-- Scripts -->
  <script src="{{ asset('backend/global/js/Component.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Plugin.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Base.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Config.min599c.js?v4.0.2') }}"></script>

  <script src="{{ asset('backend/assets/js/Section/Menubar.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/assets/js/Section/GridMenu.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/assets/js/Section/Sidebar.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/assets/js/Section/PageAside.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/assets/js/Plugin/menu.min599c.js?v4.0.2') }}"></script>

  <!-- Config -->
  <script src="{{ asset('backend/global/js/config/colors.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/assets/js/config/tour.min599c.js?v4.0.2') }}"></script>
  <script>
    Config.set('assets', '../assets');
  </script>

  <!-- Page -->
  <script src="{{ asset('backend/assets/js/Site.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Plugin/asscrollable.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Plugin/slidepanel.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Plugin/switchery.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Plugin/aspieprogress.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/assets/examples/js/dashboard/ecommerce.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/formvalidation/formValidation.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/formvalidation/framework/bootstrap4.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/assets/examples/js/forms/validation.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/select2/select2.full.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Plugin/select2.min599c.js?v4.0.2') }}"></script>
  <!-- Datatable Plugim -->
  <script src="{{ asset('backend/global/vendor/datatables.net/jquery.dataTables599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-bs4/dataTables.bootstrap4599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-rowgroup/dataTables.rowGroup.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-scroller/dataTables.scroller.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-responsive/dataTables.responsive.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-buttons/dataTables.buttons.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-buttons/buttons.html5.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-buttons/buttons.flash.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-buttons/buttons.print.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-buttons/buttons.colVis.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/asrange/jquery-asRange.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/bootbox/bootbox.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/js/Plugin/datatables.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/assets/examples/js/tables/datatable.min599c.js?v4.0.2') }}"></script>
   <script src="{{ asset('backend/global/vendor/formatter/jquery.formatter.min599c.js?v4.0.2') }}"></script>
   <script src="{{ asset('backend/global/js/Plugin/formatter.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/dropify/dropify.min599c.js?v4.0.2') }}"></script>
  <script src="{{ asset('backend/global/vendor/toastr/toastr.min599c.js?v4.0.2') }}"></script>
   <script src="{{ asset('backend/global//vendor/bootstrap-sweetalert/sweetalert.min599c.js?v4.0.2') }} "></script>
  @yield('script')
  <!-- Google Analytics -->
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../../../www.google-analytics.com/analytics.js',
      'ga');

    ga('create', 'UA-65522665-1', 'auto');
    ga('send', 'pageview');
  </script>
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/base/dashboard/ecommerce.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Sep 2019 06:12:29 GMT -->
</html>
