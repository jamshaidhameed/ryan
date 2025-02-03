@extends('layouts.admin')
@section('title')
  Inspection Detail
@endsection
@section('style')
<style>
    .card-title img{
        width: 73px;
        margin-top: -21px;
    }
    .width-48 {
       width: 48rem;
    }
</style>
@endsection
@section('content')
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Property Features </a></li>
          <li class="breadcrumb-item active">list</li>
        </ol>
        
    </div>
  <div class="page-content">
    <!-- Card Start -->
    <div class="card border border-primary">
        <div class="card-block">
            <div class="card-title">
                <div class="row">
                    <div class="col col-md-6">
                        <img src="{{ asset('front/assets/img/logo.png') }}" alt=""> <br> 
                        <h6><strong>{{ strtoupper('Inspection type')}}</strong></h6>
                        <p>{{ strtoupper($inspection->inspection_type)}}</p>
                        <p>Inspection Code: <strong>{{ $inspection->inspection_code}}</strong></p>
                    </div>
                    <div class="col col-md-6">
                        <p class="text-right reg-title">Legal Registeration No : <strong>123</strong></p>
                        <p class="text-right p-email">Email: <strong>info@rayanrent.nl</strong></p>
                        <p class="text-right p-website">Website: <a href="{{ url('/') }}" class="text-primary">{{ url('/')}}</a></p>
                        <p class="text-right p-contact">Contact No : <strong>06 82 746 368</strong></p>
                    </div>
                </div>
            </div>
            <!-- Card Text Start -->
             <div class="card-text">
                 <h4><strong>{{ strtoupper('Property: '.$tenant_contract->property->title_en)}}</strong></h4>
                 <p class="font-weight-bold">General</p>
                 <table class="table table-striped table-hover mb-50">
                        <tbody>
                            <tr>
                                <td>Tenant</td>
                                <td class="text-center">{{ ucwords($tenant_contract->tenant->first_name." ".$tenant_contract->tenant->last_name) }}</td>
                            </tr>
                            <tr>
                                <td>Landlord</td>
                                <td class="text-center">
                                    @php $landlord = \App\Models\User::find($tenant_contract->property->user_id);@endphp
                                    {{ !empty($landlord) ? $landlord->first_name." ".$landlord->last_name : ''}}
                                </td>
                            </tr>
                             <tr>
                                <td>Rental Period</td>
                                <td class="text-center">{{ date_format(date_create($tenant_contract->start_from),'m-Y')}} / {{ date_format(date_create($tenant_contract->expired_at),'m-Y')}}</td>
                            </tr>
                             <tr>
                                <td>Number of Persons in Contract</td>
                                <td class="text-center">{{ $tenant_contract->persons }}</td>
                            </tr>
                             <tr>
                                <td>Number of Persons in Actual</td>
                                <td class="text-center">{{ $tenant_contract->persons }}</td>
                            </tr>
                             <tr>
                                <td>Inspector</td>
                                <td class="text-center">{{ !empty($inspection->inspector) ? ucwords($inspection->inspector->first_name." ".$tenant_contract->tenant->last_name) : '' }}</td>
                            </tr>
                             <tr>
                                <td>Inspection Date</td>
                                <td class="text-center">{{ date_format(date_create($inspection->inspection_date),'d-m-Y') }}</td>
                            </tr>
                             <tr>
                                <td>Address</td>
                                <td class="text-center">{{ !empty($tenant_contract->property) ? $tenant_contract->property->street_address : '' }}</td>
                            </tr>
                             <tr>
                                <td>Property Code</td>
                                <td class="text-center">{{ !empty($tenant_contract->property) ? $tenant_contract->property->property_code : '' }}</td>
                            </tr>
                            <tr>
                                <td>Property Type</td>
                                <td class="text-center">{{ !empty($tenant_contract->property->type->name) ? $tenant_contract->property->type->name : '' }}</td>
                            </tr>
                            
                        </tbody>
                     </table>
                   <!-- First Section Start -->
                    <table class="table table-striped table-hover mb-50">
                            <tbody>
                                <tr>
                                    <th  class="font-weight-bold" colspan="2">Electric Meter</th>
                                </tr>
                                <tr>
                                    <td class="width-48">Electra 1 / Electra 2</td>
                                    <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Electric Meter', 'name' => 'Electra 1 / Electra 2'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">Gas / Water</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Electric Meter', 'name' => 'Gas / Water'])->first();
                                        @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">Room Temperature(set)</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Electric Meter', 'name' => 'Room Temperature(set)'])->first();
                                        @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">City heating / Hot water m3</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Electric Meter', 'name' => 'City heating / Hot water m3'])->first();
                                        @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">Particularities</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Electric Meter', 'name' => 'Particularities'])->first();
                                        @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                </tr>
                                <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Electric Meter'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                
                            </tbody>
                        </table>
                    <!-- End First Section -->
                     <!-- Section Section -->
                      <table class="table table-striped table-hover mb-50">
                        <tbody>
                            <tr>
                                <th class="font-weight-bold" colspan="2">Key Management</th>
                            </tr>
                            <tr>
                                <td class="width-48">Number of keys received in total number</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Key Management', 'name' => 'Number of keys received in total number'])->first();
                                        @endphp
                                    {{ !empty($electra) ? $electra->value : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Keys received tenants</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Key Management', 'name' => 'Keys received tenants'])->first();
                                        @endphp
                                    {{ !empty($electra) ? $electra->value : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Owned by the tenants</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Key Management', 'name' => 'Owned by the tenants'])->first();
                                        @endphp
                                    {{ !empty($electra) ? $electra->value : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Number of keys owned by united homes / Staff housing</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Key Management', 'name' => 'Number of keys owned by united homes / Staff housing'])->first();
                                        @endphp
                                    {{ !empty($electra) ? $electra->value : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Number of keys missing waste card necessary</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Key Management', 'name' => 'Number of keys missing waste card necessary'])->first();
                                        @endphp
                                    {{ !empty($electra) ? $electra->value : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Comments</td>
                                <td class="text-center">
                                  @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Key Management', 'name' => 'Comments'])->first();
                                        @endphp
                                    {{ !empty($electra) ? $electra->value : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Key Management'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                     <!-- End Section -->
                      <!-- Start Third Section -->
                       <table class="table table-striped table-hover mb-50">
                        <tbody>
                            <tr>
                                <th class="font-weight-bold" colspan="2">Entrance / Hallway</th>
                            </tr>
                            <tr>
                                <td class="width-48">General Impression tided up /cleaned up</td>
                                <td class="text-center">
                                    
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Entrance / Hallway', 'name' => 'General Impression tided up /cleaned up'])->first();
                                        @endphp
                                       {{ !empty($electra) ? $electra->value : '' }}
                                        <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                   
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Condition floor/wall/ceiling</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Entrance / Hallway', 'name' => 'Condition floor/wall/ceiling'])->first();
                                        @endphp
                                       {{ !empty($electra) ? $electra->value : '' }}
                                        <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Condition windows/doors</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Entrance / Hallway', 'name' => 'Condition windows/doors'])->first();
                                        @endphp
                                       {{ !empty($electra) ? $electra->value : '' }}
                                        <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Functioning lighting</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Entrance / Hallway', 'name' => 'Functioning lighting'])->first();
                                        @endphp
                                       {{ !empty($electra) ? $electra->value : '' }}
                                        <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="width-48">Prticularities</td>
                                <td class="text-center">
                                    @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Entrance / Hallway', 'name' => 'Prticularities'])->first();
                                        @endphp
                                       {{ !empty($electra) ? $electra->value : '' }}
                                        
                                </td>
                            </tr>
                            <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Entrance / Hallway'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                       <!-- End Third Section -->
                        <!-- Fourth Section Start -->
                          <table class="table table-striped table-hover mb-50">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold" colspan="2">Living/Room 1</th>
                                    </tr>
                                    <tr>
                                        <td class="width-48">General Impression tided up /cleaned up</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1', 'name' => 'General Impression tided up /cleaned up'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                            <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Condition floor/wall/ceiling</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1', 'name' => 'Condition floor/wall/ceiling'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                            <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Condition windows/doors</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1', 'name' => 'Condition windows/doors'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                            <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Functioning lighting</td>
                                        <td class="text-center">
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1', 'name' => 'Functioning lighting'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                            <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Prticularities</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1', 'name' => 'Prticularities'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                    </tr>
                                    
                                <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                            </table>
                        <!-- End Fourth Section -->
                         <!-- Fifth Section -->
                          <table class="table table-striped table-hover mb-50">
                            <tbody>
                                <tr>
                                    <th class="font-weight-bold" style="width: 44rem;">Living/Room 1 Inventory</th>
                                    <th class="font-weight-bold">number damage</th>
                                    <th class="font-weight-bold">united homes number</th>
                                </tr>
                                <tr>
                                    <td class="width-48">Dining Chairs</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Dining Chairs'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Dining Chairs'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Couch</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Couch'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Couch'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">Arm Chair</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Arm Chair'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Arm Chair'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">Coffe table</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Coffe table'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Coffe table'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">Extra furniture</td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Extra furniture'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                    <td class="text-center">
                                         @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Extra furniture'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">Television</td>
                                    <td class="text-center">
                                         @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Television'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                    <td class="text-center">
                                         @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Television'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-48">Internet/Password</td>
                                    <td class="text-center">
                                         @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Internet/Password'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                    </td>
                                    <td class="text-center">
                                        @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory', 'name' => 'Internet/Password'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                    </td>
                                </tr>
                                <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Living/Room 1 Inventory'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                            </table>
                          <!-- End Fifth Section -->
                           <!-- sixth Section -->
                            <table class="table table-striped table-hover mb-50">
                                    <tbody>
                                        <tr>
                                            <th class="font-weight-bold" colspan="3">
                                                Bedroom 1
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Window Size</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'Window Size'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">General Impression tided up /cleaned up</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'General Impression tided up /cleaned up'])->first();
                                            @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'General Impression tided up /cleaned up'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Condition floor/wall/ceiling</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'Condition floor/wall/ceiling'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }} 
                                            </td>
                                            <td>
                                                   @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'Condition floor/wall/ceiling'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Condition windows/doors</td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'Condition windows/doors'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }} 
                                            </td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'Condition windows/doors'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }} 
                                                    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Functioning Lighting</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'Functioning Lighting'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }} 
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1', 'name' => 'Functioning Lighting'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                            </td>
                                        
                               <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                            <!-- End Section Section -->
                             <!-- Seventh Section -->
                              <table class="table table-striped table-hover mb-50">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold" style="width: 44rem;">Bedroom 1 Inventory</th>
                                        <th class="font-weight-bold">number damage</th>
                                        <th class="font-weight-bold">united homes number</th>
                                    </tr>
                                    <tr>
                                        <td class="width-48"> Bed</td>
                                        <td class="text-center">
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Bed'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Bed'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Duvet/Pillow</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Duvet/Pillow'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Duvet/Pillow'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Bedding/Bedsheets/Molton</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Bedding/Bedsheets/Molton'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Bedding/Bedsheets/Molton'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Lockable wardrobe</td>
                                        <td class="text-center">
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Lockable wardrobe'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Lockable wardrobe'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Lockable wardrobe size</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Lockable wardrobe size'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Lockable wardrobe size'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Nightstand/Night light</td>
                                        <td class="text-center">
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Nightstand/Night light'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory', 'name' => 'Nightstand/Night light'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 1 Inventory'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                             </table>
                              <!-- End Seventh Section -->
                               <!-- Eight Section -->
                                <table class="table table-striped table-hover mb-50">
                                    <tbody>
                                        <tr>
                                            <th class="font-weight-bold" colspan="3">
                                                Bedroom 2
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Window Size</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'Window Size'])->first();
                                               @endphp
                                            {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">General Impression tided up /cleaned up</td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'General Impression tided up /cleaned up'])->first();
                                               @endphp
                                               {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'General Impression tided up /cleaned up'])->first();
                                               @endphp
                                               {{ !empty($electra) ? $electra->comment : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="with-48">Condition floor/wall/ceiling</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'Condition floor/wall/ceiling'])->first();
                                               @endphp
                                               {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                            <td>
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'Condition floor/wall/ceiling'])->first();
                                                   @endphp
                                               {{ !empty($electra) ? $electra->comment : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Condition windows/doors</td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'Condition windows/doors'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                            <td>
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'Condition windows/doors'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Functioning Lighting</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'Functioning Lighting'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                            <td>
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2', 'name' => 'Functioning Lighting'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                            </td>
                                        </tr>
                                <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                                <!-- Eight Secntion End -->
                                <!-- Nine Section  -->
                                 <table class="table table-striped table-hover mb-50">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold" style="width: 44rem;">Bedroom 2 Inventory</th>
                                        <th class="font-weight-bold">number damage</th>
                                        <th class="font-weight-bold">united homes number</th>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Bed</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Bed'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Bed'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Duvet/Pillow</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Duvet/Pillow'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Duvet/Pillow'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Bedding/Bedsheets/Molton</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Bedding/Bedsheets/Molton'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Bedding/Bedsheets/Molton'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Lockable wardrobe</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Lockable wardrobe'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Lockable wardrobe'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Lockable wardrobe size</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Lockable wardrobe size'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Lockable wardrobe size'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Nightstand/Night light</td>
                                        <td class="text-center">
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Nightstand/Night light'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory', 'name' => 'Nightstand/Night light'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                               <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Bedroom 2 Inventory'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                             </table>
                                 <!-- End Nine Section -->
                                  <!-- tenth Section -->
                                    <table class="table table-striped table-hover mb-50">
                                    <tbody>
                                        <tr>
                                            <th  class="font-weight-bold" colspan="2">Kitchen 1</th>
                                        </tr>
                                        <tr>
                                            <td class="width-48">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1', 'name' => 'General Impression tided up /cleaned up'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1', 'name' => 'Condition floor/wall/ceiling'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Condition windows/doors</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1', 'name' => 'Condition windows/doors'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-44">Functioning lighting</td>
                                            <td class="text-center">
                                              @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1', 'name' => 'Functioning lighting'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Prticularities</td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1', 'name' => 'Prticularities'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                               <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                            <!-- End Tenth Section -->
                            <!-- Eleventh Section -->
                             <table class="table table-striped table-hover mb-50">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold" style="width: 44rem;">Kitchen 1 Inventory</th>
                                        <th class="font-weight-bold">number damage</th>
                                        <th class="font-weight-bold">united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Refrigerator</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Refrigerator'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Refrigerator'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Freezer</td>
                                        <td class="text-center">
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Freezer'])->first();
                                                @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Freezer'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Microwave/Oven</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Microwave/Oven'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Microwave/Oven'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stove</td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Stove'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Stove'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Coffee machine/Kettle</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Coffee machine/Kettle'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Coffee machine/Kettle'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Sufficient Kitchen Inventory</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Sufficient Kitchen Inventory'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory', 'name' => 'Sufficient Kitchen Inventory'])->first();
                                            @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    
                                <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 1 Inventory'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                             </table>
                            <!-- End Section -->
                            <!-- 12th Section -->
                             <table class="table table-striped table-hover mb-50">
                                    <tbody>
                                        <tr>
                                            <th class="font-weight-bold" colspan="2">Kitchen 2</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2', 'name' => 'General Impression tided up /cleaned up'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width-48">Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2', 'name' => 'Condition floor/wall/ceiling'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2', 'name' => 'Condition windows/doors'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning lighting</td>
                                            <td class="text-center">
                                              @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2', 'name' => 'Functioning lighting'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                                <span class="ml-4">-  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ !empty($electra) ? $electra->comment : ''  }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2', 'name' => 'Prticularities'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                             <!-- End 12th section -->
                              <!-- Section -->
                               <table class="table table-striped table-hover mb-50">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold" style="width: 44rem;">Kitchen 2 Inventory</th>
                                        <th class="font-weight-bold">number damage</th>
                                        <th class="font-weight-bold">united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Refrigerator</td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Refrigerator'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Refrigerator'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Freezer</td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Freezer'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Freezer'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Microwave/Oven</td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Microwave/Oven'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Microwave/Oven'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stove</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Stove'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Stove'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coffee machine/Kettle</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Coffee machine/Kettle'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Coffee machine/Kettle'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sufficient Kitchen Inventory</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Sufficient Kitchen Inventory'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory', 'name' => 'Sufficient Kitchen Inventory'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    
                              <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Kitchen 2 Inventory'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                             </table>
                               <!-- End Section -->
                                <!-- Section -->
                                 <table class="table table-striped table-hover mb-50">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold" style="width: 44rem;" colspan="3">Bathroom 1</th>
                                    </tr>
                                    <tr>
                                     <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bathroom 1', 'name' => 'General Impression tided up /cleaned up'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                          <tr>
                                     <td style="width: 44rem;">Particularities
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bathroom 1', 'name' => 'Particularities'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-center">
                                            
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                                 <!-- End Section -->
                                  <!--  -->
                                 <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;" colspan="3">Bathroom 2</th>
                                    </tr>
                                    <tr>
                                     <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bathroom 2', 'name' => 'General Impression tided up /cleaned up'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                          <tr>
                                     <td style="width: 44rem;">Particularities
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Bathroom 2', 'name' => 'Particularities'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                              <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Bathroom 2'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                                </table>
                                 <!--  -->
                            <!--  -->
                             <table class="table table-striped table-hover mb-50">
                                    <tbody>
                                        <tr>
                                            <th class="font-weight-bold" colspan="2">Toilets 1</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 1', 'name' => 'General Impression tided up /cleaned up'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 1', 'name' => 'Condition floor/wall/ceiling'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 1', 'name' => 'Condition windows/doors'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning lighting</td>
                                            <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 1', 'name' => 'Functioning lighting'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 1', 'name' => 'Functioning lighting'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                            </td>
                                        </tr>
                               <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Toilets 1'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                            <!--  -->
                            <!--  -->
                            <table class="table table-striped table-hover mb-50">
                                    <tbody>
                                        <tr>
                                            <th class="font-weight-bold" colspan="2">Toilets 2</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 2', 'name' => 'General Impression tided up /cleaned up'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 2', 'name' => 'Condition floor/wall/ceiling'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-center">
                                                 @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 2', 'name' => 'Condition windows/doors'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning lighting</td>
                                            <td class="text-center">
                                              @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 2', 'name' => 'Functioning lighting'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Toilets 2', 'name' => 'Prticularities'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Toilets 2'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                            <!--  -->
                            <!--  -->
                             <table class="table table-striped table-hover mb-50">
                                    <tbody>
                                        <tr>
                                            <th class="font-weight-bold" colspan="2">Outside</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression garden/balcony/outside
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Outside', 'name' => 'General Impression garden/balcony/outside'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Garden furniture
                                            </td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Outside', 'name' => 'Garden furniture'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maintenance in order</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Outside', 'name' => 'Maintenance in order'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-center">
                                                @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Outside', 'name' => 'Prticularities'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                            </td>
                                        </tr>
                              <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Outside'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                            <!--  -->
                            <!--  -->
                            <table class="table table-striped table-hover mb-50">
                                <tbody>
                                    <tr>
                                        <th  class="font-weight-bold">Miscellaneous</th>
                                        <th class="font-weight-bold">number damage</th>
                                        <th class="font-weight-bold">united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Ironing board/iron</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Ironing board/iron'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Ironing board/iron'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Drying rack</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Drying rack'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Drying rack'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vacuum Cleaner</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Vacuum Cleaner'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Vacuum Cleaner'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Waste schedule available</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Waste schedule available'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Waste schedule available'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Miscellaneous cleaning articles</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Miscellaneous cleaning articles'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Miscellaneous cleaning articles'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Particularities</td>
                                        <td class="text-center">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous', 'name' => 'Particularities'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td class="text-center">
                                            
                                        </td>
                                    </tr>
                                    
                              <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Miscellaneous'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                            <!--  -->
                            <!--  -->
                            <table class="table table-striped table-hover mb-50">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold">Fire prevention</th>
                                        <th class="font-weight-bold">Number damage</th>
                                        <th class="font-weight-bold">inspected</th>
                                        <th class="font-weight-bold">inspection date</th>
                                        <th class="font-weight-bold">United homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Smoke alarm</td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Smoke alarm'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td>
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Smoke alarm'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Smoke alarm'])->first();
                                               @endphp
                                                {{ !empty($electra) ? date_format(date_create($electra->inspected_date),'d-m-Y') : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Smoke alarm'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->united_homes : '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Fire extinguisher</td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Fire extinguisher'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td>
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Fire extinguisher'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Fire extinguisher'])->first();
                                               @endphp
                                                {{ !empty($electra) ? date_format(date_create($electra->inspected_date),'d-m-Y') : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Fire extinguisher'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->united_homes : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fire blanket</td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Fire blanket'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td>
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Fire blanket'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Fire blanket'])->first();
                                               @endphp
                                                {{ !empty($electra) ? date_format(date_create($electra->inspected_date),'d-m-Y') : '' }}
                                        </td>
                                        <td>
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Fire blanket'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->united_homes : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Carbon monoxide detector</td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Carbon monoxide detector'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Carbon monoxide detector'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Carbon monoxide detector'])->first();
                                               @endphp
                                                {{ !empty($electra) ? date_format(date_create($electra->inspected_date),'d-m-Y') : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Carbon monoxide detector'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->united_homes : '' }}
                                            
                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>iP44 lamp</td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'iP44 lamp'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'iP44 lamp'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                        <td>
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'iP44 lamp'])->first();
                                               @endphp
                                                {{ !empty($electra) ? date_format(date_create($electra->inspected_date),'d-m-Y') : '' }}
                                        </td>
                                        <td>
                                             @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'iP44 lamp'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->united_homes : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>House rules available</td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'House rules available'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'House rules available'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->comment : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'House rules available'])->first();
                                               @endphp
                                                {{ !empty($electra) ? date_format(date_create($electra->inspected_date),'d-m-Y') : '' }}
                                        </td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'House rules available'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->united_homes : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Particularities</td>
                                        <td  colspan="">
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention', 'name' => 'Particularities'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                               <tr>
                                <td>Images</td>
                                <td colspan="4">
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Fire prevention'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                            </table>
                            <!--  -->
                        <!--  -->
                         <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold">Heating system</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <tr>
                                        <td class="width-48">Heating type</td>
                                        <td>
                                            @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Heating system', 'name' => 'Heating type'])->first();
                                               @endphp
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                    </tr>
                                      <tr>
                                        <td class="width-48">Date yearly check up</td>
                                        <td>
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Heating system', 'name' => 'Date yearly check up'])->first();@endphp
                                                {{ !empty($electra) ? date_format(date_create($electra->value),'d-m-Y') : '' }}
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="width-48">Bar Cv</td>
                                        <td>
                                           @php $electra = \App\Models\InspectionContents::where(['inspection_id' => $inspection->id,'title' => 'Heating system', 'name' => 'Bar Cv'])->first();
                                               @endphp
                                                
                                                {{ !empty($electra) ? $electra->value : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                <td>Images</td>
                                <td>
                                    @php $images = \App\Models\InspectionFiles::where(['inspection_id' => $inspection->id,'title' => 'Heating system'])->get();
                                    @endphp

                                    @if(count($images) > 0)
                                     <div class="row">
                                        @foreach($images as $img)
                                           <div class="col col-sm-3">
                                           <a href="{{ asset('upload/inspection/'.$img->file_url) }}"> <img src="{{ asset('upload/inspection/'.$img->file_url) }}" class="rounded img-thumbnail" alt="Image 1"></a>
                                           </div>
                                        
                                        @endforeach
                                     </div>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                            </table>
                        <!--  -->
             </div>
             <!-- End Card Text -->
        </div>
    </div>
    <!-- Card End -->
  </div>
</div>
@endsection