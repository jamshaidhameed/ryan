@extends('layouts.front')
@section('title')
Properties List
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Properties List</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Properties</li>
            </ul>
        </div>
    </div>
</div>

<!-- Properties list fullwidth start -->
<div class="properties-list-fullwidth content-area-2">
    <div class="container">
        <div class="option-bar">
            <div class="row clearfix">
                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-5 col-3">
                    <h4>
                        <span class="heading-icon">
                            <i class="fa fa-caret-right icon-design"></i>
                            <i class="fa fa-th-large"></i>
                        </span>
                        <span class="heading">Properties</span>
                    </h4>
                </div>
                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7 col-9">
                    <!-- <div class="sorting-options clearfix">
                        <a href="properties-list-fullwidth.html" class="change-view-btn"><i class="fa fa-th-list"></i></a>
                        <a href="properties-grid-fullwidth.html" class="change-view-btn active-view-btn"><i class="fa fa-th-large"></i></a>
                    </div> -->
                    <form action="{{ route('advance.search') }}" method="post">
                        @csrf
                         <div class="search-area">
                            <select class="selectpicker search-fields" name="sortBy" onChange="this.form.submit()">
                                <option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceDesc') selected @endif>High to Low</option>
                                <option value= "priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceAsc') selected @endif>Low to High</option>
                            </select>
                    </div>
                    </form>
                   
                </div>
            </div>
        </div>
        <div class="subtitle">
            @if(count($properties) > 0)
             {{ count($properties)}} Result Found
            @else 
            No Property Found 
            @endif
        </div>
        <div class="row">
            @foreach($properties as $property)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="property-box-4">
                    <div class="thumbnail_inner">
                        <div class="thumbnail">
                            @php $image = !empty($property->property_image) ? explode(",",$property->property_image)[0] : ''; @endphp
                            <a href="{{ route('property.details',$property->slug) }}">
                                <img src="{{ !empty($image) ? asset('upload/property/'.$image) : '' }}" alt="property-box-4" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="content">
                        <div class="inner">
                            <div class="portfolio_heading">
                                <h4 class="title">
                                    <a href="{{ route('property.details',$property->slug) }}">{{ ucwords($property->title_en)}}</a>
                                </h4>
                                <div class="category_list">
                                    <a href="{{ route('property.details',$property->slug) }}">
                                        <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>{{ $property->street_address }}
                                    </a>
                                </div>
                            </div>
                            <div class="portfolio_hover">
                                <ul class="facilities-list clearfix">
                                    <li>
                                        <i class="flaticon-bed"></i> {{ $property->bedrooms}} Beds
                                    </li>
                                    <li>
                                        <i class="flaticon-bath"></i> {{ $property-> bathrooms}} Baths
                                    </li>
                                    <li>
                                        <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:{{ $property-> area}}
                                    </li>
                                    <li>
                                        <i class="flaticon-car-repair"></i> {{ $property->garages }} Garage
                                    </li>
<!-- 
                                    <li>
                                        <i class="flaticon-balcony-and-door"></i> 2 Balcony
                                    </li>
                                    <li>
                                        <i class="flaticon-monitor"></i> TV
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a class="transparent_link" href="{{ route('property.details',$property->slug) }}"></a>
                </div>
            </div>
            @endforeach
          <div class="col-lg-12">
            <div class="pagination-box text-center">
              <nav aria-label="Page navigation example">
                {{ $properties->appends($_GET)->links('vendor.pagination.custom')}}
               </nav>
            </div>
          </div>
        </div>
    </div>
</div>
<!-- Properties list fullwidth end -->
@endsection