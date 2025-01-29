@extends('layouts.front')
@section('title')
 {{ $property_info->title_en }}
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ $property_info->title_en}}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Properties</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->
 <!-- Properties details page start -->
<div class="properties-details-page content-area-15">
    <div class="container">
        @if(session()->has('success'))
        <div class="alert alert-success mt-6">
            {{ session()->get('success')}}
        </div>
        @endif
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12 slider">
                <div id="propertiesDetailsSlider" class="carousel properties-details-sliders slide mb-30">
                    <div class="heading-properties">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <h3>{{ $property_info->title_en }}</h3>
                                    <p><i class="fa fa-map-marker"></i> {{ $property_info->street_address }}</p>
                                </div>
                                <div class="p-r">
                                    <h3>&euro;{{ number_format($property_info->price,2)}}</h3>
                                    <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- main slider carousel items -->
                    <div class="carousel-inner">
                        @php $images = !empty($property_info->property_image) ? explode(",",$property_info->property_image) : array(); 
                             $featured_images =  !empty($property_info->feature_image) ? explode(",",$property_info->feature_image) : array(); 
                        @endphp
                         @foreach($featured_images as $img)
                        <div class="{{ $loop->iteration == 1 ? 'active' : ''}} item carousel-item" data-slide-number="{{ $loop->iteration }}">
                            <img src="{{ asset('upload/property/feature/'.$img)}}" class="img-fluid" alt="{{ $property_info->title_en}}">
                        </div>
                        @endforeach
                        @foreach($images as $img)
                        <div class="item carousel-item" data-slide-number="{{ $loop->iteration }}">
                            <img src="{{ asset('upload/property/'.$img)}}" class="img-fluid" alt="{{ $property_info->title_en}}">
                        </div>
                        @endforeach
                        @foreach($featured_images as $img)
                        <div class="item carousel-item" data-slide-number="{{ $loop->iteration }}">
                            <img src="{{ asset('upload/property/feature/'.$img)}}" class="img-fluid" alt="{{ $property_info->title_en}}">
                        </div>
                        @endforeach
                        <a class="carousel-control left" href="#propertiesDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                        <a class="carousel-control right" href="#propertiesDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <!-- main slider carousel nav controls -->
                    <ul class="carousel-indicators smail-properties list-inline nav nav-justified">
                       @foreach($images as $img) 
                     <li class="list-inline-item {{ $loop->iteration == 1 ? 'active' : ''}}">
                            <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#propertiesDetailsSlider">
                                <img src="{{ asset('upload/property/'.$img) }}" class="img-fluid" alt="{{ $property_info->title_en}}">
                            </a>
                     </li>
                     @endforeach
                     @foreach($featured_images as $img) 
                     <li class="list-inline-item">
                            <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#propertiesDetailsSlider">
                                <img src="{{ asset('upload/property/feature/'.$img) }}" class="img-fluid" alt="{{ $property_info->title_en}}">
                            </a>
                     </li>
                     @endforeach

                    </ul>
                </div>
                <!-- Search area start -->
                <div class="widget-2 search-area advanced-search as-2">
                    <h5 class="sidebar-title">Advanced Search</h5>
                   
                </div>
                <!-- Tabbing box start -->
                <div class="tabbing tabbing-box mb-60">
                    <ul class="nav nav-tabs" id="carTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="one" aria-selected="false">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="false">Floor Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="three" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="4-tab" data-toggle="tab" href="#4" role="tab" aria-controls="4" aria-selected="true">Video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="5-tab" data-toggle="tab" href="#5" role="tab" aria-controls="5" aria-selected="true">Location</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="6-tab" data-toggle="tab" href="#6" role="tab" aria-controls="6" aria-selected="true">Related Properties</a>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="carTabContent">
                        <div class="tab-pane fade active show" id="one" role="tabpanel" aria-labelledby="one-tab">
                            <h3 class="heading-3">{{ __('Property Description')}}</h3>
                           {!! html_entity_decode($property_info->description_en) !!}
                        </div>
                        <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
                            <div class="floor-plans mb-60">
                                <h3 class="heading-3">Floor Plans</h3>
                                <table>
                                    <tbody><tr>
                                        <td><strong>Size</strong></td>
                                        <td><strong>Rooms</strong></td>
                                        <td><strong>Bathrooms</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{ $property_info->area}}</td>
                                        <td>{{ $property_info->bedrooms}}</td>
                                        <td>{{ $property_info->bathrooms}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade " id="three" role="tabpanel" aria-labelledby="three-tab">
                            <div class="property-details">
                                <h3 class="heading-3">Property Details</h3>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <li>
                                                <strong>Property Id:</strong>{{ $property_info->id }}
                                            </li>
                                            <li>
                                                <strong>Price:</strong>&euro;{{ number_format($property_info->price,2)}}/ Month
                                            </li>
                                            <li>
                                                <strong>Property Type:</strong>{{ !empty($property_info->type->name) ? $property_info->type->name : ""}}
                                            </li>
                                            <li>
                                                <strong>Bathrooms:</strong>{{ $property_info->bathrooms}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <!-- <li>
                                                <strong>Property Lot Size:</strong>ft2
                                            </li> -->
                                            <li>
                                                <strong>Land area:</strong>{{ $property_info->area }} ft2
                                            </li>
                                            <li>
                                                <strong>Year Built:</strong>{{ date_format(date_create($property_info->created_at),'Y') }}
                                            </li>
                                            <li>
                                                <strong>Available From:</strong>{{ date_format(date_create($property_info->available_from),'Y')}}
                                            </li>
                                            <li>
                                                <strong>Garages:</strong>{{ $property_info->garages}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <li>
                                                <strong>Sold:</strong>Yes
                                            </li>
                                            <li>
                                                <strong>City:</strong>{{ $property_info->city }}
                                            </li>
                                            <li>
                                                <strong>Parking:</strong>{{ $property_info->parking != 0 ? 'Yes' : 'No'}}
                                            </li>
                                            <li>
                                                <strong>Property Owner:</strong>{{ !empty($property_info->landlord->first_name) ? $property_info->landlord->first_name.' '.$property_info->landlord->last_name : '' }}
                                            </li>
                                            <li>
                                                <strong>Zip Code: </strong>2451
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="4" role="tabpanel" aria-labelledby="4-tab">
                            <div class="property-video">
                                <h3 class="heading-3">Property Vedio</h3>
                                <iframe src="{{ $property_info->youtube_url}}" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="5" role="tabpanel" aria-labelledby="5-tab">
                            <div class="section location">
                                <h3 class="heading-3">Property Location</h3>
                                <div class="map">
                                    <div id="contactMap" class="contact-map"></div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade " id="6" role="tabpanel" aria-labelledby="6-tab">
                            <div class="related-properties">
                                <h3 class="heading-3">Related Properties</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="property-box">
                                            <div class="property-thumbnail">
                                                <a href="properties-details.html" class="property-img">
                                                    <div class="listing-badges">
                                                        <span class="featured">Featured</span>
                                                    </div>
                                                    <div class="tag-for">For Sale</div>
                                                    <div class="plan-price"><sup>&euro;</sup>650<span>/month</span> </div>
                                                    <img src="assets/img/property/img-7.jpg" alt="property-box" class="img-fluid">
                                                </a>
                                                <div class="property-overlay">
                                                    <a href="properties-details.html" class="overlay-link">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                    <a class="overlay-link property-video" title="Test Title">
                                                        <i class="fa fa-video-camera"></i>
                                                    </a>
                                                    <div class="property-magnify-gallery">
                                                        <a href="assets/img/property/img-7.jpg" class="overlay-link">
                                                            <i class="fa fa-expand"></i>
                                                        </a>
                                                        <a href="assets/img/property/img-8.jpg" class="hidden"></a>
                                                        <a href="assets/img/property/img-9.jpg" class="hidden"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <h1 class="title">
                                                    <a href="properties-details.html">Real Luxury Villa</a>
                                                </h1>
                                                <div class="location">
                                                    <a href="properties-details.html">
                                                        <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>123 Kathal St. Tampa City,
                                                    </a>
                                                </div>
                                                <ul class="facilities-list clearfix">
                                                    <li>
                                                        <i class="flaticon-bed"></i> 3 Bedrooms
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-bath"></i> 2 Bathrooms
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-car-repair"></i> 1 Garage
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="footer">
                                                <a href="#">
                                                    <i class="fa fa-user"></i> Jhon Doe
                                                </a>
                                                <span>
                                                     <i class="fa fa-calendar-o"></i> 2 years ago
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="property-box">
                                            <div class="property-thumbnail">
                                                <a href="properties-details.html" class="property-img">
                                                    <div class="listing-badges">
                                                        <span class="featured">Featured</span>
                                                    </div>
                                                    <div class="tag-for">For Sale</div>
                                                    <div class="plan-price"><sup>&euro;</sup>650<span>/month</span> </div>
                                                    <img src="assets/img/property/img-9.jpg" alt="property-box" class="img-fluid">
                                                </a>
                                                <div class="property-overlay">
                                                    <a href="properties-details.html" class="overlay-link">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                    <a class="overlay-link property-video" title="Test Title">
                                                        <i class="fa fa-video-camera"></i>
                                                    </a>
                                                    <div class="property-magnify-gallery">
                                                        <a href="assets/img/property/img-7.jpg" class="overlay-link">
                                                            <i class="fa fa-expand"></i>
                                                        </a>
                                                        <a href="assets/img/property/img-8.jpg" class="hidden"></a>
                                                        <a href="assets/img/property/img-9.jpg" class="hidden"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <h1 class="title">
                                                    <a href="properties-details.html">Masons Villas</a>
                                                </h1>
                                                <div class="location">
                                                    <a href="properties-details.html">
                                                        <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>123 Kathal St. Tampa City,
                                                    </a>
                                                </div>
                                                <ul class="facilities-list clearfix">
                                                    <li>
                                                        <i class="flaticon-bed"></i> 3 Bedrooms
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-bath"></i> 2 Bathrooms
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-car-repair"></i> 1 Garage
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="footer">
                                                <a href="#">
                                                    <i class="fa fa-user"></i> Jhon Doe
                                                </a>
                                                <span>
                                                    <i class="fa fa-calendar-o"></i> 2 years ago
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- Amenities box start -->
                <div class="amenities-box mb-45">
                    <h3 class="heading-3">Condition</h3>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li><span><i class="flaticon-bed"></i> {{ $property_info->bedrooms}} Beds</span></li>
                                <li><span><i class="flaticon-bath"></i> {{ $property_info->bathrooms}} Bathroom</span></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li><span><i class="flaticon-car-repair"></i> {{ $property_info->garages }} Garage</span></li>
                                <li><span><i class="flaticon-balcony-and-door"></i> Balcony</span></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li><span><i class="flaticon-square-layouting-with-black-square-in-east-area"></i> {{ $property_info->area }} sq ft</span></li>
                                <li><span><i class="flaticon-monitor"></i> TV</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Features opions start -->
                <div class="features-opions mb-45">
                    <h3 class="heading-3">Features</h3>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li>
                                    <i class="flaticon-air-conditioner"></i>
                                    Air conditioning
                                </li>
                                <li>
                                    <i class="flaticon-wifi-connection-signal-symbol"></i>
                                    Wifi
                                </li>
                                <li>
                                    <i class="flaticon-swimmer"></i>
                                    Swimming Pool
                                </li>
                                <li>
                                    <i class="flaticon-bed"></i>
                                    Double Bed
                                </li>
                                <li>
                                    <i class="flaticon-balcony-and-door"></i>
                                    Balcony
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li>
                                    <i class="flaticon-old-typical-phone"></i>
                                    Telephone
                                </li>
                                <li>
                                    <i class="flaticon-car-repair"></i>
                                    Garage
                                </li>
                                <li>
                                    <i class="flaticon-parking"></i>
                                    Parking
                                </li>
                                <li>
                                    <i class="flaticon-monitor"></i>
                                    TV
                                </li>
                                <li>
                                    <i class="flaticon-theatre-masks"></i>
                                    Home Theater
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                    Alarm
                                </li>
                                <li>
                                    <i class="flaticon-padlock"></i>
                                    Security
                                </li>
                                <li>
                                    <i class="flaticon-weightlifting"></i>
                                    Gym
                                </li>
                                <li>
                                    <i class="flaticon-idea"></i>
                                    Electric Range
                                </li>
                                <li>
                                    <i class="flaticon-green-park-city-space"></i>
                                    Private space
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Comments section start -->
                <!-- <div class="comments-section mb-60">
                    <h3 class="heading-3">Comments Section</h3>
                    <ul class="comments">
                        <li>
                            <div class="comment">
                                <div class="comment-author">
                                    <a href="#">
                                        <img src="assets/img/avatar.jpg" alt="avatar-13">
                                    </a>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <div class="comment-meta-author">
                                            Brandon Miller
                                        </div>
                                        <div class="comment-meta-reply">
                                            <a href="#">Reply</a>
                                        </div>
                                        <div class="comment-meta-date">
                                            <cite>8:42 PM 10/3/2020</cite>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla.</p>
                                    </div>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <div class="comment">
                                        <div class="comment-author">
                                            <a href="#">
                                                <img src="assets/img/avatar.jpg" alt="avatar-13">
                                            </a>
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-meta">
                                                <div class="comment-meta-author">
                                                    Antony John
                                                </div>

                                                <div class="comment-meta-reply">
                                                    <a href="#">Reply</a>
                                                </div>

                                                <div class="comment-meta-date">
                                                    <span>8:42 PM 10/3/2020</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="comment-body">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="comment">
                                <div class="comment-author">
                                    <a href="#">
                                        <img src="assets/img/avatar.jpg" alt="avatar-13">
                                    </a>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <div class="comment-meta-author">
                                            Jane Doe
                                        </div>
                                        <div class="comment-meta-reply">
                                            <a href="#">Reply</a>
                                        </div>
                                        <div class="comment-meta-date">
                                            <span>8:42 PM 10/3/2020</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> -->
                <!-- Contact 3 start -->
                <!-- <div class="contact-3">
                    <h3 class="heading-3">Leave a Comment</h3>
                    <div class="container">
                        <div class="row">
                            <form action="#" method="GET" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group name">
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group email">
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group subject">
                                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group number">
                                            <input type="text" name="phone" class="form-control" placeholder="Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group message">
                                            <textarea class="form-control" name="message" placeholder="Write message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="send-btn mb-50">
                                            <button type="submit" class="btn btn-4">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar mbl">
                    <!-- Search area start -->
                    <div class="widget search-area advanced-search as">
                        <h5 class="sidebar-title">{{ __('Additional Features') }}</h5>
                        @php $featreus = !empty($property_info->features) ? explode(",",$property_info->features) : array(); @endphp

                        <table>
                            <tbody>
                                @foreach($featreus as $feat)
                                 <tr>
                                    <td>
                                    <img src="{{ asset('select.jpeg') }}" alt="">
                                    </td>
                                    <td>
                                    @php $feature = \App\Models\PropertyFeatures::where(['id' => $feat,'status' => 1])->first(); @endphp
                                    
                                        @if(!empty($feature))
                                        {{ $feature->title}}
                                        @endif
                                    
                                    </td>
                               </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="widget search-area advanced-search as">
                        <h5>{{ __('Booking Form') }}</h5>
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
                        <form action="{{ route('property.book') }}" method="post">
                            @csrf 
                            <input type="hidden" name="property_id" value="{{ $property_info->id }}">
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ __('First Name') }}</label>
                                <input type="text" class="form-control" name="first_name" value="{{ !empty(Auth::user()->first_name) && Auth::user()->role == 'tenant' ? Auth::user()->first_name : old('first_name') }}" placeholder="{{ __('Enter Your First Name') }}">
                            </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control" name="last_name" value="{{ !empty(Auth::user()->first_name) && Auth::user()->role == 'tenant' ? Auth::user()->last_name : old('last_name') }}" placeholder="{{ __('Enter Your Last Name') }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control" name="email" value="{{ !empty(Auth::user()->email) && Auth::user()->role == 'tenant' ? Auth::user()->email : old('email') }}" placeholder="{{ __('Enter Your Email Address') }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Telephone Number') }}</label>
                                <input type="text" class="form-control" name="phone" value="{{ !empty(Auth::user()->phone) && Auth::user()->role == 'tenant' ? Auth::user()->phone : old('phone')}}" placeholder="{{ __('Enter Your Telephone Number') }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Enquiry Message') }}</label>
                                <textarea name="message" id="" class="form-control">
                                    {{ old('message') }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">{{ __('I am Interested') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- Categories start -->
                    <div class="widget categories">
                        <h5 class="sidebar-title">Property Types</h5>
                        <ul>
                            @php $types = \App\Models\PropertyTypes::orderBy('name','asc')->where('status',1)->with('properties')->get();
                            @endphp

                            @foreach($types as $type)

                             @php 
                              $type_url = "&type=".$type->id;
                              $property_url = route('properties.list',$type_url);
                             @endphp
                            <li><a href="{{ $property_url }}">{{$type->name}}<span>({{ count($type->properties) }})</span></a></li>
                            @endforeach
                            
                            
                        </ul>
                    </div>
                    <!-- Recent posts start -->
                    <div class="widget recent-posts">
                        <h5 class="sidebar-title">Recent Properties</h5>
                        @php $recent_properties = \App\Models\Properties::orderBy('id','desc')->where('status',1)->limit(3)->get(); @endphp
                        @foreach($recent_properties as $property)
                        <div class="media mb-4">
                            <a href="{{ route('property.details',$property->slug) }}">
                                @php $image = !empty($property->property_image) ? explode(",",$property->property_image)[0] : '';@endphp 
                                <img src="{{ asset('upload/property/'.$image) }}" alt="sub-property">
                            </a>
                            <div class="media-body align-self-center">
                                <h5>
                                    <a href="{{ route('property.details',$property->slug) }}">{{ $property->title_en}}</a>
                                </h5>
                               <p>{{ date_format(date_create($property->created_at),'M d, Y ') }} | &euro;{{ number_format($property->price,2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Social list start -->
                    <div class="social-list widget clearfix">
                        <h5 class="sidebar-title">Follow Us</h5>
                        <ul>
                            <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="rss-bg"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <!-- Helping center start -->
                    <div class="helping-center clearfix">
                        <div class="media">
                            <i class="fa fa-mobile"></i>
                            <div class="media-body  align-self-center">
                                <h5 class="mt-0">Helping Center</h5>
                                <h4><a href="tel:+0477-85x6-552">+01 7X0 555 8X22</a></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Financing calculator  start -->
                    <!-- <div class="contact-3 financing-calculator widget-3">
                        <h5 class="sidebar-title">Mortgage Calculator</h5>
                        <form action="#" method="GET" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-label">Property Price</label>
                                <input type="text" class="form-control" placeholder="&euro;36.400">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Interest Rate (%)</label>
                                <input type="text" class="form-control" placeholder="10%">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Period In Months</label>
                                <input type="text" class="form-control" placeholder="10 Months">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Down PaymenT</label>
                                <input type="text" class="form-control" placeholder="&euro;21,300">
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-4 btn-block">Cauculate</button>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Properties details page end -->
@endsection