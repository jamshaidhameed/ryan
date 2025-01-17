@extends('layouts.admin')
@section('title')
  @if(isset($technision))
    Update User
   @else 
   Create New User
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
            @if(isset($technision))
            Update User
            @else 
             Create New User
            @endif 
          </li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">
          @if(isset($technision))
            Update User
            @else 
             Create New User
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
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ isset($technision) ? route('admin.user.update',$technision->id) : route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
              <div class="col col-md-6">
                <!-- First Column -->
                 <div class="form-group">
                  <label for="" class="form-control-label">First Name</label>
                  <input type="text" name="first_name" id="" class="form-control" data-fv-notempty="true" value="{{ isset($technision) ? $technision->first_name : old('first_name') }}">
              </div> 
              <div class="form-group">
                <label for="" class="form-control-label">Email Address</label>
                <input type="email" name="email" id="" class="form-control" data-fv-notempty="true" value="{{ isset($technision) ? $technision->email : old('email')}}">
              </div>
              <div class="form-group">
                <label for="" class="form-control-label">Gender</label>
                <select name="gender" id="" class="form-control" data-fv-notempty="true">
                  <option value="">Please Choose</option>
                  <option value="male" @if(isset($technision) && $technision->gender == 'male' || (!empty(old('gender')) && old('gender') == 'male')) selected @endif>Male</option>
                  <option value="female" @if(isset($technision) && $technision->gender == 'female' || (!empty(old('gender')) && old('gender') == 'female')) selected @endif>Female</option>
                  <option value="other" @if(isset($technision) && $technision->gender == 'other' || (!empty(old('gender')) && old('gender') == 'other')) selected @endif>Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="" class="form-control-label">Country</label>
                <select name="country" id="" class="form-control" data-fv-notempty="true">
                  <option value="">Please Choose</option>
                  @foreach(\App\Models\Countries::all() as $country)
                   <option value="{{ $country->id}}" @if(isset($technision) && $technision->country_id == $country->id) selected @endif>{{ $country->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="" class="form-control-label">City</label>
                <input type="text" name="city" id="" class="form-control" data-fv-notempty="true" value="{{ isset($technision) ? $technision->city : old('city') }}">
              </div>
              @if(!isset($technision))
              <div class="form-group">
                <label for="" class="form-control-label">Password</label>
                <input type="password" name="password" id="" class="form-control" data-fv-notempty="true">
              </div>
              @endif
                <!-- End First Column -->
              </div>
              <div class="col col-md-6">
                <!-- Second Column -->
                 <div class="form-group">
                  <label for="" class="form-control-label">Last Name</label>
                  <input type="text" name="last_name" id="" class="form-control" data-fv-notempty="true" value="{{ isset($technision) ? $technision->last_name : old('last_name') }}">
              </div>
                <div class="form-group">
                <label for="" class="form-control-label">phone</label>
                <input type="text" name="phone" id="" class="form-control" data-fv-notempty="true" value="{{ isset($technision) ? $technision->phone : old('phone')}}">
              </div>
              <div class="form-group">
                <label for="" class="form-control-label">Role</label>
                <select name="role" id="" class="form-control" data-fv-notempty="true">
                  <option value="">Please Choose</option>
                  <option value="technision" @if(isset($technision) && $technision->role == 'technision' || (!empty(old('technision')) && old('technision') == 'technision')) selected @endif>Technision</option>
                  <option value="sub admin" @if(isset($technision) && $technision->role == 'sub admin' || (!empty(old('role')) && old('role') == 'sub admin')) selected @endif>Sub Admin</option>
                  <option value="plumber" @if(isset($technision) && $technision->role == 'plumber' || (!empty(old('role')) && old('role') == 'plumber')) selected @endif>Plumber</option>
                </select>
              </div>
                <div class="form-group">
                  <label for="" class="form-control-label">Province</label>
                  <select name="province" id="" class="form-control" data-fv-notempty="true">
                    @if(isset($province))
                      <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endif
                  </select>
              </div>
              <div class="form-group">
                <label for="" class="form-control-label">Postal Code</label>
                <input type="text" name="postcode" id="" class="form-control" data-fv-notempty="true" value="{{ isset($technision) ? $technision->postcode : old('postcode') }}">
              </div>
              @if(!isset($technision))
              <div class="form-group">
                <label for="" class="form-control-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="" class="form-control" data-fv-notempty="true">
              </div>
              @endif
                 <!-- End Second Column -->
              </div>
            </div>

             <!-- Second Row -->
              <div class="row">
                <div class="col col-md-8">
                  <div class="form-group">
                    <label for="" class="form-control-label">Street Address</label>
                    <textarea name="street_address"  id="summernote" data-plugin="summernote">
                      @if(isset($technision))
                      {{ $technision->street_address}}
                      @elseif(!empty(old('street_address')))
                       {{ old('street_address') }}
                      @endif
                    </textarea>
                  </div>
                </div>
                <div class="col col-md-4">
                  <div class="form-group" style="margin-top: 164px;">
                <label for="" class="form-control-label">Status</label>
                <select name="status" id="" class="form-control" data-fv-notempty="true">
                  <option value="">Please Choose</option>
                  <option value="1" @if(isset($technision) && $technision->status == 1 || (!empty(old('status')) && old('status') == 1)) selected @endif>Active</option>
                  <option value="0" @if(isset($technision) && $technision->status == 0 || (!empty(old('status')) && old('status') == 0)) selected @endif>In Active</option>
                </select>
              </div>
                </div>
              </div>
             <!-- End Second Row -->
            <div class="form-group float-left">
                <button class="btn btn-primary" type="submit">{{ isset($technision) ? 'Update' : 'Save' }}</button>
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
      url:'{{ url("/admin/province/json") }}/'+country_id,
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