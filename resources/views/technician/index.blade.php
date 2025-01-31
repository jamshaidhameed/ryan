@extends('technician.layouts.master') 
@section('title')
 {{ __('titles.update_profile') }}
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
            <h1>{{ __('titles.my_profile') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('titles.home')}}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.dashboard' ? 'active' : ''}}">{{ __('titles.my_profile') }}</li>
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
                  @include('technician.layouts.sidebar')
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="my-address contact-2">
                    @php $user = Auth::user(); @endphp
                    <h3 class="heading-3">{{ __('titles.porfile_details')}}</h3>
                     @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item text-danger">
                                    {{ $error }}
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(session()->has('success'))
                        <div class="alert alert-success mt-6">
                            {{ session()->get('success')}}
                        </div>
                        @endif
                    <form action="{{ route('technision.update.profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col col-md-8" style="margin-top: 29px;">
                                <label for="">{{ __('titles.update_profile_pic')}}</label>
                                <input type="file" name="file" id="" class="form-control" placeholder="{{ __('titles.update_profile_pic')}}">
                            </div>
                            <div class="col col-md-4">
                                <label for="">{{ __('titles.current_picture')}}</label>
                                <img src="{{ !empty($user->photo) ? asset('upload/technician/'.$user->photo) : asset('no_image.png') }}" alt="" style="width:122px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="form-group name">
                                    <label>{{ __('titles.first_name')}}</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="{{ __('titles.enter_your_first_name')}}" value="{{ !empty($user->first_name) ? $user->first_name : old('first_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group last-name">
                                    <label for="">{{ __('titles.last_name')}}</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="{{ __('titles.enter_your_last_name')}}" value="{{ !empty($user->last_name) ? $user->last_name : old('last_name') }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group last-name">
                                    <label for="">{{ __('titles.gender')}}</label>
                                    <select name="gender" id="" class="form-control">
                                        <option value="">{{__('titles.please_choose') }}</option>
                                        <option value="male" @if(!empty($user->gender) && $user->gender == 'male' || (!empty(old('gender')) && old('gender') == 'male')) selected @endif>Male</option>
                                        <option value="female" @if(!empty($user->gender) && $user->gender == 'female' || (!empty(old('gender')) && old('gender') == 'female')) selected @endif>Female</option>
                                        <option value="other" @if(!empty($user->gender) && $user->gender == 'other' || (!empty(old('gender')) && old('gender') == 'other')) selected @endif>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('titles.email_address') }}</label>
                                    <input type="email" name="email" id="" class="form-control" value="{{ !empty($user->email) ? $user->email : old('email')}}">
                                </div>
                            </div>
                        </div>
                        
                         <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    @php $province = !empty($user->province_id) ? \App\Models\Provinces::find($user->province_id) : null; @endphp
                                    <label for="">{{ __('titles.province') }}</label>
                                    <select name="province_id" id="province_id">
                                        @foreach(\App\Models\Provinces::orderBy('name','ASC')->get() as $province)
                                          <option value="{{ $province->id}}" @if(!empty($user->province_id) && $user->province_id == $province->id) selected @endif>{{ $province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('titles.contact') }}</label>
                                    <input type="text" class="form-control" name="phone" value="{{ !empty($user->phone) ? $user->phone : old('phone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('titles.city') }}</label>
                                    <input type="text" class="form-control" name="city" value="{{ !empty($user->city) ? $user->city : old('city') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('titles.postal_code') }}</label>
                                    <input type="text" class="form-control" name="postcode" value="{{ !empty($user->postcode) ? $user->postcode : old('postcode') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('titles.street_address') }}</label>
                                    <input type="text" name="street_address" id="" class="form-control" value="{{ !empty($user->street_address) ? $user->street_address :  old('street_address')}}">
                                    {{-- <textarea wrap="on" class="form-control" name="street_address" placeholder="">
                                        @if(!empty($user->street_address))
                                         {{ $user->street_address}}
                                        @else 
                                        {{ old('street_address')}}
                                        @endif
                                    </textarea> --}}
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-4">{{ __('titles.update_profile') }}</button>
                            </div>
                        </div>
                    </form>
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
        var id = $(this).val(),
            contents = '';
        if (!id) {
             $('#province_id').empty();
            return this;
        }

        $.ajax({
            type: 'get',
            url: "{{url('/technision/provinces/json')}}/" + id,
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
            }
        })
    });
 </script>
@endsection