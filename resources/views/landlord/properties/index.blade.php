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
@endsection
@section('script')

@endsection