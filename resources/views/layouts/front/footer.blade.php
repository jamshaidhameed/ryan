
<!-- Footer start -->
<footer class="footer-1">
    <div class="container footer-inner">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>Contact Us</h4>
                    <ul class="contact-info">
                        <li>
                            <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>Energieweg 22C, 3133EC Vlaardingen
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i><a href="mailto:info@ryanrent.nl">info@ryanrent.nl</a>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i><a href="tel:+06 82 746 368">+06 82 746 368</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>
                        Useful Links
                    </h4>
                    <ul class="links">
                        <li>
                            <a href="{{ url('/') }}"><i class="fa fa-angle-right"></i>Home</a>
                        </li>
                        <li>
                            <a href="{{ route('properties.list') }}"><i class="fa fa-angle-right"></i>Properties</a>
                        </li>
                        <li>
                            <a href="{{ route('contact.us') }}"><i class="fa fa-angle-right"></i>Contact Us</a>
                        </li>
                        @foreach(\App\Models\cms::where('show_on','footer')->get() as $page)
                        <li>
                            <a href="{{ route('cms.page',$page->slug) }}"><i class="fa fa-angle-right"></i>{{ucwords( $page->title) }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="footer-item recent-posts">
                    <h4>Recent Properties</h4>
                    @php $recent_properties = \App\Models\Properties::orderBy('id','desc')->where('status',1)->limit(2)->get(); @endphp
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
            </div>
            <div class="col-xl-4 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item clearfix">
                    <div class="submitNewsletter">
                        <h4>Abonnementen</h4>
                        <div class="Subscribe-box">
                            
                            <form action="#" method="GET">
                                <input type="text" class="form-contact" name="name" placeholder="Uw naam">
                                <input type="text" class="form-contact" name="email" placeholder="E-mailadres">
                                <input type="text" class="form-contact" name="Telephone" placeholder="Telefoonnummer">
                                <button type="submit" name="submitNewsletter" class="btn btn-color">
                                    <i class="fa fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <p class="copy">© 2024 <a href="#">RyanRent.nl</a> All Rights Reserved.</p>
                </div>
                
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Full Page Search -->
<div id="full-page-search">
    <button type="button" class="close">×</button>
    <form action="#" class="search">
        <input type="search" value="" placeholder="type keyword(s) here"/>
        <button type="button" class="btn btn-sm btn-color">Search</button>
    </form>
</div>

