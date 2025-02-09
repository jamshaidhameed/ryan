
@extends('layouts.front')
@section('title')
  {{ __('titles.site')}}
@endsection
@section('content')
<!-- Banner start -->
<div class="banner" id="banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner banner-max-height">
            <div class="carousel-item active item-bg">
                <img class="d-block w-100" src="{{ asset('front/assets/img/banner/banner01.jpg') }}" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex text-center">
                    <div class="carousel-content container">
                        <div class="text-center">
                            <div id="typed-strings">
                                <p>{{ __('titles.find_your_amazing_home')}}</p>
                            </div>
                            <h1 class="typed-text">&nbsp;
                                <span id="typed"></span>
                            </h1>
                            <p class="text-p" data-animation="animated fadeInUp delay-10s">
                               {{ __('titles.find_your_dearm_home') }}
                            </p>
                            <a data-animation="animated fadeInUp delay-10s" href="#" class="btn-5">{{ __('titles.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search area start -->
    <div class="search-area d-none d-xl-block d-lg-block" id="search-area-4">
        <div class="container">
            <div class="search-area-inner">
                <div class="search-contents ">
                    <form action="{{ route('advance.search') }}" method="post">
                        @csrf
                         <div class="row">
                            <!-- <div class="col-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="area_from">
                                        <option value="">Area From</option>
                                        <option value="1500">1500</option>
                                        <option value="1200">1200</option>
                                        <option value="900">900</option>
                                        <option value="600">600</option>
                                        <option value="1300">300</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="postal_code">
                                        <option value="">@lang('titles.postal_code')</option>
                                        @php $postal_codes  = \App\Models\Properties::orderBy('postcode','asc')->select('postcode')->distinct()->get(); @endphp

                                        @foreach($postal_codes as $postcode)
                                          <option value="{{ $postcode->postcode}}">{{ $postcode->postcode}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="province">
                                        <option value="">@lang('titles.location')</option>
                                        @foreach(\App\Models\Provinces::all() as $province)
                                         <option value="{{ $province->id }}">{{ $province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="property_type">
                                        <option value="">@lang('titles.property_types')</option>
                                        @foreach(\App\Models\PropertyTypes::orderBy('name','asc')->get() as $type)
                                         <option value="{{ $type->id }}">{{ $type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="bedrooms">
                                        <option value="">@lang('titles.bedrooms')</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="bathrooms">
                                        <option value="">@lang('titles.bathrooms')</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="range-slider">
                                        <div data-min="0" data-max="15000" data-unit="€" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider" aria-disabled="false"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <button class="btn-4 btn btn-block" type="submit">@lang('titles.search')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Search area end -->
</div>
<!-- banner end -->

<!-- Search area start -->
<div class="search-area d-lg-none d-xl-none" id="search-area-1">
    <div class="container">
        <div class="search-area-inner">
            <div class="search-contents ">
                <form action="index.html" method="GET">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="brand">
                                    <option>Area From</option>
                                    <option>1500</option>
                                    <option>1200</option>
                                    <option>900</option>
                                    <option>600</option>
                                    <option>300</option>
                                    <option>100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="property-status">
                                    <option>Property Status</option>
                                    <option>For Sale</option>
                                    <option>For Rent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="location">
                                    <option>Location</option>
                                    <option>United Kingdom</option>
                                    <option>American Samoa</option>
                                    <option>Belgium</option>
                                    <option>Canada</option>
                                    <option>Delaware</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="category">
                                    <option>Property Types</option>
                                    <option>Residential</option>
                                    <option>Commercial</option>
                                    <option>Land</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="body">
                                    <option>Bedrooms</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="transmission">
                                    <option>Bathrooms</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="form-group">
                                <div class="range-slider">
                                    <div data-min="0" data-max="150000" data-unit="USD" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider" aria-disabled="false"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="form-group">
                                <button class="btn btn-block btn-4" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Search area start -->

<!-- Featured properties start -->
<div class="featured-properties content-area-19">
    <div class="container">
        <div class="main-title">
            <h1>{{ __('titles.featured_property') }}</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
        </div>
        @if(!empty($featured_property))
        <div class="col-lg-12">
            <div class="row property-box-6">
                <div class="col-lg-6 col-pad">
                    <div id="propertiesDetailsSlider" class="carousel properties-details-sliders slide">
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">
                                @php $count = 0; @endphp
                               @php $images = !empty($featured_property) ? explode(",", $featured_property->property_image) : array();
                               @endphp
                               
                               @if(count($images) > 0)
                                @foreach($images as $image)
                                    <div class="{{$count == 0 ? 'active ' : ''}}item carousel-item" data-slide-number="{{ $count}}">
                                        <img src="{{ asset('upload/property/'.$image) }}" class="img-fluid" alt="property-box-6">
                                    </div>
                                    @php $count += 1; @endphp
                                    @endforeach
                               @endif
                            <a class="carousel-control left" href="#propertiesDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                            <a class="carousel-control right" href="#propertiesDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-pad align-self-center">
                    <div class="info">
                        
                        <h3>
                            @if(!empty($featured_property))
                            <a href="{{ route('property.details',$featured_property->slug) }}">{{ $featured_property->title_en }}</a>
                            @endif
                        </h3>
                            @if(!empty($featured_property))
                                
                                <p>{{ $featured_property->description_en }} </p>

                            @endif
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <ul>
                                    <li><i class="flaticon-bed"></i> {{ $featured_property->bedrooms}} {{ __('titles.bedrooms') }}</li>
                                    <li><i class="flaticon-bath"></i> {{ $featured_property->bathrooms}} {{ __('titles.bathrooms') }}</li>
                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <ul>
                                    <li><i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:{{ $featured_property->area}}</li>
                                    <li><i class="flaticon-car-repair"></i> {{ $featured_property->garages}} {{ __('titles.garage') }}</li>
                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <ul>
                                    <li><i class="flaticon-balcony-and-door"></i>{{ $featured_property->parkings}} {{ __('titles.parking') }}</li>
                                </ul>
                            </div>
                        </div>
                        <a href="{{ !empty($featured_property) ? route('property.details',$featured_property->slug) : '' }}" class="btn btn-4">{{ __('titles.read_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Featured properties end -->

<!-- services 3 start -->
<div class="services-3 content-area-20 bg-white">
    <div class="container">
        <div class="main-title">
            <h1>{{ __('titles.what_are_you_looking_for')}}</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInLeft delay-04s">
                <div class="services-info-3 df-box">
                    <div class="icon">
                        <i class="flaticon-hotel-building"></i>
                    </div>
                    <div class="detail">
                        <h5>
                            <a href="#">{{ __('titles.apartment_clean') }}</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                        <a href="#" class="read-more">{{ __('titles.read_more.') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp delay-04s">
                <div class="services-info-3 df-box">
                    <div class="icon">
                        <i class="flaticon-house"></i>
                    </div>
                    <div class="detail">
                        <h5>
                            <a href="#">{{ __('titles.Houses') }}</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                        <a href="#" class="read-more">{{ __('titles.read_more.') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInDown delay-04s">
                <div class="services-info-3 df-box">
                    <div class="icon">
                        <i class="flaticon-call-center-agent"></i>
                    </div>
                    <div class="detail">
                        <h5>
                            <a href="#">{{ __('titles.support_24_7') }}</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                        <a href="#" class="read-more">{{ __('titles.read_more.') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInRight delay-04s">
                <div class="services-info-3 df-box">
                    <div class="icon">
                        <i class="flaticon-office-block"></i>
                    </div>
                    <div class="detail">
                        <h5>
                            <a href="#">{{ __('titles.Commercial') }}</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                        <a href="#" class="read-more">{{ __('titles.read_more.') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <a data-animation="animated fadeInUp delay-10s" href="#" class="btn-5">{{ __('titles.more_details') }}</a>
            </div>
        </div>
    </div>
</div>
<!-- services 3 end -->

<!-- Recent Properties start -->
<div class="recent-properties content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>{{ __('titles.recent_properties') }}</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
        </div>
        <div class="row">
            @foreach($latest_properties as $latest)
            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInLeft delay-04s">
                <div class="property-box-8">
                    <div class="photo-thumbnail">
                        <div class="photo">
                            @php $image = !empty($latest->property_image) ? explode(",",$latest->property_image)[0] : ''; @endphp
                            
                            <img src="{{ !empty($image) ? asset('upload/property/'.$image) : '' }}" alt="property-box-8" class="img-fluid">
                            <a href="{{ route('property.details',$latest->slug) }}">
                                <span class="blog-one__plus"></span>
                            </a>
                        </div>
                        <div class="tag-for">{{ __('titles.for_rent') }}</div>
                        <div class="price-ratings-box">
                            <p class="price">
                                &euro;{{ number_format($latest->price,2)}}
                            </p>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="detail">
                        <div class="heading">
                            <h3>
                                <a href="{{ route('property.details',$latest->slug) }}">{{ $latest->title_en }}</a>
                            </h3>
                            <div class="location">
                                <a href="{{ route('property.details',$latest->slug) }}">
                                    <i class="flaticon-facebook-placeholder-for-locate-places-on-maps">{{ $latest->street_address }}
                                    </i>
                                </a>
                            </div>
                        </div>
                        <div class="properties-listing">
                            <span>{{ $latest->bedrooms}} {{ __('titles.beds') }}</span>
                            <span>{{ $latest-> bathrooms}} {{ __('titles.baths') }}</span>
                            <span>{{ $latest->area }} {{ __('titles.sqft') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Recent Properties end -->



<!-- Testimonial start -->
{{-- <div class="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="testimonial-inner">
                    <div class="main-title">
                        <h1>Our Testimonial</h1>
                    </div>
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="avatar">
                                    <img src="{{ asset('front/assets/img/testi-1.jpg') }}" alt="avatar" class="img-fluid">
                                </div>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                                </p>
                                <h5><strong>Maria Blank</strong> Actor</h5>
                            </div>
                            <div class="carousel-item">
                                <div class="avatar">
                                    <img src="{{ asset('front/assets/img/testi-1.jpg') }}" alt="avatar" class="img-fluid">
                                </div>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                                </p>
                                <h5><strong>Karen Paran</strong> Businessman</h5>
                            </div>
                            <div class="carousel-item">
                                <div class="avatar">
                                    <img src="{{ asset('front/assets/img/testi-1.jpg') }}" alt="avatar" class="img-fluid">
                                </div>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                                </p>
                                <h5><strong>Brandon Miller</strong> IT Manager</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Testimonial end -->
@endsection