@extends('layouts.front')
@section('title')
 @lang('titles.contactus')
@endsection
@section('content')
<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>@lang('titles.contactus')</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">@lang('titles.contactus')</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Contact 3 start -->
<div class="contact-3 content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>@lang('titles.contactus')</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
        </div>
        <form action="#" method="GET" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group name">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group email">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group subject">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group number">
                                    <input type="text" name="phone" class="form-control" placeholder="Number">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group message">
                                    <textarea class="form-control" name="message" placeholder="Write message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="send-btn">
                                    <button type="submit" class="btn btn-4">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="contact-info">
                        <h3>Contact Info</h3>
                        <div class="mb-40">
                            <div class="ci-box">
                                <div class="icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="detail">
                                    <h5>Office Address</h5>
                                    <p>20/F Green Road, Dhanmondi, Dhaka</p>
                                </div>
                            </div>
                            <div class="ci-box">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="detail">
                                    <h5>Phone</h5>
                                    <p><a href="tel:+0477-85x6-552">+55 417 634 7X71</a> </p>
                                </div>
                            </div>
                            <div class="ci-box">
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="detail">
                                    <h5>Email</h5>
                                    <p><a href="tel:info@themevessel.com">info@themevessel.com</a></p>
                                </div>
                            </div>
                        </div>
                        <h3>Follow Us</h3>
                        <ul class="social-list clearfix">
                            <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="rss-bg"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact 3 end -->
@endsection