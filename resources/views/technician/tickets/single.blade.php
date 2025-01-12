@extends('technician.layouts.master')
@section('title')
 Issue Ticket
@endsection
@section('style')
 <style>
    strong {
        font-weight: bold;
    }
    .modal-header .close {
        padding: 15px;
        margin: -15px -489px 0px auto;
    }
 </style>
@endsection
@section('content')
<div class="page">

 <div class="page-content container-fluid">
   <!-- row -->
    <div class="row">
        <!-- Start First Column -->
        <div class="col col-md-5">
            <div class="card border border-primary"">
                <div class="card-body">
                    <p class="card-title"><strong>Issue Ticket Status</strong></p>
                    
                    <div class="card-text">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Priority</td>
                                    <td class="text-right"><badge class="badge badge-success">{{ ucwords($issue_ticket->priority) }}</badge></td>
                                </tr>
                                <tr>
                                    <td>Raised By</td>
                                    <td class="text-right">
                                        @php $tenant_contract = \App\Models\TenantContracts::find($issue_ticket->tenant_contract_id); 
                                           $raised_by = !empty($tenant_contract) ? \App\Models\User::find($tenant_contract->user_id) : null;
                                        @endphp
                                        {{ !empty($raised_by) ? ucwords($raised_by->first_name." ".$raised_by->last_name) : ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assigned to</td>
                                    <td class="text-right">
                                        @php $assigned_to = !empty($issue_ticket->assigned_to) ? \App\Models\User::find($issue_ticket->assigned_to) : null;
                                        @endphp

                                        {{ !empty($assigned_to) ? ucwords($assigned_to->first_name." ".$assigned_to->last_name) : '-'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assigned by</td>
                                    <td class="text-right">
                                        @php $assigned_by = !empty($issue_ticket->assigned_by) ? \App\Models\User::find($issue_ticket->assigned_by) : null;
                                        @endphp

                                        {{ !empty($assigned_by) ? ucwords($assigned_by->first_name." ".$assigned_by->last_name) : '-'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td class="text-right">
                                        {{ ucwords($issue_ticket->status)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Invoice Details</td>
                                    <td class="text-right">
                                        @php $issue_invoice = \App\Models\IssueTicketInvoices::where('issue_ticket_id',$issue_ticket->id)->first(); @endphp
                                        @if(!empty($issue_invoice) && $issue_invoice->paid == 0)
                                         <a class="btn btn-primary btn-sm btn-issue-invoice-pay" href="" data-id="{{ $issue_invoice->id }}">Pay</a>
                                         @elseif(!empty($issue_invoice) && $issue_invoice->paid == 1) 
                                         <a class="btn btn-primary btn-sm" href="{{ route('technision.issue.receipt.download',$issue_invoice->id) }}" target="_blank">Get Receipt</a>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td>Resolve Cost</td>
                                    <td class="text-right"> {{ !empty($issue_invoice) ? number_format($issue_invoice->cost,2) :  number_format(0,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Resolve cost paid</td>
                                    <td class="text-right">

                                    @if(!empty($issue_invoice) && $issue_invoice->paid == 0)
                                        No
                                    @elseif(!empty($issue_invoice) && $issue_invoice->paid == 1) 
                                     Yes 
                                    @else 
                                      No
                                    @endif
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End First Column -->
        <div class="col col-md-7">
            <!-- first Card Start -->
             <div class="card border border-primary">
                <div class="card-body">
                    <p class="card-title">
                        <strong>
                        {{ ucwords($issue_ticket->title)}}
                        <hr>
                        </strong>
                    </p>
                    <div class="card-text">
                        {!! html_entity_decode($issue_ticket->description) !!}
                    </div>
                </div>
             </div>
             <!-- First card End -->
              <!-- Second Card Start -->
               <div class="card border border-primary">
                <div class="card-body">
                    <p class="card-title">
                        <strong>
                        Resolved Description
                        <hr>
                        </strong>
                        @if($issue_ticket->status != 'resolved')
                         <div class="d-flex justify-content-end" style="margin-top: -67px;">
                            <div class="d-flex justify-content-between">
                             
                               <a href="{{ route('technision.issue.resolve.option',$issue_ticket->id) }}" class="btn btn-sm btn-primary">Resolve</a>
                             
                            </div>
                        </div>
                        @endif
                    </p>
                    <div class="card-text">
                        @if(empty($issue_ticket->assigned_to))
                          Not yet Assigned
                        @else 
                         <h5><span style="border-bottom:1px solid black;">Issue Identification</span></h5>
                         {!! html_entity_decode($issue_ticket->issue_identification) !!}
                         <h5><span style="border-bottom:1px solid black;">Resolve description</span></h5>
                         {!! html_entity_decode($issue_ticket->issue_resolved_description) !!}
                        @endif
                    </div>
                </div>
             </div>
               <!-- Second Card End -->
        </div>
        <!-- End Second Column -->
    </div>
    <!-- End Row -->
 </div>
<!-- End of Page Content -->


 <!-- Pay Modal Starts Here -->
<div class="modal fade issue-ticket-pay-modal" id="examplePositionTop" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-top">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <span style="text-align: left;margin-right: 319px;"> Issue Ticket Payment</span>
        </h4>
        </div>
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ route('technision.issue.invoice.pay') }}" method="post">
         @csrf 
         <input type="hidden" name="ticket_id" value="">
         <div class="modal-body">
           <div class="form-group">
            <label for="" class="form-control-label">Remarks</label>
             <textarea name="remarks" id="" class="form-control"></textarea>
           </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Pay</button>
        </div>
        </form>
        
    </div>
    </div>
</div>
 <!-- Pay Modal End Here -->
</div>
@endsection
@section('script')
<script src="{{ asset('backend/custom/script.js') }}"></script>
@endsection