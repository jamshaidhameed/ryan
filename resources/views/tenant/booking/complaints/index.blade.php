@extends('tenant.layouts.Tenant') 
@section('title')
 {{ __('titles.complaints_list') }}
@endsection
@section('style')
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ __('titles.complaints_list') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('tenant.dashboard') }}">{{ __('titles.home')}}</a></li>
                <li class="{{ Route::currentRouteName() == 'tenant.dashboard' ? 'active' : ''}}">{{ __('titles.complaints_list') }}</li>
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
                <div class="my-address contact-2">
                    <h3 class="heading-3">
                       {{ __('titles.complaints_list') }}
                    </h3>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tenant.complaints.create',$e_id) }}" class="btn btn-primary mt-5"><i class="fa fa-plus-circle" style="margin-right:10px;"></i>{{ __('titles.add')}}</a>
                    </div>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">{{__('titles.issue_code') }}</th>
                                <th class="text-center">{{ __('titles.title') }}</th>
                                <th class="text-center">{{ __('titles.assign_to') }}</th>
                                <th class="text-center">{{ __('titles.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\IssueTickets::where('tenant_contract_id',$e_id)->get() as $issue)
                             <tr>
                                <td class="text-center">{{ $issue->issue_code}}</td>
                                <td class="text-center">{{ $issue->title}}</td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ ucwords($issue->status)}}</td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#province_id').parent().find('a').hide();
        $('#province_id').show();
    })
</script>
 <script>
    $(document).on('change','select[name="country_id"]  ',function(e){
        e.preventDefault();
        debugger;
        var id = $(this).val(),
            contents = '';
        if (!id) {
            // $('select[name="province_id"]').empty();
             $('#province_id').empty();
            return this;
        }

        $.ajax({
            type: 'get',
            url: "/tenant/provinces/json/" + id,
            dataType:'json',
            success:function(data){
                if (data) {
                    contents += '<option value=""> Please Choose</option>';
                }else {
                    $('#province_id').empty(); 
                }
                $.each(data,function(k){
                    contents += '<option value="'+this.id+'">'+this.name+'</option>';
                });
                   $('#province_id').empty();
                const select = document.getElementById("province_id");

                const option = document.createElement("option");
                option.value = "";
                option.textContent = "Please Choose";
                select.appendChild(option);

                data.forEach(province => {
                    const option = document.createElement("option");
                    option.value = province.id;
                    option.textContent = province.name;
                    select.appendChild(option);
                });

                $('#province_id').parent().find('a').hide();
                $('#province_id').show();

            //   $('.province').empty();
            //   $('#province_id').html(contents);
            // jQuery('.province').html(contents);
            //  document.getElementById('province_id').appendChild(html_content);
            }
        })
    });
 </script>
@endsection