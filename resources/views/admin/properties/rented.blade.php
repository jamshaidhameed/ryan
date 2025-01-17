@extends('layouts.admin')
@section('title')
 Rented Properties
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Rented Properties </a></li>
          <li class="breadcrumb-item active">list</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Rented Properties</h3>
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
                    <th>Title (eng)</th>
                    <th>Location</th>
                    <th class="text-center">Tenant</th>
                    <th class="text-center">Landlord</th>
                    <th class="text-center">Period</th>
                    <th class="text-center">Expired At</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tenant_contracts as $rented)
                 <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.property.details',$rented->slug) }}">#{{ $rented->contract_code}}</a>
                    </td>
                    <td class="text-left">{{ $rented->title_en }}</a></td>
                    <td class="text-left">{{ $rented->location }}</td>
                    <td class="text-center">{{ $rented->tenant }}</td>
                    <td class="text-center">
                        {{ $rented->landlord}}
                    </td>
                    <td class="text-center">{{ $rented->contract_period}}</td>
                    <td class="text-center">
                        {{ date_format(date_create($rented->expired_at),'d/m/Y') }}
                    </td>
                    <td>
                      @php $expired_at =date_format(date_create($rented->expired_at),'Y-m-d');
                      @endphp

                      @if(date('Y-m-d') > $expired_at && empty($rented->terminated_on))
                        <span class="badge badge-danger font-weight-100">Expired</span>
                      @elseif(!empty($rented->terminated_on))
                        <span class="badge badge-danger font-weight-100">Terminated</span>
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
@endsection
@section('script')
<script>
 $(document).ready(function() {
    $('.table').dataTable();
 });
</script>
@endsection