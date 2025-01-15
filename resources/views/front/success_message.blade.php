@extends('layouts.front')
@section('title')
 Booking Enquiry Successfully Sent
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Booking Success</h1>
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


    </div>
</div>
<!-- Properties details page end -->
@endsection