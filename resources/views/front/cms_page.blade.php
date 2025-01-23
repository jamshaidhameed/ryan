@extends('layouts.front')
@section('title')
  {{ !empty($cms_page) ? $cms_page->title : ''}}
@endsection
@section('content')
<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ !empty($cms_page) ? $cms_page->title : ''}}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">{{ !empty($cms_page) ? $cms_page->title : ''}}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->
 <div class="contact-3 content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>{{ !empty($cms_page) ? $cms_page->title : ''}}</h1>
        </div>
    {!! html_entity_decode($cms_page->content_en) !!}
 </div>
</div>
@endsection