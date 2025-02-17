@extends('layouts.admin')

@section('title')
    Invoice Management
@endsection

@section('content')

<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title')) }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin Dashboard</li>
            <li class="breadcrumb-item"><a href="#">Invoices</a></li>
            <li class="breadcrumb-item active">Invoice List</li>
        </ol>
    </div>

    <div class="page-content container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Invoice List for Booking Inquiry No: 
                    <span class="text-info">{{ $enquiry->enquiry_no }}</span>
                </h3>
            </div>
            <div class="panel-body mt-5">

                @if(session()->has('success'))
                    <div class="alert alert-success mt-6">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <!-- Invoice Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">S.No</th>
                            <th>Tenant</th>
                            <th>Property</th>
                            <th class="text-center">Rental Period</th>
                            <th class="text-center">Amount (€)</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">
                                    {{ !empty($enquiry->tenant->first_name) && !empty($enquiry->tenant->last_name) 
                                    ? $enquiry->tenant->first_name.' '.$enquiry->tenant->last_name : '' }}
                                </td>
                                <td>{{ $invoice->property->title_en ?? '' }}</td>
                                <td class="text-center">
                                    {{ date_format(date_create($invoice->from_date), 'd-M-Y') }} 
                                    to 
                                    {{ date_format(date_create($invoice->till_date), 'd-M-Y') }}
                                </td>
                                <td class="text-center">
                                    €{{ number_format($invoice->amount, 2) }}
                                </td>
                                <td class="text-center">
                                    @if($invoice->status == 'paid')
                                        <span class="badge badge-success font-weight-100">Paid</span>
                                    @else
                                        <span class="badge badge-warning font-weight-100">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
                                            Actions <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if($invoice->status == 'unpaid')
                                                <a type="button" class="dropdown-item btn btn-primary btn-outline btn-reply"
                                                    href="{{ route('admin.invoice.pay', $invoice->id) }}"
                                                    onClick="return confirm('Are you sure you want to pay this invoice?');">
                                                    <i class="icon fa-money" aria-hidden="true" style="font-size: 15px;"></i> Pay
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Reply to Inquiry Modal -->
                <div class="modal fade update-modal" id="examplePositionCenter" aria-hidden="true" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-simple modal-center">
                        <form class="form-horizontal" action="{{ route('admin.booking.enquiry.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="e_id" value="">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">Respond to Inquiry</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-control-label">Upload File for Landlord</label>
                                        <input type="file" name="landlord_file_name" class="form-control" accept=".docx, .pdf">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Upload File for Tenant</label>
                                        <input type="file" name="tenant_file_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Update Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Please Choose</option>
                                            <option value="notapproved">Not Approved</option>
                                            <option value="approved">Approved</option>
                                            <option value="started">Started</option>
                                            <option value="end">Ended</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Modal -->

            </div>
        </div>
    </div>
</div>
<!-- End Page -->

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.table').dataTable();
    });
</script>
@endsection
