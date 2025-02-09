@extends('layouts.admin')
@section('title')
  Inspections
@endsection
@section('style')
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
    
        
        <!-- Start -->
        
        <!-- Row Start -->
        <div class="row">
        <!-- First Column -->
            <div class="col col-md-3">
            <div class="card border border-primary">
                <div class="card-block">
                    <p class="card-title">
                        Inspection Report
                    </p>
                    <div class="card-text">
                        <div class="form-group">
                            
                            <a type="button" href="" class="btn btn-primary" style="width:100%">All Inspections</a>
                        </div>
                        <div class="form-group">
                            
                            <a type="button" href="" class="btn btn-primary" style="width:100%">Pre Inspection</a>
                        </div>
                        <div class="form-group">
                           
                            <a type="button" href="" class="btn btn-primary" style="width:100%">Regular Inspection</a>
                        </div>
                        <div class="form-group">
                            
                            <a type="button" href="" class="btn btn-primary" style="width:100%">End Inspection</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <!-- End First Column -->
        <!-- Second Column -->
            <div class="col col-md-9">
                <div class="card border card-primary">
                    <div class="card-block">
                        <p class="card-title">
                         Contract Code: <span class="text-info">{{ $tenant_contract->contract_code}}</span> <br> 
                         Property : <span class="text-info">{{ $tenant_contract->property->title_en}}</span> <br> 
                         Location : <span class="text-info">{{ $tenant_contract->property->street_address}}</span>
                        </p>
                        <div class="card-text">
                            <div class="d-flex justify-content-end mb-2">
                            <a href="{{ url('/admin/inspections/store') }}" data-id="{{ $tenant_contract->id}}" class="btn btn-primary float-right btn-store-inspection"><i class="icon wb-plus-circle"></i>Create Inspection</a>
                        </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th class="text-center">Inspection Date</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inspections as $inspection)
                                     <tr>
                                        <td>{{ $inspection->inspection_code}}</td>
                                        <td class="text-center">{{ date_format(date_create($inspection->inspection_date),'d-m-Y')}}</td>
                                        <td class="text-center">{{ $inspection->inspection_type}}</td>
                                        <td class="text-center">
                                            @php $inspection_contents = \App\Models\InspectionContents::where('inspection_id',$inspection->id)->get(); @endphp
                                            @if(count($inspection_contents) == 0)
                                           <!-- <a type="button" href="{{ url('/admin/inspections/update/'.$inspection->id) }}" class="btn btn-primary btn-outline btn-sm btn-update-inspection" data-insptype="{{ $inspection->inspection_type}}" data-insdate="{{ $inspection->inspection_date }}" data-assignto="{{ $inspection->inspected_by }}" data-note="{{ $inspection->inspection_notes }}" data-enquiryid="{{$tenant_contract->id }}"><i class="icon fa-pencil" aria-hidden="true" style="font-size: 15px;"></i> Edit</a>
                                            <a type="button" href="{{ route('admin.landlord.delete',$inspection->id) }}" class="btn btn-danger btn-outline btn-sm" onClick="return confirm(`Are you sure to Delete the Record ? `);"><i class="icon fa-trash" aria-hidden="true" style="font-size: 15px;"></i> Delete</a>
                                           -->



                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                            <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                                            
                                                <a type="button" class="dropdown-item btn btn-primary btn-outline btn-sm btn-update-inspection"
                                                data-insptype="{{ $inspection->inspection_type}}" data-insdate="{{ $inspection->inspection_date }}" data-assignto="{{ $inspection->inspected_by }}" data-note="{{ $inspection->inspection_notes }}" data-enquiryid="{{$tenant_contract->id }}"
                                                href="{{ url('/admin/inspections/update/'.$inspection->id) }}">
                                                    <i class="icon fa-pencil" aria-hidden="true" style="font-size: 15px;"></i>Edit</a>
                                                    
                                                <a type="button" class="dropdown-item btn btn-danger btn-outline"
                                                id="" href="{{ route('admin.landlord.delete',$inspection->id) }}" onClick="return confirm(`Are you sure to Delete the Record ? `);">
                                                <i class="icon fa-trash-o" aria-hidden="true" style="font-size: 15px;"></i>Delete</a>

                                            </div>



                                            @else 
                                           <!-- <a type="button" href="{{ route('admin.inspection.contents',$inspection->id) }}" class="btn btn-primary btn-outline btn-sm btn-round" ><i class="icon fa-eye" aria-hidden="true" style="font-size: 15px;"></i> View Cotents</a> -->


                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                            <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                                            
                                                
                                                <a type="button" class="dropdown-item btn btn-danger btn-outline"
                                                id="" href="{{ route('admin.inspection.contents',$inspection->id) }}" >
                                                <i class="icon fa-trash-o" aria-hidden="true" style="font-size: 15px;"></i>View Inspection Report</a>

                                            </div>

                                            @endif




                                           


                                            
                                        </td>
                                     </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                            <br> 
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Second Column -->
        </div>
        <!-- Row End -->
 </div>
</div>
<!-- End Page -->
 <!-- Create Inspection Modal Start -->
<div class="modal fade create-inspection-modal" id="examplePositionTop" aria-hidden="true" aria-labelledby="examplePositionTop" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-top">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
         <span class="modal-title">Create New Inspection</span>
        </h4>
        </div>
        <form class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" action="" method="post">
         @csrf 
         {{-- <input type="hidden" name="id" value="{{ $tenant_contract->id }}"> --}}
         <input type="hidden" name="enquiry_id" value="{{ $tenant_contract->id }}">
         <div class="modal-body">
            <div class="form-group">
                <label for="" class="form-control-label">Inspection Type</label>
                <select name="inspection_type" data-fv-notempty="true" id="" class="form-control">
                    <option value="">Please Choose</option>
                    <option value="Pre Inspection">Pre Inspection</option>
                    <option value="Regular Inspection">Regular Inspection</option>
                    <option value="Post Inspection">Post Inspection</option>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-control-label">Inspection Date-</label>
                <input type="date" name="inspection_date" id="" class="form-control" data-fv-notempty="true">
            </div>
             <div class="form-group">
                <label for="" class="form-control-label">Assign To</label>
                <select name="inspected_by" data-fv-notempty="true" id="" class="form-control">
                    <option value="">Please Choose</option>
                    @php $inspectors = \App\Models\User::wherein('role',['inspector'])->with(['country','province'])->get();
                    @endphp
                    @foreach($inspectors as $inspector)
                      <option value="{{ $inspector->id }}">{{ $inspector->first_name." ".$inspector->last_name }}</option>
                    @endforeach
                </select>
            </div>
           <div class="form-group">
            <label for="" class="form-control-label">Notes</label>
             <textarea name="inspection_notes" id="" class="form-control"></textarea>
           </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-save">Create</button>
        </div>
        </form>
        
    </div>
    </div>
</div>
  <!-- End Inspection Modal -->
@endsection
@section('script')
<script src="{{ asset('backend/custom/script.js') }}"></script>
<script>
 $(document).ready(function() {
    $('.table').dataTable();
 });
</script>


@endsection