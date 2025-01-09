@extends('layouts.admin')
@section('title')
  @if(isset($feature))
    Update Property Feature
   @else 
   Create New Property Feature
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
          <li class="breadcrumb-item"><a href="">Technisions</a></li>
          <li class="breadcrumb-item active">
            @if(isset($feature))
            Update Property Feature
            @else 
             Create New Property Feature
            @endif 
          </li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">
          @if(isset($feature))
            Update Property Feature
            @else 
             Create New Property Feature
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
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ isset($feature) ? route('admin.property.feature.update',$feature->id) : route('admin.property.feature.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
              <label for="" class="form-control-label">Title</label>
              <input type="text" class="form-control" name="title" value="{{ isset($feature) ? $feature->title : old('title')}}" data-fv-notempty="true">
            </div>
            
            <div class="form-group">
              <label for="" class="form-control-label">Status</label>
              <select name="status" id="" class="form-control" data-fv-notempty="true">
                <option value="">Please Choose</option>
                <option value="1" @if(isset($feature) && $feature->status == 1 || (!empty(old('status')) && old('status') == 1)) selected @endif>Active</option>
                <option value="0" @if(isset($feature) && $feature->status == 0 || (!empty(old('status')) && old('status') == 0)) selected @endif>In Active</option>
              </select>
            </div>
            <div class="form-group float-left">
                <button class="btn btn-primary" type="submit">{{ isset($feature) ? 'Update' : 'Save' }}</button>
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
 <script>
   $(document).on('change','select[name="country"]',function(e){
     e.preventDefault();
     if (!$(this).val()) {
      $('select[name="province"]').empty();
      return this;
     }

     var country_id = $(this).val(),
         html_content = '';
     $.ajax({
      type:'get',
      url:'/admin/province/json/'+country_id,
      dataType:'json',
      success:function(data){
        if (data) {
          html_content += '<option value="">Please Choose</option>';
          $.each(data,function(item){
            html_content += '<option value="'+this.id+'">'+this.name+'</option>';
          });

          $('select[name="province"]').empty();
          $('select[name="province"]').html(html_content);
        }
      }
     })
   });
 </script>
@endsection