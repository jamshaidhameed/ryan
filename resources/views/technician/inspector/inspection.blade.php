@extends('technician.layouts.master') 
@section('title')
 Inspections List
@endsection
@section('style')
 <link rel="stylesheet" href="{{ asset('backend/global/vendor/toastr/toastr.min599c.css?v4.0.2') }}">

  <!-- Page -->
<link rel="stylesheet" href="{{ asset('backend/assets/examples/css/advanced/toastr.min599c.css?v4.0.2') }}">
<link rel="stylesheet" href="{{ asset('backend/global/vendor/bootstrap-sweetalert/sweetalert.min599c.css?v4.0.2') }}">
<style>
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

</style>
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
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-body">
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
                <hr>
                <div class="card-text">
                    
                    <h4>{{ strtoupper('Property: '.$tenant_contract->property->title_en)}}</h4>
                    <p><strong>General</strong></p>
                    <!-- Row Start -->
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
                     <!-- First Inspection Form Start -->
                      <form action="{{ route('technision.inspection.form.submit') }}" class="form-one post-form" method="post"  enctype="multipart/form-data">
                          @csrf 
                          <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                          <input type="hidden" name="title" value="Electric Meter">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="2">Electric Meter</th>
                                    </tr>
                                    <tr>
                                        <td>Electra 1 / Electra 2</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Electra 1 / Electra 2">
                                                <input type="text" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gas / Water</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Gas / Water">
                                                <input type="text" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Room Temperature(set)</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                 <input type="hidden" name="name[]" value="Room Temperature(set)">
                                                <input type="text" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>City heating / Hot water m3</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="City heating / Hot water m3">
                                                <input type="text" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Particularities</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Particularities">
                                                <input type="text" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <br>
                      <!-- First Inspection Form End -->
                       <!-- Second Inspection Form Start -->
                        <form action="{{ route('technision.inspection.form.submit') }}" class="form-two post-form" method="post"  enctype="multipart/form-data">
                          @csrf 
                          <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                          <input type="hidden" name="title" value="Key Management">
                            @csrf
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="2">Key Management</th>
                                    </tr>
                                    <tr>
                                        <td>Number of keys received in total number</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Number of keys received in total number">
                                                <input type="number" name="value[]" id="" class="form-control" min="0">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keys received tenants</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Keys received tenants">
                                                <input type="text" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Owned by the tenants</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Owned by the tenants">
                                                <input type="text" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Number of keys owned by united homes / Staff housing</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Number of keys owned by united homes / Staff housing">
                                                <input type="number" min="0" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Number of keys missing waste card necessary</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Number of keys missing waste card necessary">
                                                <input type="number" min="0" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Comments">
                                               <textarea name="value[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <br>
                        <!-- Second Inspection Form End -->
                        <!-- Inspection form 3 Start -->
                         <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                          @csrf 
                          <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                          <input type="hidden" name="title" value="Entrance / Hallway">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="2">Entrance / Hallway</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 44rem;">General Impression tided up /cleaned up</td>
                                        <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                                <textarea name="comment[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition floor/wall/ceiling</td>
                                        <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                                <textarea name="comment[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition windows/doors</td>
                                        <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="hidden" name="name[]" value="Condition windows/doors">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                                <textarea name="comment[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Functioning lighting</td>
                                        <td class="text-right">
                                           <div class="form-group d-flex justify-content-between">
                                            <input type="hidden" name="name[]" value="Functioning lighting">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                                <textarea name="comment[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prticularities</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Prticularities">
                                               <textarea name="value[]" id="" style="height: 3rem;width: 26rem"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" style="    width: 26rem;height: 38px;font-size: 9pt;margin-left: 517px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <!-- Inspection Form 3 End -->
                         <br> 
                         <!-- Living/Room 1 Form Start -->
                           <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                          @csrf 
                          <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                          <input type="hidden" name="title" value="Living/Room 1">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="2">Living/Room 1</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 49rem;">General Impression tided up /cleaned up</td>
                                        <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                                <textarea name="comment[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition floor/wall/ceiling</td>
                                        <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                                <textarea name="comment[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condition windows/doors</td>
                                        <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="hidden" name="name[]" value="Condition windows/doors">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                                <textarea name="comment[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Functioning lighting</td>
                                        <td class="text-right">
                                           <div class="form-group d-flex justify-content-between">
                                            <input type="hidden" name="name[]" value="Functioning lighting">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                                <textarea name="comment[]" id=""></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prticularities</td>
                                        <td class="text-right">
                                            <input type="hidden" name="name[]" value="Prticularities">
                                            <div class="form-group">
                                               <textarea name="value[]" id="" style="height: 3rem;width: 26rem"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" style="    width: 26rem;height: 38px;font-size: 9pt;margin-left: 517px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <br>
                          <!-- Living/Room 1 Form End -->
                           <!-- Living/Room1 Inventory Form Start -->
                           <form  class="living-one-inventory post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                            <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                            <input type="hidden" name="title" value="Living/Room 1 Inventory">
                             <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;">Living/Room 1 Inventory</th>
                                        <th>number damage</th>
                                        <th>united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Dining Chairs</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Dining Chairs">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Couch</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Couch">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Arm Chair</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Arm Chair">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coffe table</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Coffe table">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Extra furniture</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Extra furniture">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Television</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Television">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Internet/Password</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Internet/Password">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;">
                                        </td>
                                    </tr>
                                </tbody>
                             </table>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                           </form>
                           <br>
                           <!-- Living/Room1 Inventory Form End -->
                           <!-- Bedroom 1 Form Start -->
                            <form  class="bedroom-one post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
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
                                            <td style="width: 49rem;">Window Size</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Window Size">
                                                    <input type="text" name="value[]" id="" class="form-control">
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>General Impression tided up /cleaned up</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Condition windows/doors">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning Lighting</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Functioning Lighting">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment" id="" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" style="font-size: 9pt;">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" style="font-size: 9pt;">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                 <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            <br>
                           <!-- Bedroom 1 Form END -->
                           <!-- Bedroom 1 Inventory Form Start -->
                            <form  class="living-one-inventory post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Bedroom 1 Inventory">
                             <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;">Bedroom 1 Inventory</th>
                                        <th>number damage</th>
                                        <th>united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Bed</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Bed">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Duvet/Pillow</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Duvet/Pillow">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bedding/Bedsheets/Molton</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Bedding/Bedsheets/Molton">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lockable wardrobe</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Lockable wardrobe">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lockable wardrobe size</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Lockable wardrobe size">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nightstand/Night light</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Nightstand/Night light">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;">
                                        </td>
                                    </tr>
                                </tbody>
                             </table>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                           </form>
                           <br>
                           <!-- Bedroom 1 Inventory Form End -->
                          <!-- Bedroom 2 From Start -->
                           <form  class="bedroom-one post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
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
                                            <td style="width: 44rem;">Window Size</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Window Size">
                                                    <input type="text" name="value[]" id="" class="form-control">
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>General Impression tided up /cleaned up</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Condition windows/doors">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning Lighting</td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Functioning Lighting">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea name="comment[]" id="" class="form-control"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Images</td>
                                            <td class="text-right">
                                                <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;">
                                            </td>
                                    </tr>
                                    </tbody>
                                </table>
                                 <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            <br>
                          <!-- Bedroom 2 Form End -->
                          <!-- Bedroom 2 Inventory Form Start -->
                           <form  class="living-one-inventory post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Bedroom 2 Inventory">
                             <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;">Bedroom 2 Inventory</th>
                                        <th>number damage</th>
                                        <th>united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Bed</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Bed">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Duvet/Pillow</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Duvet/Pillow">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bedding/Bedsheets/Molton</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Bedding/Bedsheets/Molton">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lockable wardrobe</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Lockable wardrobe">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lockable wardrobe size</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Lockable wardrobe size">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nightstand/Night light</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                              <input type="hidden" name="name[]" value="Nightstand/Night light">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;">
                                        </td>
                                    </tr>
                                </tbody>
                             </table>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                           </form>
                           <br>
                          <!-- End Bedroom 2 Inventory Form -->
                           <!-- Kitchen 1 Form Starts Here -->
                             <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Kitchen 1">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Kitchen 1</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Condition windows/doors">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning lighting</td>
                                            <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                  <input type="hidden" name="name[]" value="Functioning lighting">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Prticularities">
                                                <textarea name="value[]" id="" style="height: 3rem;width: 26rem"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;margin-left: 32rem;">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                           <!-- Kitchen 1 Form End Here -->
                        <!-- Kitchen 1 Inventory Form Start -->
                           <form class="form-kitchen-one-inventory post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Kitchen 1 Inventory">
                              <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;">Kitchen 1 Inventory</th>
                                        <th>number damage</th>
                                        <th>united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Refrigerator</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Refrigerator">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Freezer</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Freezer">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Microwave/Oven</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Microwave/Oven">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stove</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Stove">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coffee machine/Kettle</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Coffee machine/Kettle">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sufficient Kitchen Inventory</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                              <input type="hidden" name="name[]" value="Sufficient Kitchen Inventory">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="height: 38px;font-size: 9pt;">
                                        </td>
                                    </tr>
                                </tbody>
                             </table>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </form>
                            <br>
                        <!-- Kitchen 1 Inventory Form End -->
                        <!-- Kitchen 2 Form Start -->
                         <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Kitchen 2">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Kitchen 2</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Condition windows/doors">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning lighting</td>
                                            <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                  <input type="hidden" name="name[]" value="Functioning lighting">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Prticularities">
                                                <textarea name="value[]" id="" style="height: 3rem;width: 26rem"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;margin-left: 31rem;">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <br>
                         <!-- Kitchen 2 Form End -->
                        <!-- Kitchen 2 Inventory Form Start -->
                         <form class="form-kitchen-one-inventory post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Kitchen 2 Inventory">
                              <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;">Kitchen 2 Inventory</th>
                                        <th>number damage</th>
                                        <th>united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Refrigerator</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Refrigerator">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Freezer</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Freezer">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Microwave/Oven</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Microwave/Oven">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stove</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Stove">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coffee machine/Kettle</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Coffee machine/Kettle">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sufficient Kitchen Inventory</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                              <input type="hidden" name="name[]" value="Sufficient Kitchen Inventory">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="height: 38px;font-size: 9pt;">
                                        </td>
                                    </tr>
                                </tbody>
                             </table>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </form>
                            <br>
                         <!-- Kitchen 2 Inventory Form End -->
                          <!-- Bathroom 1 Form Start  -->
                           <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Bathroom 1">
                              <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;" colspan="3">Bathroom 1</th>
                                    </tr>
                                    <tr>
                                     <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                          <tr>
                                     <td style="width: 44rem;">Particularities
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Particularities">
                                                    
                                                    <div class="form-group">
                                                        <textarea name="value[]" id="" class="form-control" style="    width: 26rem;vertical-align: middle;height: 56px;"></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="height: 38px;font-size: 9pt;width: 26rem;margin-left: 32rem;">
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                                 <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                                <br>
                          <!-- Bathroom 1 Form END  -->
                           <!-- Bathroom 2 Form Start -->
                            <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Bathroom 2">
                              <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;" colspan="3">Bathroom 2</th>
                                    </tr>
                                    <tr>
                                     <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                          <tr>
                                     <td style="width: 44rem;">Particularities
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Particularities">
                                                    
                                                    <div class="form-group">
                                                        <textarea name="value[]" id="" class="form-control" style="    width: 26rem;vertical-align: middle;height: 56px;"></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="height: 38px;font-size: 9pt;width: 26rem;margin-left: 32rem;">
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                <br>
                            <!-- Bathroom 2 Form End -->
                             <!-- Toilets 1 Form Start -->
                               <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Toilets 1">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Toilets 1</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Condition windows/doors">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning lighting</td>
                                            <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                  <input type="hidden" name="name[]" value="Functioning lighting">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Prticularities">
                                                <textarea name="value[]" id="" style="height: 3rem;width: 26rem"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;margin-left: 31rem;">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <br>
                             <!-- Toilets 1 Form End -->
                    <!-- Toilets 2 From Start -->
                     <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Toilets 2">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Toilets 2</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression tided up /cleaned up
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="General Impression tided up /cleaned up">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition floor/wall/ceiling
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Condition floor/wall/ceiling">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Condition windows/doors</td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Condition windows/doors">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Functioning lighting</td>
                                            <td class="text-right">
                                            <div class="form-group d-flex justify-content-between">
                                                  <input type="hidden" name="name[]" value="Functioning lighting">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Prticularities">
                                                <textarea name="value[]" id="" style="height: 3rem;width: 26rem"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;margin-left: 31rem;">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <br>
                     <!-- Toilets 2 Form End -->
                      <!-- Outside Form Start -->
                       <form  class="form-three post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                            @csrf 
                            <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                            <input type="hidden" name="title" value="Outside">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Outside</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 44rem;">General Impression garden/balcony/outside
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="General Impression garden/balcony/outside">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Garden furniture
                                            </td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Garden furniture">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maintenance in order</td>
                                            <td class="text-right">
                                                <div class="form-group d-flex justify-content-between">
                                                    <input type="hidden" name="name[]" value="Maintenance in order">
                                                    <select name="value[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Bad">Bad</option>
                                                    </select>
                                                    <textarea name="comment[]" id=""></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Prticularities</td>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <input type="hidden" name="name[]" value="Prticularities">
                                                <textarea name="value[]" id="" style="height: 3rem;width: 26rem"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="width: 16rem;height: 38px;font-size: 9pt;margin-left: 31rem;">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <br>
                      <!-- Outside Form End -->
                       <!-- Miscellaneous Form Start -->
                        <form class="form-kitchen-one-inventory post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                                <input type="hidden" name="title" value="Miscellaneous">
                              <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 44rem;">Miscellaneous</th>
                                        <th>number damage</th>
                                        <th>united homes number</th>
                                    </tr>
                                    <tr>
                                        <td>Ironing board/iron</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Ironing board/iron">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Drying rack</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Drying rack">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vacuum Cleaner</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Vacuum Cleaner">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Waste schedule available</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                             <input type="hidden" name="name[]" value="Waste schedule available">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Miscellaneous cleaning articles</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="hidden" name="name[]" value="Miscellaneous cleaning articles">
                                            <input type="number" name="value[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                            <input type="number" name="comment[]" min="0" id="" class="form-control">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Particularities</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                              <input type="hidden" name="name[]" value="Particularities">
                                              <textarea name="value[]" id=""></textarea>
                                          </div>
                                        </td>
                                        <td class="text-center">
                                            
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Images</td>
                                        <td class="text-right">
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true" style="height: 38px;font-size: 9pt;">
                                        </td>
                                    </tr>
                                </tbody>
                             </table>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </form>
                            <br>
                       <!-- End Miscellaneous Form End -->
                        <!-- Fire Prevention Form Start -->
                         <form class="fire-prevent post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
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
                                            <input type="hidden" name="name[]" value="Smoke alarm">
                                            <input type="number" name="value[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Good">Good</option>
                                                <option value="Bad">Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Fire extinguisher</td>
                                        <td>
                                            <input type="hidden" name="name[]" value="Fire extinguisher">
                                            <input type="number" name="value[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Good">Good</option>
                                                <option value="Bad">Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fire blanket</td>
                                        <td>
                                            <input type="hidden" name="name[]" value="Fire blanket">
                                            <input type="number" name="value[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Good">Good</option>
                                                <option value="Bad">Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Carbon monoxide detector</td>
                                        <td>
                                            <input type="hidden" name="name[]" value="Carbon monoxide detector">
                                            <input type="number" name="value[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Good">Good</option>
                                                <option value="Bad">Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>iP44 lamp</td>
                                        <td>
                                            <input type="hidden" name="name[]" value="iP44 lamp">
                                            <input type="number" name="value[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Good">Good</option>
                                                <option value="Bad">Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>House rules available</td>
                                        <td>
                                            <input type="hidden" name="name[]" value="House rules available">
                                            <input type="number" name="value[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <select name="comment[]" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Good">Good</option>
                                                <option value="Bad">Bad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="inspection_date[]" id="" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="united_homes[]" min="0" id="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Particularities</td>
                                        <td  colspan="">
                                            <input type="hidden" name="name[]" value="Particularities">
                                            <textarea name="value[]" id="" class="form-control"></textarea>
                                        </td>
                                        <td>
                                            <input type="file" name="images[]" id="" class="form-control" multiple="true">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <br>
                         <!-- Fire Prevention Form End -->
                        <!-- Heating System Form Start -->
                         <form  class=" post-form" action="{{ route('technision.inspection.form.submit') }}" method="post"  enctype="multipart/form-data">
                            @csrf 
                            <input type="hidden" name="insp_id" value="{{ $inspection->id }}">
                            <input type="hidden" name="title" value="Heating system">
                            <table class="tabe">
                                <tbody>
                                    <tr>
                                        <th style="width: 47rem;">Heating system</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 47rem;">Heating type</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Heating type">
                                                <select name="value[]" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                      <tr>
                                        <td style="width: 47rem;">Date yearly check up</td>
                                        <td>
                                           <br>
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Date yearly check up">
                                               <input type="date" name="value[]" id="" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td style="width: 47rem;">Bar Cv</td>
                                        <td>
                                           <br>
                                            <div class="form-group">
                                                <input type="hidden" name="name[]" value="Bar Cv">
                                               <textarea name="value[]" id="" class="form-control"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                         </form>
                         <!-- Heating System Form End -->
                    <!-- Row End -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
 <script src="{{ asset('backend/global/vendor/toastr/toastr.min599c.js?v4.0.2') }}"></script>
 <script src="{{ asset('backend/global//vendor/bootstrap-sweetalert/sweetalert.min599c.js?v4.0.2') }} "></script>
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