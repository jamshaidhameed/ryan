@extends('layouts.admin')
@section('title')
  Tenant Contract List
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Tenant Contracts </a></li>
          <li class="breadcrumb-item active">list</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Property Code: <span class="">{{ $property->property_code}}</span> <br><br>
                                  Property Title: <span class="">{{ $property->title_en }}</span>

          </h3>
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
                    <th class="text-center">Code</th>
                    <th>Start From</th>
                    <th class="text-center">Contract Period</th>
                    <th class="text-center">Expired At</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tenant_contracts as $contract)
                <tr>
                    <td class="text-center"># {{ $contract->contract_code }}</td>
                    <td>{{ date_format(date_create($contract->start_from),'d/m/Y')}}</td>
                    <td class="text-center">{{ $contract->contract_period }}</td>
                    <td class="text-center">{{ date_format(date_create($contract->expired_at),'d/m/Y')}}</td>
                    <td class="text-center">
                    @php $expired_at =date_format(date_create($contract->expired_at),'Y-m-d');
                      @endphp

                      @if(date('Y-m-d') > $expired_at && empty($contract->terminated_on))
                        <span class="badge badge-danger font-weight-100">Expired</span>
                      @elseif(!empty($contract->terminated_on))
                        <span class="badge badge-danger font-weight-100">Terminated</span> <br>
                        <a href="" class="reason-btn" data-resean="{{ $contract->termination_reason }}" data-terminatedon="{{ date_format(date_create($contract->terminated_on),'Y-m-d H:i:s') }}">View reason </a>
                      @else 

                      <span class="badge badge-success font-weight-100">Active</span>

                      @endif
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
  <!-- Delete Model is Start Here -->
<div class="modal fade terminate-reason" id="examplePositionCenter" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                    <h4 class="modal-title">Terminate Reason</h4>
                    </div>
                    <div class="modal-body">
                       <p class="reason-text"></p>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
        </form>
    </div>
<!-- Model End  -->
@endsection
@section('script')
<script src="{{ asset('backend/custom/script.js') }}"></script>
<script>
 $(document).ready(function() {
    $('.table').dataTable();
 });
</script>
@endsection