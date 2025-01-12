@extends('layouts.admin')
@section('title')
  Issue Tickets
@endsection
@section('style')
  <link rel="stylesheet" href="{{ asset('summernote/summernote.css')}}">
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
            <h3 class="panel-title">Resolve Issue</h3>
            </div>
            <div class="panel-body mt-5">
                
            <!--  -->
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

            <h4>{{ $issue_ticket->title }}</h4>
            <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ route('admin.issue.ticket.resolve.post') }}" method="post">

              @csrf
              <input type="hidden" name="issue_id" value="{{ $issue_ticket->id }}">

              <div class="row">
                  <div class="col col-md-6">
                    <!-- First Column -->
                      <div class="form-group">
                        <label for="" class="form-control-label">Status</label>
                        <select name="status" id="" class="form-control" data-fv-notempty="true">
                          <option value="">Please Choose</option>
                          <option value="pending" @if($issue_ticket->status == 'pending') selected @endif>Pending</option>
                          <option value="in progress" @if($issue_ticket->status == 'in progress') selected @endif>In Progress</option>
                          <option value="resolved" @if($issue_ticket->status == 'resolved') selected @endif>Resolved</option>
                        </select>
                      </div>
                     <!-- End First Column -->
                  </div>
                  <div class="col col-md-6">
                    <!-- Second Column -->
                      <div class="form-group">
                        <label for="" class="form-control-label">Priority</label>
                        <select name="priority" id="" class="form-control">
                          <option value="">Please Choose</option>
                          <option value="low" @if($issue_ticket->priority == 'low') selected @endif>Low</option>
                          <option value="high" @if($issue_ticket->priority == 'high') selected @endif>High</option>
                        </select>
                      </div>
                     <!-- End Second Column -->
                  </div>
              </div>

              <!-- Detail Area Start -->
                <div class="row">
                  <!-- first Column -->
                    <div class="col col-md-6">
                      <div class="form-group">
                        <label for="" class="form-control-label">Issue Identification</label>
                        <textarea name="issue_identification" id="" class="summernote" rows="50">

                        </textarea>
                      </div>
                    </div>
                    
                   <!-- End First Column -->
                    <div class="col col-md-6">
                      <div class="form-group">
                        <label for="" class="form-control-label">Issue Resolved Description</label>
                        <textarea name="issue_resolved_description" id="" class="summernote" rows="50">

                        </textarea>
                      </div>
                    </div>
                    <!-- End Second Column -->
                </div>
                <!-- End of Row -->
               <!-- End Detail Area -->
                <h3>Invoice Information</h3>
                <hr>
                <div class="form-group">
                  <label for="" class="form-control-label">Costing</label>
                  <input type="number" name="cost" id="" class="form-control" step="any" value="0.00" min="0">
                </div>
                <div class="form-group">
                  <input type="checkbox" data-plugin="switchery" data-color="#f26928" name="cost_paid" value="1" /> Issue Ticket Cost Paid
                </div>
                <div class="form-group">
                  <label for="" class="form-control-label">Remarks</label>
                  <textarea name="remarks" id="" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-outline">Save</button>
            </form>


        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page -->
@endsection
@section('script')
<script src="{{ asset('summernote/summernote.js')}}"></script>
<script>
 $(document).ready(function() {
     $('.summernote').summernote();
 });
</script>
@endsection


