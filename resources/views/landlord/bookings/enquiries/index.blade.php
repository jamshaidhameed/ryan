@extends('landlord.layout.landlord') 
@section('title')
 My Booking Enquiries
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
            <h1>{{ __('My Booking Enquiries') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('tenant.dashboard') }}">{{ __('Home') }}</a></li>
                <li class="{{ Route::currentRouteName() == 'tenant.properties' ? 'active' : ''}}">{{ __('My Booking Enquiries') }} </li>
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
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success')}}
                    </div>
                @endif
                <div class="my-properties">
                    
                  <table class="manage-table">
                        <thead>
                        <tr>
                            <th>My Properties</th>
                            <th></th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="responsive-table">
                        @foreach($property_list as $property)
                          <tr>
                            <td class="listing-photoo">
                                @php $single_image = "";
                                  if(!empty($property->property_image)){
                                    $single_image = explode(",",$property->property_image)[0];
                                  }
                                @endphp
                                <img alt="{{$property->title_en}}" src="{{ asset('upload/property/'.$single_image) }}" class="img-fluid">
                            </td>
                            <td class="title-container">
                                <h5><a href="#">{{ $property->title_en }}</a></h5>
                                <h6><span>${{ number_format($property->price,2) }}</span> / monthly</h6>
                                <p><i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i> {{ $property->street_address}} </p>
                            </td>
                            <td class="date">
                                {{ $property->created_at->diffForHumans()}}
                            </td>
                            <td class="action">
                                <ul>
                                    <li>
                                        <a href="{{ route('landlord.properties.edit',$property->id) }}"><i class="fa fa-pencil"></i> {{ __('Edit') }}</a>
                                    </li>
                                    <!-- <li>
                                        <a href="#"><i class="fa  fa-eye-slash"></i> Hide</a>
                                    </li> -->
                                    <li>
                                        <a href="{{ route('landlord.properties.delete',$property->id) }}" onclick="return confirm(`{{__('Are you Sure to Delete the Record ?')}}`);" class="delete"><i class="fa fa-remove"></i> Delete</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-box text-center">
                        <nav aria-label="Page navigation example">
                            {{ $property_list->appends($_GET)->links('vendor.pagination.custom')}}
                        </nav>
                    </div>
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
            <form action="{{ route('tenant.upload.file') }}" method="post"  enctype="multipart/form-data">
                @csrf 
                @method('PATCH')
             <input type="hidden" name="e_id" value="">
            <div class="modal-body">
              <div class="form-group">
                <a href="" class="link" target="_blank">Donwload Contract</a>
                <label for="" class="form-control-label">Upload File</label>
                <input type="file" name="tenant_uploaded_file" id="" class="form-control" required>
                <p class="text-danger"></p>
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