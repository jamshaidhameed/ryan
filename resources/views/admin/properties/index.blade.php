@extends('layouts.admin')
@section('title')
  Properties List
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Properties </a></li>
          <li class="breadcrumb-item active">list</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Properties List</h3>
        </div>
        <div class="panel-body mt-5">
              
        <!--  -->
        @if(session()->has('success'))
        <div class="alert alert-success mt-6">
            {{ session()->get('success')}}
        </div>
        @endif
        
          
         <!-- Start -->
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-left">Code</th>
                    <th>Title (eng)</th>
                    <th>Title (nl)</th>
                    <th>Type</th>
                    <th class="text-center">Price</th>
                    <th>Landlord</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Featured</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\Properties::with(['landlord','type'])->get() as $property)
                 <tr>
                    <td class="text-left">#{{ $property->property_code}}</td>
                    <td class="text-left"><a href="{{ route('admin.property.details',$property->slug) }}">{{ $property->title_en}}</a></td>
                    <td class="text-left">{{ $property->title_nl }}</td>
                    <td class="text-left">{{ !empty($property->type->name) ? $property->type->name : '' }}</td>
                    <td class="text-right">{{ number_format($property->price,2) }}</td>
                    <td class="text-left">{{ !empty($property->landlord->first_name) ? $property->landlord->first_name.' '.$property->landlord->last_name : ''}}</td>
                    <td class="text-center">
                        @if($property->status == 1)
                          <span class="badge badge-success font-weight-100">Published</span>
                        @else 
                        <span class="badge badge-warning font-weight-100">Not Published</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($property->featured == 1)
                          <span class="badge badge-success font-weight-100">Yes</span>
                        @else 
                        <span class="badge badge-warning font-weight-100">No</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                        <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                            @if($property->status == 1)
                            <a type="button" class="dropdown-item btn btn-primary btn-outline"
                                id="" href="{{ route('admin.properties.approve',[$property->id,0]) }}" onClick="return confirm(`{{ __ ('Are you sure to update the status of the property ? ')}} `);">
                                <i class="icon fa-pencil" aria-hidden="true" style="font-size: 15px;"></i>{{ __('Un Approve') }}</a>
                            @else 
                            <a type="button" class="dropdown-item btn btn-primary btn-outline"
                                id="" href="{{ route('admin.properties.approve',[$property->id,1]) }}"  onClick="return confirm(`{{ __ ('Are you sure to update the status of the property ? ')}}`);">
                                <i class="icon fa-pencil" aria-hidden="true" style="font-size: 15px;"></i>{{ __('Approve') }}</a>
                            @endif
                            <!-- <a type="button" class="dropdown-item btn btn-danger btn-outline"
                            id="delete-category" href="">
                            <i class="icon fa-trash-o" aria-hidden="true" style="font-size: 15px;"></i>Delete</a> -->
                            <a type="button" target="_blank" href="{{ route('admin.property.details',$property->slug) }}" class="dropdown-item btn btn-primary btn-outline"><i class="icon fa-eye" aria-hidden="true" style="font-size: 15px;"></i>Details</a>
                        </div>
                    </td>
                 </tr>
                @endforeach
            </tbody>
          </table>
        <!-- Delete Model is Start Here -->
        <div class="modal fade delete-use" id="examplePositionCenter" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-center">
              <form action="" method="POST" id="deleteStudentform">
                @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                        </button>
                           <h4 class="modal-title">Delete Employee Adhoc Relief</h4>
                           </div>
                            <div class="modal-body">
                        <p class="text-danger">Are you Sure to Delete the Employee Adhoc Relief?</p>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <a href="" type="button" class="btn btn-danger">Delete</a>
                  </div>
                </div>
              </div>
              </form>
            </div>
        <!-- Model End  -->

        <!-- Update Model is Start Here -->
        <div class="modal fade update-ar" id="examplePositionCenter" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-center">
              <form action="" class="form-horizontal" method="POST" id="exampleConstraintsForm">
                @csrf
                <input type="hidden" name="id" value="">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                        </button>
                           <h4 class="modal-title">Update Adhoc Relief</h4>
                           </div>
                            <div class="modal-body">
                        <div class="form-group">
                          <label for="" class="form-control-label">Amount</label>
                          <input type="number" name="amount" id="" class="form-control" data-fv-notempty="true"> 
                        </div>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
              </form>
            </div>
        <!-- Model End  -->
         
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page -->
@endsection
@section('script')
<script>
 $(document).ready(function() {
    $('.table').dataTable();
 });
</script>
@endsection