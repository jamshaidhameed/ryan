@extends('technician.layouts.master') 
@section('title')
  Inspection
@endsection
@section('style')
 <link rel="stylesheet" href="{{ asset('backend/global/vendor/toastr/toastr.min599c.css?v4.0.2') }}">

  <!-- Page -->
<link rel="stylesheet" href="{{ asset('backend/assets/examples/css/advanced/toastr.min599c.css?v4.0.2') }}">
<link rel="stylesheet" href="{{ asset('backend/global/vendor/bootstrap-sweetalert/sweetalert.min599c.css?v4.0.2') }}">
<style>
    .card-primary .card-title {
        background-color:#D3D3D3;
        padding:2rem;
    }
    .card-title img{
        width: 73px;
        /* margin-top: -21px; */
    }
    .width-32{
        width: 40rem;
    }
    .img-thumbnail{
        width:120px;
    }
    .sm-width {
        width:70%;
    }
    
</style>
<!-- <style>
    .card-title img{
        width: 73px;
        margin-top: -21px;
    }
    .card-title .reg-title {
        margin-top: -8px;
        margin-right: 8px;
    }
    .card-title .p-email{
        margin-right: 23px;
        margin-top: -12px;
    }
    .card-title .p-website{
        margin-top: -17px;
        margin-top: -12px;
    }
    .card-title .p-contact {
        margin-top: -12px;
        margin-right: 12px;
    }
    table tbody tr td{
        font-size:12pt;
        line-height:2px;
    }
    table tbody tr td .form-group {
        margin-bottom: -2px;
    }
    .form-one table tbody tr td .form-group .form-control {
        width: 359px;
        margin-left: 44rem;
        height: 31px;
        font-size:9pt;
    }
    .form-two table tbody tr td .form-group .form-control {
        width: 331px;
        margin-left: 32rem;
        height: 31px;
        font-size:9pt;
    }
    table tbody tr td textarea {
        height: 55px;
        margin-right: 98px;
        width: 21rem;
        padding: 16px 3px;
    }
     .form-three table tbody tr td .form-group .form-control {
        width: 176px;
        margin-left: 32rem;
        height: 31px;
        font-size:9pt;
     }
     .form-three table tbody tr td textarea{
        height: 32px;
        margin-right: 98px;
        width: 15rem;
        padding: 16px 3px;
        margin-left: 7px;
     }

     .living-one-inventory table tbody tr td .form-group .form-control {
        height: 31px;
        width: 256px;
     }
     .bedroom-one table tbody tr td .form-group .form-control{
        height: 31px;
        width:256px;
        font-size:9pt;
     }
     .form-kitchen-one-inventory table tbody tr td .form-control {
        width: 16rem;
        height: 38px;
        font-size: 9pt;
     }

     .fire-prevent table tbody tr td,.fire-prevent table tbody tr td .form-control {
        width: 16rem;
        font-size: 9pt;

     }
    
    .table td {
        vertical-align: middle;
    }
    .justify-content-end{
       margin-right: 122px;
    }

</style> -->
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Inspection</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home')}}</a></li>
                <li class="">{{ __('Inspection') }}</li>
            </ul>
        </div>
    </div>
</div>
<div class="user-page content-area-2">
    <div class="container">
        <!-- Start -->
          <div class="card-primary">
            <div class="card-body">
                <div class="card-title">
                    <!-- Row Start -->
                      <div class="row">
                        <!-- First Column -->
                          <div class="col col-md-6">
                            <img src="{{ asset('front/assets/img/logo.png') }}" alt=""> <br> 
                            <h6><strong>{{ strtoupper('Inspection type')}}</strong></h6>
                            <p>{{ strtoupper($inspection->inspection_type)}}</p>
                            <p>Inspection Code: <strong>{{ $inspection->inspection_code}}</strong></p>
                          </div>
                         <!-- End Column -->
                          <!-- Second Column -->
                           <div class="col col-md-6">
                                <p class="text-center reg-title">Legal Registeration No : <strong>123</strong></p>
                                <p class="text-center p-email">Email: <strong>info@rayanrent.nl</strong></p>
                                <p class="text-center p-website">Website: <a href="{{ url('/') }}" class="text-primary">{{ url('/')}}</a></p>
                                <p class="text-center p-contact">Contact No : <strong>06 82 746 368</strong></p>
                           </div>
                           <!-- End Second Column -->
                      </div>
                     <!-- Row End -->
                </div>
                <!-- Card Text Start -->
                 <div class="card-text">
                    <hr>
                    <h4>{{ strtoupper('Property: '.$tenant_contract->property->title_en)}}</h4>
                    <p><strong>General</strong></p>
                    <!-- Table Start -->
                     <table class="table">
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
                     <!-- End Table -->
                      @php $old_inspection = \App\Models\Inspections::where('inspectionable_id',$inspection->inspectionable_id)->orderBy('id','DESC')->first();
                         
                      @endphp
                      <!-- First Form -->
                       <form action="{{ route('technision.inspection.form.submit') }}" class="post-form" method="post"  enctype="multipart/form-data">
                          @csrf 
                          <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                          <input type="hidden" name="title" value="Electric Meter">
                          <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="2">Electric Meter</th>
                                </tr>
                                <tr>
                                    <td class="width-32">Electra 1 / Electra 2</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Electric Meter','name' => 'Electra 1 / Electra 2'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Electra 1 / Electra 2">
                                            <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                </tr><tr>
                                        <td class="width-32">Gas / Water</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Electric Meter','name' => 'Gas / Water'])->first() : null;
                                            @endphp
                                                <input type="hidden" name="name[]" value="Gas / Water">
                                                <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-32">Room Temperature(set)</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Electric Meter','name' => 'Room Temperature(set)'])->first() : null;
                                            @endphp
                                                 <input type="hidden" name="name[]" value="Room Temperature(set)">
                                                <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-32">City heating / Hot water m3</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Electric Meter','name' => 'City heating / Hot water m3'])->first() : null;
                                               @endphp
                                                <input type="hidden" name="name[]" value="City heating / Hot water m3">
                                                <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-32">Particularities</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Electric Meter','name' => 'Particularities'])->first() : null;
                                               @endphp
                                                <input type="hidden" name="name[]" value="Particularities">
                                                <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-32">Images</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                                
                                                 @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Electric Meter'])->get() : array();
                                                 $image_array = array();
                                               @endphp
                                               @foreach($images as $img)
                                                 @php array_push($image_array,$img->file_url); @endphp
                                               @endforeach

                                               
                                               
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <input type="hidden" name="selected_images" value="" id="first">
                                @if(count($image_array) > 0)
                                
                                 <button class="btn btn-default first-btn-view mr-4">Choose from Existing Images</button>
                                @endif
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <!-- Images Model Start -->
                          <div class="modal fade book-d first-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-first-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Electric Meter'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                         <!-- Images End Model -->
                       <!-- End First Form -->
                        <!-- Second Form Start -->
                         <br>
                         <form action="{{ route('technision.inspection.form.submit') }}" class="post-form" method="post"  enctype="multipart/form-data">
                          @csrf 
                          <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                          <input type="hidden" name="title" value="Key Management">
                          <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="2">Key Management</th>
                                    </tr>
                                    <tr>
                                        <td>Number of keys received in total number</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Key Management','name' => 'Number of keys received in total number'])->first() : null;
                                            @endphp
                                                <input type="hidden" name="name[]" value="Number of keys received in total number">
                                                <input type="number" name="value[]" id="" class="form-control" min="0" value="{{ !empty($value) ? $value->value : '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keys received tenants</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                 @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Key Management','name' => 'Keys received tenants'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Keys received tenants">
                                                <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Owned by the tenants</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                 @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Key Management','name' => 'Owned by the tenants'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Owned by the tenants">
                                                <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Number of keys owned by united homes / Staff housing</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                 @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Key Management','name' => 'Number of keys owned by united homes / Staff housing'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Number of keys owned by united homes / Staff housing">
                                                <input type="number" min="0" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Number of keys missing waste card necessary</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Key Management','name' => 'Number of keys missing waste card necessary'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Number of keys missing waste card necessary">
                                                <input type="number" min="0" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Key Management','name' => 'Comments'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Comments" cols="20" rows = "10">
                                               <textarea name="value[]" id=""  class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->value }}
                                                @endif
                                               </textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <input type="hidden" id="second-images" name="selected_images" >
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Key Management'])->get() : array();
                                    $image_array = array();
                                @endphp
                                @foreach($images as $img)
                                    @php array_push($image_array,$img->file_url); @endphp
                                @endforeach
                                @if(count($image_array) > 0)
                                
                                 <button class="btn btn-default second-btn-view mr-4">Choose from Existing Images</button>
                                @endif
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                        <!-- Images Model Start -->
                          <div class="modal fade book-d second-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-second-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Key Management'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-second-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                         <!-- End Second Form -->
                          <!-- Third Form Start -->
                           <br>
                        <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                          @csrf 
                          <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                          <input type="hidden" name="title" value="Entrance / Hallway">
                          <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="3">Entrance / Hallway</th>
                                    </tr>
                                    <tr>
                                        <td >General Impression tided up /cleaned up</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                 @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Entrance / Hallway','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                  {{ $value->comment}}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition floor/wall/ceiling</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Entrance / Hallway','name' => 'Condition floor/wall/ceiling'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                  {{ $value->comment}}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition windows/doors</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Entrance / Hallway','name' => 'Condition windows/doors'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Condition windows/doors">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                   <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                  {{ $value->comment}}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Functioning lighting</td>
                                        <td class="text-center">
                                           <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Entrance / Hallway','name' => 'Functioning lighting'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Functioning lighting">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td> 
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                  {{ $value->comment}}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prticularities</td>
                                        <td></td>
                                        <td class="text-center" colspan="1">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Entrance / Hallway','name' => 'Prticularities'])->first() : null;
                                                @endphp
                                                <input type="hidden" name="name[]" value="Prticularities">
                                               <textarea name="value[]" id="" class="form-control " wrap="hard">
                                                 @if(!empty($value))
                                                  {{ $value->value}}
                                                @endif
                                               </textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-center">
                                          <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Entrance / Hallway'])->get() : array();
                                    $image_array = array();
                                @endphp
                                @foreach($images as $img)
                                    @php array_push($image_array,$img->file_url); @endphp
                                @endforeach
                                <input type="hidden" id="thid-images" name="selected_images" >
                                @if(count($image_array) > 0)
                                
                                 <button class="btn btn-default third-btn-view mr-4">Choose from Existing Images</button>
                                @endif
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <!-- Images Model Start -->
                          <div class="modal fade book-d third-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-third-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Entrance / Hallway'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-third-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                           <!-- End Third Form -->
                            <br>
                        <!-- Fourth Form Starts -->
                        
                        <!-- Fourth Form End -->
                 </div>
                 <!-- Fourth Form Start -->
                  <br>
                  <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                          @csrf 
                          <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                          <input type="hidden" name="title" value="Living/Room 1">
                          <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="3">Living/Room 1</th>
                                    </tr>
                                    <tr>
                                        <td>General Impression tided up /cleaned up</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->comment }}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition floor/wall/ceiling</td>
                                        <td class="text-center">
                                            <div class="form-group text-center">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1','name' => 'Condition floor/wall/ceiling'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->comment }}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition windows/doors</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1','name' => 'Condition windows/doors'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Condition windows/doors">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->comment }}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Functioning lighting</td>
                                        <td class="text-center">
                                           <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1','name' => 'Functioning lighting'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Functioning lighting">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->comment }}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prticularities</td>
                                        <td></td>
                                        <td class="text-center">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1','name' => 'Prticularities'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Prticularities">
                                            <div class="form-group">
                                               <textarea name="value[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->value }}
                                                @endif
                                               </textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-center">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1'])->get() : array();
                                    $image_array = array();
                                @endphp
                                @foreach($images as $img)
                                    @php array_push($image_array,$img->file_url); @endphp
                                @endforeach
                                <input type="hidden" id="fourth-images" name="selected_images" >
                                @if(count($image_array) > 0)
                                
                                 <button class="btn btn-default fourth-btn-view mr-4">Choose from Existing Images</button>
                                @endif
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                         </form>
                   <!-- Images Model Start -->
                          <div class="modal fade book-d fourth-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-fourth-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-fourth-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                  <!-- Fourth Form End -->
                   <br>
                   <!-- Fifth Form Start  -->
                    <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Living/Room 1 Inventory">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Living/Room 1 Inventory</th>
                                    <th>number damage</th>
                                    <th>united homes number</th>
                                </tr>
                                <tr>
                                    <td>Dining Chairs</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory','name' => 'Dining Chairs'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Dining Chairs">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Couch</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory','name' => 'Couch'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Couch">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Arm Chair</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory','name' => 'Arm Chair'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Arm Chair">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Coffe table</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory','name' => 'Coffe table'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Coffe table">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Extra furniture</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory','name' => 'Extra furniture'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Extra furniture">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Television</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory','name' => 'Television'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Television">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Internet/Password</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory','name' => 'Internet/Password'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Internet/Password">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Images</td>
                                    <td  class="text-center">
                                        <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                             <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory'])->get() : array();
                                    $image_array = array();
                                @endphp
                                @foreach($images as $img)
                                    @php array_push($image_array,$img->file_url); @endphp
                                @endforeach
                                <input type="hidden" id="fifth-images" name="selected_images" value="">
                                @if(count($image_array) > 0)
                                
                                 <button type="button" class="btn btn-default fifth-btn-view mr-4">Choose from Existing Images</button>
                                @endif
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                    </form>
                     <!-- Images Model Start -->
                          <div class="modal fade book-d fifth-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-fifth-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Living/Room 1 Inventory'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-fifth-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                   <!-- Fifth Form End -->
                    <!-- Sixth Form Start  -->
                     <br>
                     <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Bedroom 1">
                       <table class="table">
                        <tbody>
                            <tr>
                                <th colspan="3">
                                    Bedroom 1
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">Window Size</td>
                                <td class="text-center">
                                    <div class="form-group">
                                        @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1','name' => 'Window Size'])->first() : null;
                                        @endphp
                                        <input type="hidden" name="name[]" value="Window Size">
                                        <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        <input type="hidden" name="comment[]">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>General Impression tided up /cleaned up</td>
                                <td class="text-center">
                                    <div class="form-group">
                                        @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                        @endphp
                                        <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                        <select name="value[]" id="" class="form-control sm-width">
                                            <option value="">Select</option>
                                            <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                            <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-group">
                                        <textarea name="comment[]" id="" class="form-control">
                                            @if(!empty($value))
                                             {{ $value->comment}}
                                            @endif
                                        </textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Condition floor/wall/ceiling</td>
                                <td class="text-center">
                                    <div class="form-group">
                                         @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1','name' => 'Condition floor/wall/ceiling'])->first() : null;
                                        @endphp
                                        <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                        <select name="value[]" id="" class="form-control sm-width">
                                            <option value="">Select</option>
                                            <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                            <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea name="comment[]" id="" class="form-control">
                                             @if(!empty($value))
                                             {{ $value->comment}}
                                            @endif
                                        </textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Condition windows/doors</td>
                                <td class="text-center">
                                    <div class="form-group">
                                        @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1','name' => 'Condition windows/doors'])->first() : null;
                                        @endphp
                                        <input type="hidden" name="name[]" value="Condition windows/doors">
                                        <select name="value[]" id="" class="form-control sm-width">
                                            <option value="">Select</option>
                                            <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                            <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea name="comment[]" id="" class="form-control">
                                            @if(!empty($value))
                                             {{ $value->comment}}
                                            @endif
                                        </textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Functioning Lighting</td>
                                <td class="text-center">
                                    <div class="form-group">
                                         @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1','name' => 'Functioning Lighting'])->first() : null;
                                        @endphp
                                        <input type="hidden" name="name[]" value="Functioning Lighting">
                                        <select name="value[]" id="" class="form-control sm-width">
                                            <option value="">Select</option>
                                            <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                            <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea name="comment[]" id="" class="form-control">
                                            @if(!empty($value))
                                             {{ $value->comment}}
                                            @endif
                                        </textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <td>Images</td>
                            <td  class="text-center">
                              <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                        <div class="d-flex justify-content-end">
                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1'])->get() : array();
                                    $image_array = array();
                                @endphp
                                @foreach($images as $img)
                                    @php array_push($image_array,$img->file_url); @endphp
                                @endforeach
                                <input type="hidden" id="sixth-images" name="selected_images" value="">
                                @if(count($image_array) > 0)
                                
                                 <button type="button" class="btn btn-default sixth-btn-view mr-4">Choose from Existing Images</button>
                                @endif
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                    <!-- Images Model Start -->
                          <div class="modal fade book-d sixth-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-sixth-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-sixth-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                     <!-- End Sixth Form -->
                      <!-- Seventh Form -->
                       <br>
                       <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Bedroom 1 Inventory">
                          <table class="table">
                            <tbody>
                                <tr>
                                    <th>Bedroom 1 Inventory</th>
                                    <th>number damage</th>
                                    <th>united homes number</th>
                                </tr>
                                <tr>
                                    <td>Bed</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1 Inventory','name' => 'Bed'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Bed">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Duvet/Pillow</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1 Inventory','name' => 'Duvet/Pillow'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Duvet/Pillow">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bedding/Bedsheets/Molton</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1 Inventory','name' => 'Bedding/Bedsheets/Molton'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Bedding/Bedsheets/Molton">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lockable wardrobe</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1 Inventory','name' => 'Lockable wardrobe'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Lockable wardrobe">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lockable wardrobe size</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1 Inventory','name' => 'Lockable wardrobe size'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Lockable wardrobe size">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nightstand/Night light</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1 Inventory','name' => 'Nightstand/Night light'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Nightstand/Night light">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Images</td>
                                    <td  class="text-center">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="images/*">
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1 Inventory'])->get() : array();
                                    $image_array = array();
                                @endphp
                                @foreach($images as $img)
                                    @php array_push($image_array,$img->file_url); @endphp
                                @endforeach
                                <input type="hidden" id="seventh-images" name="selected_images" value="">
                                @if(count($image_array) > 0)
                                
                                 <button type="button" class="btn btn-default seventh-btn-view mr-4">Choose from Existing Images</button>
                                @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                        <!-- Images Model Start -->
                          <div class="modal fade book-d seventh-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-seventh-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 1 Inventory'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-seventh-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                       <!-- End Seventh Form -->
                        <br> 
                        <!-- Eighth Form  Start-->
                         <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                            @csrf 
                            <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                            <input type="hidden" name="title" value="Bedroom 2">
                           <table class="table">
                                    <tbody>
                                        <tr>
                                            <th colspan="3">
                                                Bedroom 2
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>Window Size</td>
                                            
                                            <td></td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                     @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2','name' => 'Window Size'])->first() : null;
                                                     @endphp
                                                    <input type="hidden" name="name[]" value="Window Size">
                                                    <input type="text" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                                    <input type="hidden" name="comment[]" value="{{ !empty($value) ? $value->comment : ''}}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>General Impression tided up /cleaned up</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                                     @endphp
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control sm-width">
                                                        <option value="">Select</option>
                                                        <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                        <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td  class="text-center">
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control">
                                                        @if(!empty($value))
                                                          {{ $value->comment }}
                                                        @endif
                                                    </textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2','name' => 'Condition floor/wall/ceiling'])->first() : null;
                                                     @endphp
                                                    <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                    <select name="value[]" id="" class="form-control sm-width">
                                                        <option value="">Select</option>
                                                        <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                        <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control">
                                                        @if(!empty($value))
                                                          {{ $value->comment }}
                                                        @endif
                                                    </textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2','name' => 'Condition windows/doors'])->first() : null;
                                                     @endphp
                                                    <input type="hidden" name="name[]" value="Condition windows/doors">
                                                    <select name="value[]" id="" class="form-control sm-width">
                                                        <option value="">Select</option>
                                                        <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                        <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control">
                                                        @if(!empty($value))
                                                          {{ $value->comment }}
                                                        @endif
                                                    </textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning Lighting</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                      @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2','name' => 'Functioning Lighting'])->first() : null;
                                                     @endphp
                                                    <input type="hidden" name="name[]" value="Functioning Lighting">
                                                    <select name="value[]" id="" class="form-control sm-width">
                                                        <option value="">Select</option>
                                                        <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                        <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control">
                                                        @if(!empty($value))
                                                          {{ $value->comment }}
                                                        @endif
                                                    </textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Images</td>
                                            <td  class="text-center">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                            </td>
                                            <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                 <div class="d-flex justify-content-end">
                                     @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="eight-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default eight-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        </form>
                        <!-- Images Model Start -->
                          <div class="modal fade book-d eight-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-eight-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-eight-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                         <!-- End Eighth Form -->
                          <br>
                    <!-- Ninth Form Start -->
                     <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Bedroom 2 Inventory">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Bedroom 2 Inventory</th>
                                    <th>number damage</th>
                                    <th>united homes number</th>
                                </tr>
                                <tr>
                                    <td>Bed</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2 Inventory','name' => 'Bed'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Bed">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Duvet/Pillow</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2 Inventory','name' => 'Duvet/Pillow'])->first() : null;
                                        @endphp
                                        <input type="hidden" name="name[]" value="Duvet/Pillow">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bedding/Bedsheets/Molton</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2 Inventory','name' => 'Bedding/Bedsheets/Molton'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Bedding/Bedsheets/Molton">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lockable wardrobe</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2 Inventory','name' => 'Lockable wardrobe'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Lockable wardrobe">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lockable wardrobe size</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2 Inventory','name' => 'Lockable wardrobe size'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Lockable wardrobe size">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nightstand/Night light</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2 Inventory','name' => 'Nightstand/Night light'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Nightstand/Night light">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Images</td>
                                    <td  class="text-center">
                                        <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                 @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2 Inventory'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="ninth-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default ninth-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                          <div class="modal fade book-d ninth-images" id="modal-info">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Select Existing Image Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div class="modal-body">
                                  <!-- Modal Body Start -->
                                     <table class="table table-bordered tbl-ninth-images">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S.No</th>
                                                <th class="text-center">Select</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bedroom 2 Inventory'])->get() : array();
                                               @endphp
                                            @foreach($images as $image)
                                             <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                   <!-- End Modal Body -->
                                </div>
                                <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-outline-light btn-ninth-select-images">Choose</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    <!-- End Ninth Form  -->
                     <br>
                     <!-- Tenth Form Start -->
                      <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Kitchen 1">
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="3">Kitchen 1</th>
                                    </tr>
                                    <tr>
                                        <td>General Impression tided up /cleaned up
                                        </td>
                                        <td  class="text-center">
                                            <div class="form-group">
                                                 @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->comment }}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition floor/wall/ceiling
                                        </td>
                                        <td  class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1','name' => 'Condition floor/wall/ceiling'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->comment }}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition windows/doors</td>
                                        <td  class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1','name' => 'Condition windows/doors'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Condition windows/doors">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            
                                                <textarea name="comment[]" id="" class="form-control">
                                                    @if(!empty($value))
                                                     {{ $value->comment }}
                                                    @endif
                                                </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Functioning lighting</td>
                                        <td  class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1','name' => 'Functioning lighting'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Functioning lighting">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            
                                                <textarea name="comment[]" id="" class="form-control">
                                                    @if(!empty($value))
                                                     {{ $value->comment }}
                                                    @endif
                                                </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prticularities</td>
                                            <td></td>
                                        <td  class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1','name' => 'Prticularities'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Prticularities">
                                            <textarea name="value[]" id="" class="form-control">
                                                @if(!empty($value))
                                                  {{ $value->value }}
                                                @endif
                                            </textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>Images</td>
                                    <td  class="text-center">
                                        <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                     @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="tenth-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default tenth-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                      </form>
                      <!-- Images Model Start -->
                        <div class="modal fade book-d tenth-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-tenth-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-tenth-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                     <!-- End Tenth Form -->
                      <!-- Eleventh Form Start -->
                      <br>
                        <form class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Kitchen 1 Inventory">
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Kitchen 1 Inventory</th>
                                        <th>number damage</th>
                                        <th>united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Refrigerator</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1 Inventory','name' => 'Refrigerator'])->first() : null;
                                                 @endphp
                                            <input type="hidden" name="name[]" value="Refrigerator">
                                            <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Freezer</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1 Inventory','name' => 'Freezer'])->first() : null;
                                                 @endphp
                                            <input type="hidden" name="name[]" value="Freezer">
                                            <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Microwave/Oven</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1 Inventory','name' => 'Microwave/Oven'])->first() : null;
                                                 @endphp
                                             <input type="hidden" name="name[]" value="Microwave/Oven">
                                            <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stove</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                 @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1 Inventory','name' => 'Stove'])->first() : null;
                                                 @endphp
                                             <input type="hidden" name="name[]" value="Stove">
                                            <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coffee machine/Kettle</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1 Inventory','name' => 'Coffee machine/Kettle'])->first() : null;
                                                 @endphp
                                            <input type="hidden" name="name[]" value="Coffee machine/Kettle">
                                            <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sufficient Kitchen Inventory</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1 Inventory','name' => 'Sufficient Kitchen Inventory'])->first() : null;
                                                 @endphp
                                              <input type="hidden" name="name[]" value="Sufficient Kitchen Inventory">
                                            <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : '' }}">
                                          </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control"  multiple="true"  accept="image/*">
                                        </td>
                                    </tr>
                                </tbody>
                             </table>
                             <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1 Inventory'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="eleventh-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default eleventh-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <!-- Images Model Start -->
                        <div class="modal fade book-d eleventh-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-eleventh-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 1 Inventory'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-eleventh-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                      <!-- Eleventh Form End -->
                      <br>
                    {{-- Twelth Form Start --}}
                     <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Kitchen 2">
                        <table class="table">
                                    <tbody>
                                        <tr>
                                            <th colspan="3">Kitchen 2</th>
                                        </tr>
                                        <tr>
                                            <td>General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                                    @endphp
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control sm-width">
                                                        <option value="">Select</option>
                                                        <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                        <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                    </select>
                                                    
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <textarea name="comment[]" id="" class="form-control">
                                                    @if(!empty($value))
                                                      {{ $value->comment }}
                                                    @endif
                                                </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2','name' => 'Condition floor/wall/ceiling'])->first() : null;
                                                    @endphp
                                                    <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                    <select name="value[]" id="" class="form-control sm-width">
                                                        <option value="">Select</option>
                                                        <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                        <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <textarea name="comment[]" id="" class="form-control">
                                                    @if(!empty($value))
                                                      {{ $value->comment }}
                                                    @endif
                                                </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2','name' => 'Condition windows/doors'])->first() : null;
                                                    @endphp
                                                    <input type="hidden" name="name[]" value="Condition windows/doors">
                                                    <select name="value[]" id="" class="form-control sm-width">
                                                        <option value="">Select</option>
                                                        <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                        <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <textarea name="comment[]" id="" class="form-control">
                                                    @if(!empty($value))
                                                      {{ $value->comment }}
                                                    @endif
                                                </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning lighting</td>
                                            <td class="text-right">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2','name' => 'Functioning lighting'])->first() : null;
                                                @endphp
                                                  <input type="hidden" name="name[]" value="Functioning lighting">
                                                    <select name="value[]" id="" class="form-control sm-width">
                                                        <option value="">Select</option>
                                                        <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                        <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <textarea name="comment[]" id="" class="form-control">
                                                    @if(!empty($value))
                                                      {{ $value->comment }}
                                                    @endif
                                                </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prticularities</td>
                                            <td></td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2','name' => 'Prticularities'])->first() : null;
                                                    @endphp
                                                    <input type="hidden" name="name[]" value="Prticularities">
                                                    <textarea name="value[]" id="" class="form-control">
                                                        @if(!empty($value))
                                                        {{ $value->comment }}
                                                        @endif
                                                    </textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            <div class="d-flex justify-content-end">
                                 @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="twelth-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default twelth-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                     </form>
                      <!-- Images Model Start -->
                        <div class="modal fade book-d twelth-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-twelth-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-twelth-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    {{-- End Twelth Form --}}
                    <br>
                    {{-- thirteen Form Start --}}
                    <form class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Kitchen 2 Inventory">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Kitchen 2 Inventory</th>
                                    <th>number damage</th>
                                    <th>united homes number</th>
                                </tr>
                                <tr>
                                    <td>Refrigerator</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2 Inventory','name' => 'Refrigerator'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Refrigerator">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Freezer</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2 Inventory','name' => 'Freezer'])->first() : null;
                                        @endphp
                                        <input type="hidden" name="name[]" value="Freezer">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Microwave/Oven</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2 Inventory','name' => 'Microwave/Oven'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Microwave/Oven">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stove</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2 Inventory','name' => 'Stove'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Stove">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Coffee machine/Kettle</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                             @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2 Inventory','name' => 'Coffee machine/Kettle'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Coffee machine/Kettle">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sufficient Kitchen Inventory</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2 Inventory','name' => 'Sufficient Kitchen Inventory'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Sufficient Kitchen Inventory">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Images</td>
                                    <td class="text-right">
                                        <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2 Inventory'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="thirteen-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default thirteen-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d thirteen-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-thirteen-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Kitchen 2 Inventory'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-thirteen-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    {{-- Thirdteen Form End --}}
                    <br>
                    {{-- Fourtheenth Form Start --}}
                    <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Bathroom 1">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="3">Bathroom 1</th>
                                </tr>
                                <tr>
                                    <td>General Impression tided up /cleaned up
                                        </td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                 @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bathroom 1','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->comment}}
                                                @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                        <tr>
                                    <td>Particularities
                                        </td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Particularities">
                                                 @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bathroom 1','name' => 'Particularities'])->first() : null;
                                                 @endphp
                                                <div class="form-group">
                                                    <textarea name="value[]" id="" class="form-control">
                                                        @if(!empty($value))
                                                         {{ $value->value }}
                                                        @endif

                                                    </textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>Images</td>
                                    <td class="text-right">
                                        <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bathroom 1'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="fourteen-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default fourteen-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d fourteen-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-fourteen-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bathroom 1'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-fourteen-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    {{-- End Fourtheenth Form --}}
                    <br>
                    {{-- Fifteenth Form Start --}}
                    <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Bathroom 2">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="3">Bathroom 2</th>
                                </tr>
                                <tr>
                                    <td>General Impression tided up /cleaned up
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bathroom 2','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                <select name="value[]" id="" class="form-control sm-width">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <textarea name="comment[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->comment}}
                                                 @endif
                                            </textarea>
                                        </td>
                                    </tr>
                                        <tr>
                                    <td>Particularities
                                        </td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Bathroom 2','name' => 'Particularities'])->first() : null;
                                                 @endphp
                                                <input type="hidden" name="name[]" value="Particularities">
                                                
                                                <div class="form-group">
                                                    <textarea name="value[]" id="" class="form-control">@If(!empty($value)) {{ $value->value }} @endif</textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>Images</td>
                                    <td class="text-right">
                                        <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                             <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bathroom 2'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="fifteen-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default fifteen-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d fifteen-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-fifteen-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Bathroom 2'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-fifteen-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    {{-- End Fifteenth Form --}}
                    <br>
                    {{-- sixteen Form Start --}}
                    <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Toilets 1">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="3">Toilets 1</th>
                                </tr>
                                <tr>
                                    <td>General Impression tided up /cleaned up
                                    </td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 1','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                                 @endphp
                                            <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                       <textarea name="comment[]" id="" class="form-control">
                                         @if(!empty($value))
                                          {{ $value->comment}}
                                        @endif
                                       </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Condition floor/wall/ceiling
                                    </td>
                                    <td class="text-right">
                                        <div class="form-group">
                                             @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 1','name' => 'Condition floor/wall/ceiling'])->first() : null;
                                                 @endphp
                                            <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                       <textarea name="comment[]" id="" class="form-control">
                                         @if(!empty($value))
                                          {{ $value->comment}}
                                        @endif
                                       </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Condition windows/doors</td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 1','name' => 'Condition windows/doors'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Condition windows/doors">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                       <textarea name="comment[]" id="" class="form-control">
                                         @if(!empty($value))
                                          {{ $value->comment}}
                                        @endif
                                       </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Functioning lighting</td>
                                    <td class="text-right">
                                    <div class="form-group">
                                         @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 1','name' => 'Functioning lighting'])->first() : null;
                                         @endphp
                                        <input type="hidden" name="name[]" value="Functioning lighting">
                                        <select name="value[]" id="" class="form-control sm-width">
                                            <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                        </select>
                                    </div>
                                    </td>
                                    <td class="text-center">
                                       <textarea name="comment[]" id="" class="form-control">
                                         @if(!empty($value))
                                          {{ $value->comment}}
                                        @endif
                                       </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prticularities</td>
                                    <td class="text-center" colspan="2">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 1','name' => 'Prticularities'])->first() : null;
                                         @endphp
                                            <input type="hidden" name="name[]" value="Prticularities">
                                        <textarea name="value[]" id="" class="form-control">@if(!empty($value)) {{ $value->value }} @endif</textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>Images</td>
                                <td class="text-right">
                                    <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 1'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="sixteen-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default sixteen-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d sixteen-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-sixteen-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 1'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-sixteen-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    {{-- sixteen Form End --}}
                    <br>
                    {{-- Seventeen Form --}}
                    <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Toilets 2">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="3">Toilets 2</th>
                                </tr>
                                <tr>
                                    <td>General Impression tided up /cleaned up
                                    </td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 2','name' => 'General Impression tided up /cleaned up'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <textarea name="comment[]" id="" class="form-control">
                                            @if(!empty($value))
                                             {{ $value->comment}}
                                            @endif
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Condition floor/wall/ceiling
                                    </td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 2','name' => 'Condition floor/wall/ceiling'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <textarea name="comment[]" id="" class="form-control">
                                            @if(!empty($value))
                                             {{ $value->comment}}
                                            @endif
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Condition windows/doors</td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 2','name' => 'Condition windows/doors'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Condition windows/doors">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <textarea name="comment[]" id="" class="form-control">
                                            @if(!empty($value))
                                             {{ $value->comment}}
                                            @endif
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Functioning lighting</td>
                                    <td class="text-right">
                                    <div class="form-group">
                                        @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 2','name' => 'Functioning lighting'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Functioning lighting">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <textarea name="comment[]" id="" class="form-control">
                                            @if(!empty($value))
                                             {{ $value->comment}}
                                            @endif
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prticularities</td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 2','name' => 'Prticularities'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Prticularities">
                                        <textarea name="value[]" id="" class="form-control">@if(!empty($value)) {{ $value->value }}@endif</textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>Images</td>
                                <td class="text-right">
                                    <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                      <div class="d-flex justify-content-end">
                            @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 2'])->get() : array();
                                $image_array = array();
                                @endphp
                                @foreach($images as $img)
                                    @php array_push($image_array,$img->file_url); @endphp
                                @endforeach
                                <input type="hidden" id="seventeen-images" name="selected_images" value="">
                                @if(count($image_array) > 0)
                                
                                <button type="button" class="btn btn-default seventeen-btn-view mr-4">Choose from Existing Images</button>
                                @endif
                        <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d seventeen-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-seventeen-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Toilets 2'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-seventeen-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <br>
                    {{-- End Seventeen Form --}}
                    {{-- Eighteen Form Start --}}
                    <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Outside">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="3">Outside</th>
                                </tr>
                                <tr>
                                    <td>General Impression garden/balcony/outside
                                    </td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Outside','name' => 'General Impression garden/balcony/outside'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="General Impression garden/balcony/outside">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <textarea name="comment[]" id="" class="form-control">@if(!empty($value)) {{ $value->comment }} @endif</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Garden furniture
                                    </td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Outside','name' => 'Garden furniture'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Garden furniture">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <textarea name="comment[]" id="" class="form-control">@if(!empty($value)) {{ $value->comment }} @endif</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maintenance in order</td>
                                    <td class="text-right">
                                        <div class="form-group">
                                             @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Outside','name' => 'Maintenance in order'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Maintenance in order">
                                            <select name="value[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <textarea name="comment[]" id="" class="form-control">@if(!empty($value)) {{ $value->comment }} @endif</textarea>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Prticularities</td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Outside','name' => 'Prticularities'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Prticularities">
                                        <textarea name="value[]" id="" class="form-control">
                                            @if(!empty($value))
                                             {{ $value->value }}
                                            @endif
                                        </textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>Images</td>
                                <td class="text-right">
                                    <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                     <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Outside'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="eighteen-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default eighteen-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d eighteen-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-eighteen-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Outside'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-eighteen-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <br>
                    {{-- Eighteen Form End --}}
                    {{-- Ninteen Form Start --}}
                    <form class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Miscellaneous">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Miscellaneous</th>
                                    <th>number damage</th>
                                    <th>united homes number</th>
                                </tr>
                                <tr>
                                    <td>Ironing board/iron</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                             @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Miscellaneous','name' => 'Ironing board/iron'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Ironing board/iron">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Drying rack</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                         @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Miscellaneous','name' => 'Drying rack'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Drying rack">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vacuum Cleaner</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Miscellaneous','name' => 'Vacuum Cleaner'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Vacuum Cleaner">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waste schedule available</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Miscellaneous','name' => 'Waste schedule available'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Waste schedule available">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Miscellaneous cleaning articles</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Miscellaneous','name' => 'Miscellaneous cleaning articles'])->first() : null;
                                            @endphp
                                        <input type="hidden" name="name[]" value="Miscellaneous cleaning articles">
                                        <input type="number" name="value[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                        <input type="number" name="comment[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->comment : ''}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Particularities</td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Miscellaneous','name' => 'Particularities'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Particularities">
                                            <textarea name="value[]" id="" class="form-control"></textarea>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Images</td>
                                    <td class="text-right">
                                        <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Miscellaneous'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="ninteen-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default ninteen-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d ninteen-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-ninteen-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Miscellaneous'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-ninteen-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <br>
                    {{-- Ninteen Form End --}}
                    {{-- Twenty Form Start --}}
                    <form class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Fire prevention">
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Fire prevention</th>
                                        <th>Number damage</th>
                                        <th>inspected</th>
                                        <th>inspection date</th>
                                        <th>United homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Smoke alarm</td>
                                        <td>
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention','name' => 'Smoke alarm'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Smoke alarm">
                                            <input type="number" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->comment == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->comment == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control"  value="{{ !empty($value) ? $value->inspected_date : ''}}">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control"  value="{{ !empty($value) ? $value->united_homes : ''}}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Fire extinguisher</td>
                                        <td>
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention','name' => 'Fire extinguisher'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Fire extinguisher">
                                            <input type="number" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : '' }}">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->comment == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->comment == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control" value="{{ !empty($value) ? $value->inspected_date : ''}}">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->united_homes : ''}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fire blanket</td>
                                        <td>
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention','name' => 'Fire blanket'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Fire blanket">
                                            <input type="number" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->comment == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->comment == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control" value="{{ !empty($value) ? $value->inspected_date : ''}}">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->united_homes : ''}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Carbon monoxide detector</td>
                                        <td>
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention','name' => 'Carbon monoxide detector'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Carbon monoxide detector">
                                            <input type="number" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->comment == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->comment == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control" value="{{ !empty($value) ? $value->inspected_date : ''}}">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->united_homes : ''}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>iP44 lamp</td>
                                        <td>
                                             @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention','name' => 'iP44 lamp'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="iP44 lamp">
                                            <input type="number" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->comment == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->comment == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control" value="{{ !empty($value) ? $value->inspected_date : ''}}">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->united_homes : ''}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>House rules available</td>
                                        <td>
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention','name' => 'House rules available'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="House rules available">
                                            <input type="number" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control sm-width">
                                                <option value="">Select</option>
                                                <option value="Good" @if(!empty($value) && $value->comment == 'Good') selected @endif>Good</option>
                                                <option value="Bad" @if(!empty($value) && $value->comment == 'Bad') selected @endif>Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control" value="{{ !empty($value) ? $value->inspected_date : ''}}">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control" value="{{ !empty($value) ? $value->united_homes : ''}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Particularities</td>
                                        <td  colspan="">
                                            @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention','name' => 'Particularities'])->first() : null;
                                            @endphp
                                            <input type="hidden" name="name[]" value="Particularities">
                                            <textarea name="value[]" id="" class="form-control">
                                                @if(!empty($value))
                                                 {{ $value->value}}
                                                @endif
                                            </textarea>
                                        </td>
                                        <td>
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" accept="image/*">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="twenty-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default twenty-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d twenty-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-twenty-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Fire prevention'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-twenty-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <br>
                    {{-- End Twenty --}}
                    {{-- Twenty One Form Start --}}
                    <form  class="post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                        <input type="hidden" name="title" value="Heating system">
                        <table class="tabe">
                                <tbody>
                                    <tr>
                                        <th>Heating system</th>
                                    </tr>
                                    <tr>
                                        <td>Heating type</td>
                                        <td>
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Heating system','name' => 'Heating type'])->first() : null;
                                                @endphp
                                                <input type="hidden" name="name[]" value="Heating type">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good" @if(!empty($value) && $value->value == 'Good') selected @endif>Good</option>
                                                    <option value="Bad" @if(!empty($value) && $value->value == 'Bad') selected @endif>Bad</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                      <tr>
                                        <td>Date yearly check up</td>
                                        <td>
                                           <br>
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Heating system','name' => 'Date yearly check up'])->first() : null;
                                                @endphp
                                                <input type="hidden" name="name[]" value="Date yearly check up">
                                               <input type="date" name="value[]" id="" class="form-control" value="{{ !empty($value) ? $value->value : ''}}">
                                            </div>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>Bar Cv</td>
                                        <td>
                                           <br>
                                            <div class="form-group">
                                                @php $value = !empty($old_inspection) ? \App\Models\InspectionContents::where(['inspection_id' => $old_inspection->id,'title' => 'Heating system','name' => 'Bar Cv'])->first() : null;
                                                @endphp
                                                <input type="hidden" name="name[]" value="Bar Cv">
                                               <textarea name="value[]" id="" class="form-control">
                                                @If(!empty($value))
                                                  {{ $value->value}}
                                                @endif
                                               </textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="d-flex justify-content-end">
                                @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Heating system'])->get() : array();
                                    $image_array = array();
                                    @endphp
                                    @foreach($images as $img)
                                        @php array_push($image_array,$img->file_url); @endphp
                                    @endforeach
                                    <input type="hidden" id="twentyone-images" name="selected_images" value="">
                                    @if(count($image_array) > 0)
                                    
                                    <button type="button" class="btn btn-default twentyone-btn-view mr-4">Choose from Existing Images</button>
                                    @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- Images Model Start -->
                        <div class="modal fade book-d twentyone-images" id="modal-info">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Select Existing Image Files</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- Modal Body Start -->
                                    <table class="table table-bordered tbl-twentyone-images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Select</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $images = !empty($old_inspection) ? \App\Models\InspectionFiles::where(['inspection_id' => $old_inspection->id,'title' => 'Heating system'])->get() : array();
                                            @endphp
                                        @foreach($images as $image)
                                            <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="checkbox" name="select_images[]" id="" value="{{ $image->file_url}}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/inspection/'.$image->file_url)}}" alt="inspection" class="img-thumbnail">
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                <!-- End Modal Body -->
                            </div>
                            <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-outline-light btn-twentyone-select-images">Choose</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    {{-- End Twenty One Form --}}
                 <!-- End Card Text  -->
            </div>
          </div>
        <!-- END -->
    </div>
</div>
@endsection
@section('script')
 <script src="{{ asset('backend/global/vendor/toastr/toastr.min599c.js?v4.0.2') }}"></script>
 <script src="{{ asset('backend/global//vendor/bootstrap-sweetalert/sweetalert.min599c.js?v4.0.2') }} "></script>
 <script src="{{ asset('backend/custom/script.js') }}"></script>
<script>
    $(document).on('submit','.post-form',function(e){
        e.preventDefault();
          var url = $(this).attr("action");

        $.ajax({
            url: url,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cashe: false,
            processData: false,
            dataType: "json",
            success: function (html) {
            if (html.success) {
                // toastr.success(html.message);
                swal({
                    title: "Success",
                    text: html.message,
                    type: "success",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "OK",
                    });
            } else {
                // toastr.error(html.message);
                swal({
                    title: "Error",
                    text: html.message,
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "OK",
                    });
            }
            },
        });
    });
</script>
@endsection