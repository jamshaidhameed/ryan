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
                </tr>
            </thead>
            <tbody>
                @foreach($tenant_contracts as $rented)
                 <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.property.details',!empty($rented->property) ? $rented->property->slug : 'NA') }}">#{{ $rented->contract_code}}</a>
                    </td>
                    <td class="text-left">{{ !empty($rented->property) ? $rented->property->title_en : ''}}</a></td>
                    <td class="text-left">{{ !empty($rented->property) ? $rented->property->street_address : ''}}</td>
                    <td class="text-center">{{ !empty($rented->tenant->first_name) ? $rented->tenant->first_name." ".$rented->tenant->last_name : '' }}</td>
                    <td class="text-center">
                        @if(!empty($rented->property->user_id))
                            @php $landlord = \App\Models\User::find($rented->property->user_id); @endphp

                           {{ !empty($landlord) ? $landlord->first_name." ".$landlord->last_name : ''}}
                        @endif
                    </td>
                    <td class="text-center">{{ $rented->contract_period}}</td>
                    <td class="text-center">
                        {{ date_format(date_create($rented->expired_at),'d/m/Y') }}
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