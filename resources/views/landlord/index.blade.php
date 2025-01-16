@extends('landlord.layout.landlord') 
@section('title')
 Update Your Profile
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
            <h1>My Profile</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home')}}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.dashboard' ? 'active' : ''}}">{{ __('My Profile') }}</li>
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
                    @php $user = Auth::user(); @endphp
                    <h3 class="heading-3">{{ __('Profile Details')}}</h3>
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
                    <form action="{{ route('landlord.update.profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col col-md-8" style="margin-top: 29px;">
                                <label for="">{{ __('Update Profile Picture')}}</label>
                                <input type="file" name="file" id="" class="form-control" placeholder="Update Profile Picture">
                            </div>
                            <div class="col col-md-4">
                                <label for="">{{ __('Current Picture')}}</label>
                                <img src="{{ !empty($user->photo) ? asset('upload/landlord/'.$user->photo) : asset('no_image.png') }}" alt="" style="width:122px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="form-group name">
                                    <label>{{ __('First Name')}}</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="{{ __('Enter First Name')}}" value="{{ !empty($user->first_name) ? $user->first_name : old('first_name') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group last-name">
                                    <label for="">{{ __('Last Name')}}</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="{{ __('Enter Last Name')}}" value="{{ !empty($user->last_name) ? $user->last_name : old('last_name') }}" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group last-name">
                                    <label for="">{{ __('Gender')}}</label>
                                    <select name="gender" id="" class="form-control" required>
                                        <option value="">Please Choose</option>
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
                                    <label for="">{{ __('Email Address') }}</label>
                                    <input type="email" name="email" id="" class="form-control" value="{{ !empty($user->email) ? $user->email : old('email')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('Company Name') }}</label>
                                    <input type="text" name="company_name" id="" class="form-control" value="{{ !empty($user->company_name) ? $user->company_name : old('company_name') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('Country') }}</label>
                                    <select name="country_id" id="" class="form-control" required>
                                        <option value="">Please Choose</option>
                                        @foreach(\App\Models\Countries::orderBy('name','ASC')->get() as $country)
                                        <option value="{{ $country->id }}" @if(!empty($user->country_id) && $user->country_id == $country->id || (!empty(old('country_id')) && old('country_id') == $country->id)) selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    @php $province = !empty($user->province_id) ? \App\Models\Provinces::find($user->province_id) : null; @endphp
                                    <label for="">{{ __('Province') }}</label>
                                    <select name="province_id" id="province_id" required>
                                        @if(!empty($province))
                                         <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('Contact') }}</label>
                                    <input type="text" class="form-control" name="phone" value="{{ !empty($user->phone) ? $user->phone : old('phone') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('City') }}</label>
                                    <input type="text" class="form-control" name="city" value="{{ !empty($user->city) ? $user->city : old('city') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('Postal Code') }}</label>
                                    <input type="text" class="form-control" name="postcode" value="{{ !empty($user->postcode) ? $user->postcode : old('postcode') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">{{ __('Street Address') }}</label>
                                    <textarea wrap="on" class="form-control" name="street_address" placeholder="" required>
                                        @if(!empty($user->street_address))
                                         {{ $user->street_address}}
                                        @else 
                                        {{ old('street_address')}}
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-4">Update Profile</button>
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
            url: "{{url('/landlord/provinces/json')}}" + "/" + id,
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