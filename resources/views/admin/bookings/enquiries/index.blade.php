@extends('layouts.admin')
@section('title')
  Booking Enquiries List
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Booking Enquiries </a></li>
          <li class="breadcrumb-item active">list</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Booking Enquiries List</h3>
        </div>
        <div class="panel-body mt-5">
              
        <!--  -->
        @if(session()->has('success'))
        <div class="alert alert-success mt-6">
            {{ session()->get('success')}}
        </div>
        @endif
        
        
          
         <!-- Start -->
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">S.No</th>
                    <th>Enquiry No</th>
                    <th>Tenant</th>
                    <th>Property</th>
                    <th>Message</th>
                    <th>Tenant File</th>
                    <th>Landlord File</th>
                    <th>File Upload by Tenant</th>
                    <th>File Upload by Landlord</th>
                    <th class="text-center">Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($enquiries as $enquiry)
                 <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $enquiry->enquiry_no}}</td>
                    <td class="text-left">{{ !empty($enquiry->tenant->first_name) && !empty($enquiry->tenant->last_name) ? $enquiry->tenant->first_name.' '.$enquiry->tenant->last_name : ''}}</td>
                    <td>{{ !empty($enquiry->property->title_en) ? $enquiry->property->title_en : ''}}</td>
                    <td>{{ $enquiry->message}}</td>
                    <td>
                        @if(!empty($enquiry->tenant_file_name))
                         <a href="{{ asset('upload/booking/'.$enquiry->tenant_file_name) }}" type="button" class="btn btn-primary btn-sm btn-outline"><i class="wb wb-download"></i> Download</a>
                        @endif
                    </td>
                    <td>
                        @if(!empty($enquiry->landlord_file_name))
                         <a href="{{ asset('upload/booking/'.$enquiry->landlord_file_name) }}" type="button" class="btn btn-primary btn-sm btn-outline"><i class="wb wb-download"></i> Download</a>
                        @endif
                    </td>
                    <td>
                         @if(!empty($enquiry->tenant_uploaded_file))
                         <a href="{{ asset('upload/booking/'.$enquiry->tenant_uploaded_file) }}" type="button" class="btn btn-primary btn-sm btn-outline"><i class="wb wb-download"></i> Download</a>
                        @endif
                    </td>
                    <td>
                         @if(!empty($enquiry->landlord_uploaded_file))
                         <a href="{{ asset('upload/booking/'.$enquiry->landlord_uploaded_file) }}" type="button" class="btn btn-primary btn-sm btn-outline"><i class="wb wb-download"></i> Download</a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($enquiry->status == 'approved')
                          <span class="badge badge-success font-weight-100">Approved</span>
                        @elseif($enquiry->status == 'started')
                        <span class="badge badge-info font-weight-100">Started</span>
                        @else 
                        <span class="badge badge-warning font-weight-100">Not Approved</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                        <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                        
                            <a type="button" class="dropdown-item btn btn-primary btn-outline btn-reply"
                                id="" href="{{ route('admin.property.types.edit',$enquiry->id)}}" data-id="{{ $enquiry->id }}">
                                <i class="icon fa-pencil" aria-hidden="true" style="font-size: 15px;"></i>Reply</a>
                            @if($enquiry->tenant->status == '0')
                            <a type="button" class="dropdown-item btn btn-success btn-outline"
                                id="" href="{{ route('admin.account.active',$enquiry->id)}}" onClick="return confirm(`Are you sure to active the Tenant Account ? `);">
                                <i class="icon fa-file" aria-hidden="true" style="font-size: 15px;"></i>Active Account</a>
                            @endif

                            @if($enquiry->status != 'started')
                            <a target="_blank"  type="button" class="dropdown-item btn btn-success btn-outline" href="{{ route('admin.generate.contract.file',[$enquiry->id,'landlord']) }}"><i class="icon fa-file-pdf-o" aria-hidden="true" style="font-size: 15px;"></i>Contract file for Landlord</a>
                             <a target="_blank"  type="button" class="dropdown-item btn btn-success btn-outline" href="{{ route('admin.generate.contract.file',[$enquiry->id,'tenant']) }}"><i class="icon fa-file-pdf-o" aria-hidden="true" style="font-size: 15px;"></i>Contract file for Tenant</a>
                            <a type="button" class="dropdown-item btn btn-success btn-outline start-cont"
                                id="" href="{{ $enquiry->id }}" data-id="{{ $enquiry->id }}">
                                <i class="icon fa-file" aria-hidden="true" style="font-size: 15px;"></i>Start Contract</a>
                            @endif

                            @if($enquiry->status == 'started')
                            <a target="_blank" type="button" class="dropdown-item btn btn-danger btn-outline"
                            id="delete-type" href="{{ route('admin.booking.enquiry.invoices',$enquiry->id)}}">
                            <i class="icon fa-eye" aria-hidden="true" style="font-size: 15px;"></i>Invoices</a>
                            @endif
                        </div>
                    </td>
                 </tr>
                @endforeach
            </tbody>
          </table>
        <!-- Delete Model is Start Here -->
        <div class="modal fade update-modal" id="examplePositionCenter" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-center">
              <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ route('admin.booking.enquiry.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="e_id" value="">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                        </button>
                           <h4 class="modal-title">Reply to the Enquiry</h4>
                           </div>
                            <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-control-label">File for Landlord</label>
                            <input type="file" name="landlord_file_name" id="" class="form-control" accept="docx|pdf">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">File for Tenant</label>
                            <input type="file" name="tenant_file_name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="">Please Choose</option>
                                <option value="notapproved">Not Approve</option>
                                <option value="approved">Approve</option>
                                <option value="started">Start</option>
                                <option value="end">End</option>
                            </select>
                        </div>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <!-- <a href="" type="button" class="btn btn-danger">Delete</a> -->
                       <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
              </form>
            </div>
        <!-- Model End  -->

        <!-- Start Contract Model is Start Here -->
        <div class="modal fade start-contract" id="examplePositionCenter" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-center">
              <form class="form-horizontal approve-form" id="exampleConstraintsForm" autocomplete="off" action="{{ route('admin.start.contract') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="e_id" value="">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                        </button>
                           <h4 class="modal-title">Start Contract</h4>
                           </div>
                            <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-control-label">Start Date</label>
                            <input type="date" name="start_date" id="" class="form-control" data-fv-notempty="true">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">End Date</label>
                            <input type="date" name="end_date" id="" class="form-control" data-fv-notempty="true">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Commision Amount (%)</label>
                            <input type="number" min="0" max="100" name="commision" id="" class="form-control" data-fv-notempty="true">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Status</label>
                            <select name="status" id="" class="form-control" data-fv-notempty="true">
                                <option value="">Please Choose</option>
                                <option value="started">Start</option>
                                <option value="end">End</option>
                            </select>
                        </div>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <!-- <a href="" type="button" class="btn btn-danger">Delete</a> -->
                       <button type="submit" class="btn btn-primary">Save</button>
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
 $(document).on('click','.btn-reply',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('.update-modal').find('form').find('input[name="e_id"]').val(id);
    $('.update-modal').modal();
 });
</script>
<script>
  $(document).on('click','.start-cont',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('.start-contract').find('form').find('input[name="e_id"]').val(id);
    $('.start-contract').modal();
  });
</script>
<script>
  $(document).on('submit','.approve-form',function(e){

    var start_date = $('input[name="start_date"]').val(),
        end_date = $('input[name="end_date"]').val();

     if (start_date == end_date) {
        alert('Start Date and End Date Must be different');
        e.preventDefault();

        return this;
     }
  });
</script>
@endsection