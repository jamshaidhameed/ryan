@extends('landlord.layout.landlord') 
@section('title')
 {{ __('titles.password_change') }}
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ __('titles.password_change') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('titles.home') }}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.properties' ? 'active' : ''}}">{{ __('titles.password_change') }} </li>
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
                        <label for="" class="form-control-label">{{ __('titles.current_password') }}</label>
                        <input type="password" name="current_password" id="" class="form-control" value="">
                     </div>
                     <div class="form-group">
                        <label for="" class="form-control-label">{{ __('titles.new_password') }} </label>
                        <input type="password" name="password" id="" class="form-control" value="">
                     </div>
                     <div class="form-group">
                        <label for="" class="form-control-label">{{ __('titles.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" id="" class="form-control" value="">
                     </div>
                      <div class="col-lg-12">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-4">{{ __('titles.change_your_password') }}</button>
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