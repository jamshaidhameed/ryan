@extends('landlord.layout.landlord') 
@section('title')
 Booking Enquiries
@endsection
@section('style')
<style>
    #province_id {
        width: 100%; /* Adjust as per your layout */
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        display: inline-block;
    }
</style>
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Booking Enquiries</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home')}}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.dashboard' ? 'active' : ''}}">{{ __('Booking Enquiries') }}</li>
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
                  @include('landlord.layout.landlord.sidebar')
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="my-address contact-2">
                    
                    <h3 class="heading-3">{{ __('Booking Enquiries')}}</h3>
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success')}}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">S.No</th>
                                <th class="text-center">Enquiry No</th>
                                <th class="text-left">Property</th>
                                <th class="text-left">Tenant</th>
                                <th class="text-center">Admin Uploaded File</th>
                                <th class="text-center">My Uploaded File</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($my_enquiries as $enquiry)
                             <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $enquiry->enquiry_no }}</td>
                                <td class="text-left">{{ $enquiry->property }}</td>
                                <td class="text-left">{{ $enquiry->tenant}}</td>
                                <td class="text-center">
                                    @if(!empty($enquiry->landlord_file_name))
                                    <a type="button" href="{{ asset('upload/booking/'.$enquiry->landlord_file_name) }}" class="btn btn-info btn-outline btn-sm"><i class="fa fa-download"></i></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(!empty($enquiry->landlord_uploaded_file))
                                    <a type="button" href="{{ asset('upload/booking/'.$enquiry->landlord_uploaded_file) }}" class="btn btn-info btn-outline btn-sm"><i class="fa fa-download"></i></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                @if($enquiry->status == 'approved')
                                  <span class="badge badge-success">Approved</span>
                                @elseif($enquiry->status == 'notapproved')
                                  <span class="badge badge-warning">Not Approved</span>
                                @elseif($enquiry->status == 'started')
                                <span class="badge badge-info">Started</span>
                                @elseif($enquiry->status == 'end')
                                <span class="badge badge-danger">Ended</span>
                                @endif
                                </td>
                                <td>
                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                <div class="dropdown-menu" aria-labelledby="exampleIconDropdown1" role="menu">
                                 @if($enquiry->status != 'started')
                                    <a type="button" class="dropdown-item btn btn-primary btn-outline upload"
                                        id="{{ $enquiry->id }}" href="{{ $enquiry->id }}">
                                        <i class="fa fa-file" aria-hidden="true" style="font-size: 15px;margin-right:5px;"></i>Upload File</a>
                                 @else 
                                 <a target="_blank" type="button" class="dropdown-item btn btn-danger btn-outline"
                                    id="delete-type" href="{{ route('landlord.invoices.list',$enquiry->id) }}">
                                    <i class="fa fa-eye" aria-hidden="true" style="font-size: 15px;margin-right:5px;"></i>Invoices</a>
                                @endif
                                    
                                </div>
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

<div class="modal fade book-d file-upload" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Upload File</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('landlord.upload.file') }}" method="post"  enctype="multipart/form-data">
                @csrf 
                @method('PATCH')
             <input type="hidden" name="e_id" value="">
            <div class="modal-body">
              <div class="form-group">
                <label for="" class="form-control-label">Upload File</label>
                <input type="file" name="landlord_uploaded_file" id="" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-outline-light">Upload</button>
            </div>
          </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
@endsection
@section('script')
<script>
$(document).on('click','.upload',function(e){

    e.preventDefault();
    debugger;
    var id = $(this).attr('href');
        $('.file-upload').find('form').find('input[name="e_id"]').val(id);
    $('.file-upload').modal();
});
</script>
@endsection