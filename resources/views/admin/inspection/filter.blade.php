@extends('layouts.admin')
@section('title')
  Inspections
@endsection
@section('style')
 <style>
    .btn-active {
    background-color: #762904;
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
          <li class="breadcrumb-item"><a href="#">Property</a></li>
          <li class="breadcrumb-item active">Inspections</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
          <!--  -->
    @if(session()->has('success'))
    <div class="alert alert-success mt-6">
        {{ session()->get('success')}}
    </div>
    @endif
    {{-- Card Start --}}
    <div class="card border card-primary">
        <div class="card-block">
            <div class="card-heading">
                <p class="card-heading">Filter</p>
                <form action="{{ route('admin.apply.inspection.filters') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col col-md-4">
                            <div class="form-group">
                                {{-- <label for="" class="form-control-label">Property</label> --}}
                                <select name="property" id="" class="form-control">
                                    <option value="">Filter By Property</option>
                                     @foreach (\App\Models\Properties::inspected_properties() as $property)
                                         <option value="{{ $property->inspectionable_id}}" @if(!empty($_GET["property"]) && $_GET["property"] == $property->inspectionable_id) selected @endif>{{ $property->title_en}}</option>
                                     @endforeach
                                </select>
                            </div>
                              
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                {{-- <label for="" class="form-control-label">Property</label> --}}
                                <select name="type" id="" class="form-control">
                                    <option value="">Filter By Inspection Type</option>
                                    <option value="Regular Inspection" @if (!empty($_GET["type"]) && $_GET["type"] == "Regular Inspection") selected @endif>Regular Inspection</option>
                                    <option value="Pre Inspection" @if (!empty($_GET["type"]) && $_GET["type"] == "Pre Inspection") selected @endif>Pre Inspection</option>
                                    <option value="Post Inspection" @if (!empty($_GET["type"]) && $_GET["type"] == "Post Inspection") selected @endif>Post Inspection</option>
                                </select>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <button type="submit" class="btn btn-primary btn-sm btn-outline">Apply Filters</button>
                            @if (!empty($_GET["property"]) || !empty($_GET["type"]))
                                <a type="button" href="{{ route('admin.all.inspections') }}" class="btn btn-info btn-sm btn-outline">Remove Filters</a>
                            @endif
                            
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th class="text-left">Property</th>
                        <th class="text-center">Inspection Date</th>
                        <th class="text-left">Inspection Type</th>
                        <th class="text-center">Inspector</th>
                        <th class="text-left">Inspection Note</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inspections as $inspection)
                        <tr>
                            <td>
                                @php $inspection_contents = \App\Models\InspectionContents::where('inspection_id',$inspection->id)->get(); @endphp 
                                 #{{ $inspection->inspection_code}}
                                </td>
                            <td class="text-left">
                                @php $tenant_contracts = \App\Models\TenantContracts::find($inspection->inspectionable_id);
                                
                                     $property = !empty($tenant_contracts) ? \App\Models\Properties::find($tenant_contracts->property_id) : null;
                                @endphp

                                {{ !empty($property) ? $property->title_en : ''}}
                            </td>
                            <td class="text-center">
                                {{ date_format(date_create($inspection->inspection_date),'d/m/Y')}}
                            </td>
                            <td class="text-left">
                                {{ $inspection->inspection_type}}
                            </td>
                            <td class="text-center">
                                @php $inspector = \App\Models\User::find($inspection->inspected_by);@endphp

                                {{!empty($inspector) ? $inspector->first_name." ".$inspector->last_name : '' }}
                            </td>
                            <td class="text-left">
                                {{ $inspection->inspection_notes}}
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                                
                                    @if (count($inspection_contents) > 0)
                                    <a type="button" class="dropdown-item btn btn-danger btn-outline"
                                    id="" href="{{ route('admin.inspection.contents',$inspection->id) }}" >
                                    <i class="icon fa-trash-o" aria-hidden="true" style="font-size: 15px;"></i>View Inspection Report</a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
            <br> 
        </div>
        </div>
    </div>
    {{-- Card End --}}
 </div>
</div>
@endsection
@section('script')
<script src="{{ asset('backend/custom/script.js') }}"></script>
<script>
 $(document).ready(function() {
    $('.table').dataTable();
 });
</script>


@endsection