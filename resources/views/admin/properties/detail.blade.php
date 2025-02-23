@extends('layouts.admin')
@section('title')
  Property Details
@endsection
@section('style')
<style>
    .tb-contract{
        border: none;
    }
    .tb-contract,.tb-contract tbody tr td {
        border: 2px dotted gray;
    }
    .btn {
        margin-bottom:5px;
    }
</style>
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Property </a></li>
          <li class="breadcrumb-item active">Details</li>
        </ol>
        
      </div>

    <div class="page-content container-fluid">
         @if(session()->has('success'))
        <div class="alert alert-success mt-6">
            {{ session()->get('success')}}
        </div>
        @endif
        <div class="row">
            <!-- First Column -->
            <div class="col col-md-4">
                <div class="card border border-primary">
                    <div class="card-block">
                        <h3 class="card-title">{{ $property->title_en }}</h3>
                        <input type="hidden" name="contract_period" value="{{ $property->contract_period }}">
                        <input type="hidden" name="start_from" value="{{ $property->available_from }}">
                        <input type="hidden" name="price" value="{{ $property->price }}">
                        <div class="card-text">

                        @php $property_image = !empty($property->property_image) ? explode(",",$property->property_image)[0] : ''; @endphp

                        <img src="{{ asset('upload/property/'.$property_image) }}" alt="" class="img-rounded img-bordered img-bordered-primary" style="width: 338px;"> <br>
                        <h4 class="text-primary">Price : {{ number_format($property->price,2) }}</h4>
                        <p>{{ $property->street_address}}</p>
                        <div class="d-flex justify-content-start mb-2">
                        @if($property->status == 1)
                         <a href="{{ route('admin.properties.approve',[$property->id,0]) }}" class="btn btn-warning float-right" onClick="return confirm(`{{ __ ('Are you sure to Un Publish the property ? ')}}`);"><i class="icon wb-rubber"></i>Un Publish</a>
                        @else 
                         <a href="{{ route('admin.properties.approve',[$property->id,1]) }}" class="btn btn-success float-right" onClick="return confirm(`{{ __ ('Are you sure to Publish the property ? ')}}`);"><i class="icon wb-check-circle"></i>Publish</a>
                        @endif
                        <a href="{{ route('admin.property.edit',$property->id) }}" class="btn btn-success" style="margin-left:5px;"><i class="icon wb-pencil"></i>Edit</a>
                        </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- End First Column -->
             <!-- Second Column -->
            <div class="col col-md-8">
                <div class="card border border-primary">
                    <div class="card-block">
                        <div class="card-title text-center">
                            <strong>Landlord Contract</strong> 
                            <div class="d-flex justify-content-end">
                                <a target="_blank" href="{{ route('admin.landlord.contracts',$property->id) }}" style="margin-top: -22px;">All Contracts</a>
                            </div>
                        </div>
                        
                        <hr>
                      <div class="card-text">
                         @if(!empty($landlord_contract))
                         <!-- Contract Detail Table Start -->
                          <table class="table table-bordered tb-contract">
                                <tbody>
                                    <tr>
                                        <td class="text-left">Landlord Contract Code</td>
                                        <td class="text-right">{{ $landlord_contract->contract_code}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Contract Period</td>
                                        <td class="text-right">{{ $landlord_contract->contract_period}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Expires At</td>
                                        <td class="text-right">

                                          <span style="margin-right: 216px;"><strong>{{ date_format(date_create($landlord_contract->expired_at),'d-m-Y')}}</strong></span>
                                         @php 
                                         
                                         $date = \Carbon\Carbon::now(); 
                                         $expiry_date = date_format(date_create($landlord_contract->expired_at),'Y-m-d H:i:s');

                                         $diff = $date->diff($expiry_date);

                                         $years = $diff->y;
                                         $months = $diff->m;
                                         $days = $diff->d;

                                         $human_readable = "{$years} years,{$months} months, {$days} from now";

                                         if($years == 0 ){

                                            $human_readable = "{$months} month".($months > 1 ? 's' : '')." from now";
                                         }else if($years == 0 && $days == 0 && $months == 0){

                                            $human_readable = "today";
                                         }

                                         
                                         @endphp
                                             
                                        <span class="badge badge-danger">{{ $human_readable }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Contract Signed</td>
                                        <td class="text-right">{{ !empty($landlord_contract->signed_at) ? 'Yes' : 'No'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                             
                             <div class="row">
                                <div class="col">
                                    <a href="{{ asset('upload/booking/'.$landlord_contract->link) }}" class="">Download Contract</a><span class="line-space">|</span> 
                                    <a href="{{ route('admin.landlord.invoices',$landlord_contract->id) }}" class="landlord-invoices" data-paymentroute="{{ url('/admin/landlord/invoice/pay/')}}">Invoices</a> <span class="line-space">|</span> 
                                    <a href="" class="btn-landlord-terminate" data-id="{{ $landlord_contract->id}}">Terminate Contract</a>
                                
                                </div>
                                
                            </div>
                          <!-- Contract Detail Table End -->
                          @else 
                           <p>No active contract found! <a href="" class="landlord-contract" data-id="{{ $property->id }}" data-price="{{ $property->price }}">Genereate new Contract</a></p>
                        @endif
                      </div>
                    </div>
                </div>
                <!-- Tenant Card Start -->
                  <div class="card border border-primary">
                    <div class="card-block">
                        <div class="cart-title text-center">
                            <strong>Tenant Contract</strong>
                            <div class="d-flex justify-content-end">
                                <a target="_blank" href="{{ route('admin.tenant.contracts',$property->id) }}" style="margin-top: -22px;">All Contracts</a>
                            </div>
                        </div>
                        <hr>
                        <!-- Cart Body -->
                         <div class="card-text">
                            <input type="hidden" name="getpropertyurl" value="{{ url('/admin/property/enquiry/') }}">
                            @if(!empty($tenant_contract))

                            <table class="table table-bordered tb-contract">
                                <tbody>
                                    <tr>
                                        <td class="text-left">Tenant Contract Code</td>
                                        <td class="text-right">{{ $tenant_contract->contract_code}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Contract Period</td>
                                        <td class="text-right">{{ $tenant_contract->contract_period}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Expires At</td>
                                        <td class="text-right">

                                          <span style="margin-right: 216px;"><strong>{{ date_format(date_create($tenant_contract->expired_at),'d-m-Y')}}</strong></span>
                                         @php 
                                         
                                         $date = \Carbon\Carbon::now(); 
                                         $expiry_date = date_format(date_create($tenant_contract->expired_at),'Y-m-d H:i:s');

                                         $diff = $date->diff($expiry_date);

                                         $years = $diff->y;
                                         $months = $diff->m;
                                         $days = $diff->d;

                                         $human_readable = "{$years} years,{$months} months, {$days} from now";

                                         if($years == 0 ){

                                            $human_readable = "{$months} month".($months > 1 ? 's' : '')." from now";
                                         }else if($years == 0 && $days == 0 && $months == 0){

                                            $human_readable = "today";
                                         }

                                         
                                         @endphp
                                             
                                        <span class="badge badge-danger">{{ $human_readable }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Contract Signed</td>
                                        <td class="text-right">{{ !empty($tenant_contract->signed_at) ? 'Yes' : 'No'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                             
                             <div class="row">
                                <div class="col">
                                    <a href="{{ asset('upload/booking/'.$tenant_contract->link) }}" class="">Download Contract</a> <span class="line-space">|</span> 
                                   <a href="{{ route('admin.issue.tickets',$tenant_contract->id)}}" class="">Issue Tickets</a><span class="line-space">|</span> 
                                   <a href="{{ route('admin.booking.tenant.invoices',$tenant_contract->id) }}" class="btn-invoices" data-paymentroute="{{ url('/admin/booking/tenant/invoices/pay/')}}">Invoices</a><span class="line-space">|</span> 
                                   <a href="" class="btn-commision-details" data-verified="{{ !empty($tenant_contract->commission_verified_by) ? 'yes' : 'no' }}" data-id="{{ $tenant_contract->id }}" data-amount="{{ $tenant_contract->commission_amount}}">Commission Details</a><span class="line-space">|</span> 

                                   <a href="{{ route('admin.property.enquiries',$property->id) }}" class="tenant-quries" data-selected="1" data-getpropertyurl="{{ url('/admin/property/enquiry/') }}">Tenant Quries</a><span class="line-space">|</span> 

                                   <a href="" class="btn-tenant-terminate"  data-id="{{ $tenant_contract->id}}">Terminate Contract</a><span class="line-space">|</span> 

                                   <a target="_blank" href="{{ route('admin.inspections.list',$tenant_contract->id) }}" class="">Inspections</a>
                                </div>
                                
                            </div>
                            @else 
                            <p>No active contract found! <a href="{{ route('admin.property.enquiries',$property->id) }}" class="tenant-quries" data-selected="0">View Tenant Quries</a></p>
                            @endif
                            
                         </div>
                         <!-- End Cart Body -->
                    </div>
                  </div>
                 <!-- End Tenant Card -->
            </div>
            <!-- End Second Column -->
        </div>
    </div>
  </div>
</div>
<!-- End Page -->
 <!-- Tenant Quries Modal -->
<div class="modal fade example-modal-lg tent-modal" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="exampleOptionalLarge">Tenant Quries</h4>
        </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
  <!-- End Tenant Quries Modal -->
   <div class="modal fade tent-contract" id="examplePositionTop" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-top">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
             <h4 class="modal-title" id="exampleModalTitle" style="margin-right: 76%;">Tenant Contract</h4>
            <hr>
        </div>
            <div class="modal-body">
               <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ route('admin.property.tenant.booking.start') }}" method="post">
                 @csrf 
                 <input type="hidden" name="e_id" value="">
                 <input type="hidden" name="property_id" value="">
                 <input type="hidden" name="tenant_id" value="">
                 <div class="row">
                    <!-- First Column -->
                    <div class="col col-md-6">
                        <div class="form-group">
                            <label for="" class="form-control-label">Contract Period</label>
                            <input type="number" name="contract_period" id="" class="form-control" value="" min="0" data-fv-notempty="true">
                        </div>
                         <div class="form-group">
                            <label for="" class="form-control-label">Price</label>
                            <input type="number" name="price" id="" class="form-control" value="" min="0" data-fv-notempty="true">
                        </div>
                         <div class="form-group">
                            <label for="" class="form-control-label">No. of persons</label>
                            <input type="number" name="persons" id="" class="form-control" value="" min="0" data-fv-notempty="true">
                        </div>
                        <div class="form-group">
                             <input type="checkbox" data-plugin="switchery" data-color="#f26928" name="commision_paid" value="1" /> Commision Paid
                        </div>
                    </div>
                    <!-- End First Column -->
                     <!-- Second Column -->
                      <div class="col col-md-6">
                        <div class="form-group">
                            <label for="" class="form-control-label">Start Date</label>
                            <input type="date" name="start_from" id="" class="form-control" value="" data-fv-notempty="true">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Commission Amount</label>
                            <input type="number" name="commission_amount" id="" class="form-control" value="" min="0" data-fv-notempty="true">
                        </div>
                      </div>
                      <!-- End Second Column -->
                 </div>
                 <p class="text-primary">User will be created with the following details!</p>
                 <hr>
                 <div class="row">
                    <div class="col col-md-6">
                        <div class="form-group">
                            <label for="" class="form-control-label">First Name <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" class="form-control" name="first_name" value="" data-fv-notempty="true">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Email <span class="text-danger"><sup>*</sup></span></label>
                            <input type="email" class="form-control" name="email" value="" data-fv-notempty="true">
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-group">
                            <label for="" class="form-control-label">Last Name <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" class="form-control" name="last_name" value="" data-fv-notempty="true">
                        </div>
                         <div class="form-group">
                            <label for="" class="form-control-label">Phone <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" class="form-control" name="phone" value="" data-fv-notempty="true">
                        </div>
                    </div>
                 </div>
                 <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-outline">Book Property</button>
                    <label for="" class="text-danger msg"></label>
                 </div>
                 
               </form>
            </div>
        </div>
    </div>
</div>
<!-- Tenant Contract Modal -->

 <!-- Invoices Modal -->
<div class="modal fade example-modal-lg invoices-modal" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="exampleOptionalLarge">Invoices</h4>
        </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Month</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
  <!-- End Invoices Modal -->

  <!-- Landlord Contract Modal Start -->
   <div class="modal fade landlord-contract-modal" id="examplePositionTop" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-top">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
         Landlord Contract
        </h4>
        </div>
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ route('admin.landlord.contract.start') }}" method="post">
         @csrf 
         <input type="hidden" name="prop_id" value="">
         <div class="modal-body">
         <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="" class="form-control-label">Contract Period</label>
                    <input type="number" name="contract_period" id="" class="form-control" min="0" data-fv-notempty="true">
                </div>

                <div class="form-group">
                    <label for="" class="form-control-label">Price</label>
                    <input type="number" name="price" id="" class="form-control" data-fv-notempty="true">
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="" class="form-control-label">Start Date</label>
                    <input type="date" name="start_from" id="" class="form-control" data-fv-notempty="true">
                </div>
            </div>
         </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Start Contract</button>
        </div>
        </form>
        
    </div>
    </div>
</div>
  <!-- Landlord Contract Modal End -->

  <!-- Landlord Invoices Modal -->
   <div class="modal fade example-modal-lg landlord-invoices-modal" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="exampleOptionalLarge">Invoices</h4>
        </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Month</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Landlord Invoices -->

<!-- Tenant Contract Termination -->
 <div class="modal fade tenant-terminate" id="examplePositionTop" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-top">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
         Tenant Contract Termination
        </h4>
        </div>
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ route('admin.tenant.contract.terminate') }}" method="post">
         @csrf 
         <input type="hidden" name="e_id" value="">
         <div class="modal-body">
           <div class="form-group">
            <label for="" class="form-control-label">Termination Reason</label>
            <textarea name="termination_reason" id="" class="form-control" data-fv-notempty="true"></textarea>
           </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Terminate</button>
        </div>
        </form>
        
    </div>
    </div>
</div>
 <!-- End Tenant -->

 <!-- Landlord Contract Termination -->
  <div class="modal fade landlord-terminate" id="examplePositionTop" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-top">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
         Landlord Contract Termination
        </h4>
        </div>
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ route('admin.landlord.contract.terminate') }}" method="post">
         @csrf 
         <input type="hidden" name="e_id" value="">
         <div class="modal-body">
           <div class="form-group">
            <label for="" class="form-control-label">Termination Reason</label>
            <textarea name="termination_reason" id="" class="form-control" data-fv-notempty="true"></textarea>
           </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Terminate</button>
        </div>
        </form>
        
    </div>
    </div>
</div>
 <!-- End Landlord -->

<!-- Commision Detail -->
 <div class="modal fade commision-details" id="examplePositionTop" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-top">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
         Commission Details
        </h4>
        </div>
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="{{ route('admin.commission.pay') }}" method="post">
         @csrf 
         <input type="hidden" name="e_id" value="">
         <div class="modal-body">
           <div class="form-group">
            <label for="" class="form-control-label">Commission Amount</label>
             <input type="number" name="amount" id="" class="form-control" min="0" value="" data-fv-notempty="true">
           </div>
           <label for="" class="form-control-label">Payment Status: <span id="payment-status"></span></label>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-commision">Pay</button>
        </div>
        </form>
        
    </div>
    </div>
</div>
 <!-- End Commision Detail -->
@endsection
@section('script')
<script src="{{ asset('backend/custom/script.js') }}"></script>
<!-- Tenant Quries Get -->
<script>
    
</script>
<!-- End Tenant Quries -->
@endsection