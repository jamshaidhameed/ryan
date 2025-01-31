@extends('tenant.layouts.Tenant') 
@section('title')
  {{ __('titles.my_booking_enquiries') }}
@endsection
@section('style')
<style>
    .btn-xs {
    padding: .072rem .358rem;
    font-size: .858rem;
    line-height: 1.5;
    border-radius: .143rem;
}

.modal-header .close {
    padding: 15px;
    margin: -15px -15px -15px auto;
}
</style>
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ __('titles.my_booking_enquiries') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('tenant.dashboard') }}">{{ __('titles.home') }}</a></li>
                <li class="{{ Route::currentRouteName() == 'tenant.properties' ? 'active' : ''}}">{{ __('titles.my_booking_enquiries') }} </li>
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
                  @include('tenant.layouts.sidebar')
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success')}}
                    </div>
                @endif
                <div class="my-properties">
                    
                   <table class="manage-table">
                        <thead>
                        <tr>
                            <th>{{ __('titles.booked_property') }}</th>
                            <th></th>
                            <th class="text-left">{{ __('titles.booking_status') }}</th>
                            <th class="text-center">{{ __('titles.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody class="responsive-table">
                        @foreach($my_quries as $enquiry)
                          <tr>
                            <td class="listing-photoo">
                                @php $single_image = "";
                                  if(!empty($enquiry->property->property_image)){
                                    $single_image = explode(",",$enquiry->property->property_image)[0];
                                  }
                                @endphp
                                <img alt="{{$enquiry->property->title_en}}" src="{{ asset('upload/property/'.$single_image) }}" class="img-fluid">
                            </td>
                            <td class="title-container">
                                <h5><a href="#">{{ $enquiry->property->title_en }}</a></h5>
                                <h6><span>€{{ number_format($enquiry->property->price,2) }}</span> / monthly</h6>
                                <p><i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i> {{ $enquiry->property->street_address}} </p>
                            </td>
                            <td class="date">

                                @php $expiry = date_format(date_create($enquiry->expired_at),'Y-m-d'); @endphp

                                @if(date('Y-m-d') > $expiry && empty($enquiry->terminated_on))
                                  <span class="badge badge-danger font-weight-100">Expired</span>
                                @elseif(!empty($enquiry->terminated_on))
                                 <span class="badge badge-danger font-weight-100">Terminated</span>
                                @else 

                                <span class="badge badge-success font-weight-100">Active</span>

                                @endif

                            </td>
                            <td class="action text-center">
                                <ul>
                                    <li>
                                        
                                        <a href="{{ $enquiry->id}},{{ asset('upload/booking/'.$enquiry->link) }},{{ !empty($enquiry->signed_at) ? '1' : '0' }}" data-id="{{ $enquiry->id}}" data-file="" class="contract-btn" tooltip="Download Contract" target="_blank>
                                        @if(!empty($enquiry->link))    
                                        <i class="fa fa-download"></i> 
                                       @else 
                                         <i class="fa fa-upload"></i>
                                       @endif
                                        {{ __('titles.contract') }}
                                    </a>
                                        
                                    </li>
                                    @php $expiry = date_format(date_create($enquiry->expired_at),'Y-m-d'); @endphp

                                    @if(date('Y-m-d') < $expiry && empty($enquiry->terminated_on))
                                    <li>
                                        <a target="_blank" href="{{ route('tenant.booking.invoices',$enquiry->id)}}" class="delete"><i class="fa fa-eye"></i> {{ __('titles.invoices') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('tenant.booking.property.complaints',$enquiry->id) }}" class="delete"><i class="fa fa-eye"></i> {{ __('titles.complaints') }} </a>
                                    </li>
                                   @endif
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-box text-center">
                    <nav aria-label="Page navigation example">
                         {{ $my_quries->appends($_GET)->links('vendor.pagination.custom')}}
                    </nav>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade book-d file-upload" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{ __('titles.upload_file') }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('tenant.upload.file') }}" method="post"  enctype="multipart/form-data">
                @csrf 
                @method('PATCH')
             <input type="hidden" name="e_id" value="">
            <div class="modal-body">
              <div class="form-group">
                <a href="" class="link" target="_blank">{{ __('titles.download_contract') }}</a> <br>
                <label for="" class="form-control-label">{{ __('titles.upload_file') }}</label>
                <input type="file" name="tenant_uploaded_file" id="" class="form-control" required>
                <p class="text-danger"></p>
              </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-warning btn-outline-light" data-dismiss="modal">{{ __('titles.close') }}</button>
              <button type="submit" class="btn btn-primary btn-outline-light">{{ __('titles.upload') }}</button>
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
<!-- <script>
    $(document).ready(function(){
        $('.table').dataTable();
    });
</script> -->
<script>
    $(document).on('click','.contract-btn',function(e){

        e.preventDefault();
        debugger;
        var href = $(this).attr('href'),
            file_link = '',
            id = '',
            signed = '',
            arr = href.split(',');

         if (arr[0]) {
            id = arr[0];
         }

         if (arr[1]) {
            file_link = arr[1];
         }

         if (arr[2]) {
            signed = arr[2];
         }

        $('.file-upload').find('form').find('input[name="e_id"]').val(id);
        $('.file-upload').find('form').find('.link').attr('href',file_link);
        if (signed == 1) {
        $('.file-upload').find('form').find('.text-danger').text('Contract Already Signed Donwload to View');
        $('.file-upload').find('input[name="tenant_uploaded_file"]').prop('disabled', true);
        $('.file-upload').find('form').find('.btn-primary').prop('disabled', true);
        }
        $('.file-upload').modal();
    });
</script>
@endsection