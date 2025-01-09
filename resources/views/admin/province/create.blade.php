@extends('layouts.admin')
@section('title')
  @if(isset($province))
    Update Province
   @else 
   Create New Province
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
            @if(isset($province))
            Update Province
            @else 
             Create New Province
            @endif 
          </li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">
          @if(isset($province))
            Update Province
            @else 
             Create New Province
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
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ isset($province) ? route('admin.province.update',$province->id) : route('admin.province.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="" class="form-control-label">Country</label>
              <select name="country_id" id="" class="form-control" data-fv-notempty="true">
                <option value="">Please Choose</option>
                @foreach(\App\Models\Countries::all() as $country)
                 <option value="{{ $country->id }}" @if(isset($province) && $province->country_id == $country->id || (!empty('country_id') && old('country_id') == $country->id)) selected @endif >{{ $country->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="" class="form-control-label">Province Name</label>
              <input type="text" class="form-control" name="name" value="{{ isset($province) ? $province->name : old('name')}}" data-fv-notempty="true">
            </div>
             <div class="form-group">
              <label for="" class="form-control-label">Short Name</label>
              <input type="text" class="form-control" name="short_name" value="{{ isset($province) ? $province->short_name : old('short_name')}}" data-fv-notempty="true">
            </div>
            <div class="form-group">
              <label for="" class="form-control-label">Status</label>
              <select name="status" id="" class="form-control" data-fv-notempty="true">
                <option value="">Please Choose</option>
                <option value="1" @if(isset($province) && $province->status == 1 || (!empty(old('status')) && old('status') == 1)) selected @endif>Active</option>
                <option value="0" @if(isset($province) && $province->status == 0 || (!empty(old('status')) && old('status') == 0)) selected @endif>In Active</option>
              </select>
            </div>
            <div class="form-group float-left">
                <button class="btn btn-primary" type="submit">{{ isset($province) ? 'Update' : 'Save' }}</button>
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