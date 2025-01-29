@extends('landlord.layout.landlord') 
@section('title')
 Properties List
@endsection
@section('style')

@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ __('My Properties') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home') }}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.properties' ? 'active' : ''}}">{{ __('My Properties') }} </li>
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
                    <div class="d-flex justify-content-end mb-6">
                        <a href="{{ route('landlord.properties.add') }}" class="btn btn-primary"><i class="fa fa-plus-circle" style="margin-right:10px;"></i>{{ __('Add')}}</a>
                    </div>
                    <br> 
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
                         @php $landlord_contract = \App\Models\LandlordContracts::active_contract($property->id); @endphp
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
                                   @if(!empty($landlord_contract))
                                      <li>
                                        <a href="{{ $landlord_contract->id}},{{ asset('upload/booking/'.$landlord_contract->link) }},{{ !empty($landlord_contract->signed_at) ? '1' : '0' }}" class="contract-btn">
                                            <i class="fa fa-upload"> Contract</i>
                                        </a>
                                      </li>
                                       <li>
                                        <a href="{{ route('landlord.invoices.list',$landlord_contract->id) }}">
                                            <i class="fa fa-money"> Invoices</i>
                                        </a>
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
                         {{ $property_list->appends($_GET)->links('vendor.pagination.custom')}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
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
                <a href="" class="link" target="_blank">Donwload Contract</a> <br>
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