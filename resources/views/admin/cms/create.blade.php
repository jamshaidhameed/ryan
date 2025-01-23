@extends('layouts.admin')
@section('title')
  @if(isset($cms))
    Update CMS Page
   @else 
   Create New CMS Page
  @endif
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/global/vendor/summernote/summernote.min599c.css?v4.0.2') }}">
@endsection
@section('content')

<!-- Page -->
<div class="page">
<div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="">Provinces</a></li>
          <li class="breadcrumb-item active">
            @if(isset($cms))
            Update CMS Page
            @else 
             Create New CMS Page
            @endif 
          </li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">
          @if(isset($cms))
            Update CMS Page
            @else 
             Create New CMS Page
            @endif  
          </h3>
        </div>
        <div class="panel-body mt-5">
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
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ isset($cms) ? route('admin.cms.pages.update',$cms->id) : route('admin.cms.pages.post')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="" class="form-control-label">Title</label>
              <input type="text" name="title" id="" class="form-control" value="{{ isset($cms) ? $cms->title : old('title') }}">
            </div>
            
             <div class="form-group">
              <label for="" class="form-control-label">Content (EN)</label>
              <textarea name="content_en"   id="summernote" data-plugin="summernote">
                @if(isset($cms))
                  {{ $cms->content_en}}
                @else 
                 {{ old('content_en')}}
                 @endif
              </textarea>
            </div>
            <div class="form-group">
              <label for="" class="form-control-label">Content (NL)</label>
              <textarea name="content_nl" id="summernote" data-plugin="summernote">
                @if(isset($cms))
                  {{ $cms->content_nl}}
                @else 
                 {{ old('content_nl')}}
                @endif
              </textarea>
            </div>
            <div class="form-group">
              <label for="" class="form-control-label">Show On</label>
              <select name="show_on" id="" class="form-control" data-fv-notempty="true">
                <option value="">Please Choose</option>
                <option value="header" @if(isset($cms) && $cms->show_on == 'header'|| (!empty(old('show_on')) && old('show_on') == 'header')) selected @endif>Head Section</option>
                <option value="footer" @if(isset($cms) && $cms->show_on == 'footer' || (!empty(old('show_on')) && old('show_on') == 'footer')) selected @endif>Footer Section</option>
              </select>
            </div>
            <div class="form-group">
              <label for="" class="form-control-label">Status</label>
              <select name="status" id="" class="form-control" data-fv-notempty="true">
                <option value="">Please Choose</option>
                <option value="active" @if(isset($cms) && $cms->status == 'active' || (!empty(old('status')) && old('status') == 'active')) selected @endif>Active</option>
                <option value="inactive" @if(isset($cms) && $cms->status == 'inactive' || (!empty(old('status')) && old('status') == 'inactive')) selected @endif>In Active</option>
              </select>
            </div>
            <div class="form-group float-left">
                <button class="btn btn-primary" type="submit">{{ isset($cms) ? 'Update' : 'Save' }}</button>
            </div>
            </form> 
        </div>
        <!--  -->
         
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page -->

@endsection
@section('script')
<script src="{{ asset('backend/global/vendor/summernote/summernote.min599c.js?v4.0.2') }}"></script>
<script src="{{ asset('backend/global/js/Plugin/summernote.min599c.js?v4.0.2') }}"></script>
<script src="{{ asset('backend/assets/examples/js/forms/editor-summernote.min599c.js?v4.0.2') }}"></script>
@endsection