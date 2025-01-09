@extends('landlord.layout.landlord') 
@section('title')
 Invoices List
@endsection
@section('style')

@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Invoices List</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home')}}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.dashboard' ? 'active' : ''}}">{{ __('Invoices List') }}</li>
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
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success')}}
                        </div>
                    @endif
                    <h4> Invoices of the Booking No. <span class="text-info">{{ $enquiry->enquiry_no}}</span> <br>  <br>
                      Property : <span class="text-info">{{ $enquiry->property->title_en }}</span>
                </h4>
                <br> <br>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">S.No</th>
                            <th class="text-center">Month</th>
                            <th class="text-center">Invoice Amount</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                     <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ date_format(date_create($invoice->from_date),'d-M-y').' / '.date_format(date_create($invoice->till_date),'d-M-y') }}</td>
                        <td class="text-center">{{ number_format($invoice->amount,2) }}</td>
                        <td class="text-center">{{ number_format($invoice->commision,2) }}</td>
                        <td class="text-center">
                            @if($invoice->status == 'paid')
                             <span class="badge badge-success font-weight-100">Paid</span> <br>
                             <span class="badge badge-success">{{ date_format(date_create($invoice->paid_at),'d-m-Y H:i:s')}}</span>
                            @else 
                             <span class="badge badge-warning font-weight-100">Un Paid</span>
                            
                            @endif
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