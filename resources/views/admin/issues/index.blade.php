@extends('layouts.admin')
@section('title')
  Issue Tickets
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Properties Details</a></li>
          <li class="breadcrumb-item active">Issue Tickets</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Issue Tickets</h3>
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
                    <th class="text-center">Issue Code</th>
                    <th class="text-left">Issue Title</th>
                    <th class="text-center">Tenant/Admin</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($issue_tickets as $ticket)
             <tr>
                <td class="text-center">{{ $ticket->issue_code}}</td>
                <td class="text-left">{{ $ticket->title }}</td>
                <td class="text-center">{{ $ticket->tenant}}</td>
                <td class="text-center">{{ ucwords($ticket->status) }}</td>
                <td class="text-center">
                  <a href="{{ route('admin.issue.ticket',$ticket->id) }}" type="button" class="btn btn-primary btn-outline btn-round">
                    <i class="fa fa-eye font-wight-100"></i>
                  </a>
                </td>
             </tr>
            @endforeach
          </tbody>
          </table>
          
         
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