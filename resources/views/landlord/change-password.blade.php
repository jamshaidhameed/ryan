@extends('landlord.layout.landlord') 
@section('title')
Change Password
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ __('Change Password') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home') }}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.properties' ? 'active' : ''}}">{{ __('Change Password') }} </li>
            </ul>
        </div>
    </div>
</div>
<div class="user-page content-area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="user-profile-box mrb">
                    <!--header -->
                  @include('landlord.layout.landlord.sidebar')
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">
                 @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success')}}
                    </div>
                 @endif

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
              <div class="my-properties">
               <form action="{{ route('landlord.password.change.post') }}" method="post" enctype="multipart/form-data" autocomplete="off" id="horizontalForm">
                    @csrf
                    <div class="my-address contact-2">
                      <div class="form-group">
                        <label for="" class="form-control-label">Current Password </label>
                        <input type="password" name="current_password" id="" class="form-control" value="">
                     </div>
                     <div class="form-group">
                        <label for="" class="form-control-label">New Password </label>
                        <input type="password" name="password" id="" class="form-control" value="">
                     </div>
                     <div class="form-group">
                        <label for="" class="form-control-label">Confirm Password </label>
                        <input type="password" name="password_confirmation" id="" class="form-control" value="">
                     </div>
                      <div class="col-lg-12">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-4">Change your Password</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection