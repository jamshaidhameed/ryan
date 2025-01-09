@extends('layouts.admin')
@section('title')
  Property Type List
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Property Type </a></li>
          <li class="breadcrumb-item active">list</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Property Type List</h3>
        </div>
        <div class="panel-body mt-5">
              
        <!--  -->
        @if(session()->has('success'))
        <div class="alert alert-success mt-6">
            {{ session()->get('success')}}
        </div>
        @endif
        
          <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('admin.property.types.create') }}" class="btn btn-primary float-right"><i class="icon wb-plus-circle"></i>Add</a>
        </div>
        
          
         <!-- Start -->
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">S.No</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th class="text-center">Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\PropertyTypes::all() as $type)
                 <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $type->name}}</td>
                    <td class="text-left">{{ $type->slug }}</td>
                    <td class="text-center">
                        @if($type->status == 1)
                          <span class="badge badge-success font-weight-100">Active</span>
                        @else 
                        <span class="badge badge-warning font-weight-100">In Active</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                        <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                        
                            <a type="button" class="dropdown-item btn btn-primary btn-outline"
                                id="" href="{{ route('admin.property.types.edit',$type->id)}}">
                                <i class="icon fa-pencil" aria-hidden="true" style="font-size: 15px;"></i>Edit</a>
                            <a type="button" class="dropdown-item btn btn-danger btn-outline"
                            id="delete-type" href="{{ route('admin.property.types.delete',$type->id)}}">
                            <i class="icon fa-trash-o" aria-hidden="true" style="font-size: 15px;"></i>Delete</a>
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
                           <h4 class="modal-title">Delete Property Type</h4>
                           </div>
                            <div class="modal-body">
                        <p class="text-danger">Are you Sure to Delete the Property Type?</p>
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
 $(document).on('click','#delete-type',function(e){
    e.preventDefault();
    $('.delete-use').find('form').attr('action',$(this).attr('href'));
    $('.delete-use').modal();
 });
</script>
@endsection