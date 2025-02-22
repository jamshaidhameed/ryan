@extends('technician.layouts.master') 
@section('title')
 Inspections List
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>My Profile</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home')}}</a></li>
                <li class="">{{ __('Inspections List') }}</li>
            </ul>
        </div>
    </div>
</div>
<div class="user-page content-area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="user-profile-box mrb">
                    <!--header -->
                  @include('technician.layouts.sidebar')
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="my-address contact-2">
                    @php $user = Auth::user(); @endphp
                    <h3 class="heading-3">{{ __('Inspections List')}}</h3>
                    <!-- Table Start -->
                     <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Inspection Code</th>
                                <th class="text-center">Inspection Type</th>
                                <th class="text-left">Property</th>
                                <th class="text-left">Address</th>
                                <th class="text-left">Inspection Date</th>
                                <th class="text-left">Notes</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inspections_list as $inspection)

                             @php $tenant_contract = \App\Models\TenantContracts::find($inspection->inspectionable_id);
                                  $property = !empty($tenant_contract) ? \App\Models\Properties::find($tenant_contract->property_id) : null;
                                $inspection_contents = \App\Models\InspectionContents::where('inspection_id',$inspection->id)->get();
                             @endphp
                             <tr>
                                <td>{{ $inspection->inspection_code}}</td>
                                <td>{{ $inspection->inspection_type}}</td>
                                <td>
                                    {{ !empty($property) ? $property->title_en : ''}}
                                </td>
                                <td>{{ !empty($property) ? $property->street_address : ''}}</td>
                                <td>{{ date_format(date_create($inspection->inspection_date),'d/m/Y')}}</td>
                                <td>{{ $inspection->notes }}</td>
                                <td>
                                    @if($inspection->is_ready == 1)
                                     <span class="badge badge-success font-weight-100">Done</span>
                                    @else 
                                     <span class="badge badge-danger font-weight-100">Inspection Needed</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i> Inspect</a> --}}
                                    

                                     <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                                    
                                        <a type="button" class="dropdown-item"
                                            id="" href="{{ route('technision.take.inspections',$inspection->id) }}">
                                            <i class="fa fa-pencil" aria-hidden="true" style="font-size: 15px;"></i> Inspect</a>
                                        @if(count($inspection_contents) > 0)
                                     <a target="_blank" href="{{ route('technision.inspection.download',$inspection->id) }}"  class="dropdown-item"><i class="fa fa-download"></i> Download</a>
                                    @endif
                                    </div>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                     </table>
                    <!-- Table End -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection