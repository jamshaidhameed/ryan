@extends('technician.layouts.master') 
@section('title')
   Resolve Issue
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('summernote/summernote.css')}}">
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Resolve Issue</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home')}}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.dashboard' ? 'active' : ''}}">{{ __('Resolve Issue') }}</li>
            </ul>
        </div>
    </div>
</div>
<div class="user-page content-area-2">
    <div class="container">
         <form action="{{ route('technision.issue.resolve') }}" method="post" enctype="multipart/form-data">
            @csrf
                <!-- Resolve Row Start -->
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
                <!-- Resolve Row End -->
            <div class="col-lg-12">
                <div class="send-btn"> 
                    <button type="submit" class="btn btn-4">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('summernote/summernote.js')}}"></script>
<script>
 $(document).ready(function() {
     $('.summernote').summernote({
      height: 300, // Set editor height
         toolbar: [
            ['style', ['bold', 'italic', 'underline']], // Style options
            ['para', ['ul', 'ol', 'paragraph']],       // Paragraph options
            ['insert', ['link', 'picture']],          // Insert options
         ]
    });
 });
</script>
@endsection