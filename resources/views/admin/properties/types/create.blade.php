@extends('layouts.admin')
@section('title')
  @if(isset($type))
    Update Property Type
   @else 
   Create New Property Type
  @endif
@endsection
@section('content')

<!-- Page -->
<div class="page">
<div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="">Property Types</a></li>
          <li class="breadcrumb-item active">
            @if(isset($type))
            Update Property Type
            @else 
             Create New Property Type
            @endif 
          </li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">
          @if(isset($type))
            Update Property Type
            @else 
             Create New Property Type
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
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ isset($type) ? route('admin.property.types.update',$type->id) : route('admin.property.types.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="" class="form-control-label">Name</label>
                <input type="text" name="name" id="" class="form-control" data-fv-notempty="true" value="{{ isset($type) ? $type->name : old('name') }}">
            </div>
            <div class="form-group">
                <label for="" class="form-control-label">Status</label>
                <select name="status" id="" class="form-control" data-fv-notempty="true">
                    <option value="">Please Choose</option>
                    <option value="1" @if(isset($type) && $type->status == 1 || (!empty(old('status')) && old('status') == 1)) selected @endif>Active</option>
                    <option value="0" @if(isset($type) && $type->status == 0 || (!empty(old('status')) && old('status') == 0)) selected @endif>In Active</option>
                </select>
            </div>
            <div class="form-group float-left">
                <button class="btn btn-primary" type="submit">{{ isset($type) ? 'Update' : 'Save' }}</button>
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