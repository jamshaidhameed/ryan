@extends('layouts.admin')
@section('title')
  Technisions List
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Technisions </a></li>
          <li class="breadcrumb-item active">list</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Technisions List</h3>
        </div>
        <div class="panel-body mt-5">
              
        <!--  -->
        @if(session()->has('success'))
        <div class="alert alert-success mt-6">
            {{ session()->get('success')}}
        </div>
        @endif
        
          <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('admin.technision.create') }}" class="btn btn-primary float-right"><i class="icon wb-plus-circle"></i>Add</a>
        </div>
        
          
         <!-- Start -->
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th class="text-center">Country</th>
                    <th class="text-center">Province</th>
                    <th class="text-center">City</th>
                    <th class="text-left">Address</th>
                    <th class="text-center">Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\User::where('role','technision')->with(['country','province'])->get() as $user)
                 <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $user->first_name.' '.$user->last_name}}</td>
                    <td class="text-left">{{ $user->email }}</td>
                    <td class="text-left">{{ $user->phone }}</td>
                    <td class="text-center">{{ !empty($user->country->name) ? $user->country->name : ''}}</td>
                    <td class="text-center">{{ !empty($user->province->name) ? $user->province->name : ''}}</td>
                    <td class="text-center">{{ $user->city }}</td>
                    <td class="text-left">{{ $user->street_address }}</td>
                    <td class="text-center">
                        @if($user->status == 1)
                          <span class="badge badge-success font-weight-100">Active</span>
                        @else 
                        <span class="badge badge-warning font-weight-100">In Active</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                        <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                        
                            <a type="button" class="dropdown-item btn btn-primary btn-outline"
                                id="" href="{{ route('admin.technision.edit',$user->id)}}">
                                <i class="icon fa-pencil" aria-hidden="true" style="font-size: 15px;"></i>Edit</a>
                            <a type="button" class="dropdown-item btn btn-danger btn-outline"
                            id="delete-type" href="{{ route('admin.technision.delete',$user->id)}}">
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
                           <h4 class="modal-title">Delete Technision</h4>
                           </div>
                            <div class="modal-body">
                        <p class="text-danger">Are you Sure to Delete the Technision ?</p>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger">Delete</button>
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
<script>
@endsection