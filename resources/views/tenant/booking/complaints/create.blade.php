@extends('tenant.layouts.Tenant') 
@section('title')
{{ __('titles.issue_ticket') }}
@endsection
@section('style')
<link href="{{ asset('summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>@if(isset($complaint))
                {{ __('titles.update_complaint') }}
                @else 
                {{ __('titles.add_new_complaint') }}
                @endif</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('tenant.dashboard') }}">{{ __('titles.home')}}</a></li>
                <li class="{{ Route::currentRouteName() == 'tenant.dashboard' ? 'active' : ''}}">{{ __('titles.complaints') }}</li>
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
                       {{ __('titles.issue_ticket') }}
                    </h3>
                    <form action="{{ route('tenant.complaints.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <input type="hidden" name="prop_id" value="{{ $e_id }}">
                        <!-- <div class="row">
                            <div class="col col-md-8" style="margin-top: 29px;">
                                <label for="">{{ __('Update Profile Picture')}}</label>
                                <input type="file" name="file" id="" class="form-control" placeholder="Update Profile Picture">
                            </div>
                            <div class="col col-md-4">
                                <label for="">{{ __('Current Picture')}}</label>
                                <img src="{{ !empty($user->photo) ? asset('upload/tenant/'.$user->photo) : asset('no_image.png') }}" alt="" style="width:122px;">
                            </div>
                        </div> -->


                        <div class="row">
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-control-label">{{ __('titles.property') }}</label>
                                    @php 
                                       $tenant_contract = \App\Models\TenantContracts::find($e_id);
                                        $property = null;
                                        if(!empty($tenant_contract)){

                                            $property = \App\Models\Properties::find($tenant_contract->property_id); 
                                            
                                        }
                                    @endphp
                                       
                                    <select name="property_id" id="" class="form-control" data-fv-notempty="true">
                                        <option value="{{ $property->id }}">{{ $property->title_en }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-control-label">{{ __('titles.issue_ticket_type') }}</label>
                                   
                                    <select name="issue_type" id="" class="form-control" data-fv-notempty="true">
                                        <option value="">{{ __('titles.please_choose') }}</option>
                                        <option value="Furniture">Furniture</option>
                                        <option value="Plumber">Plumber</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-control-label">{{ __('titles.issue_title') }}</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-control-label">{{ __('titles.description') }}</label>
                            <textarea name="description" id="summernote"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-control-label">{{ __('titles.priority') }}</label>
                            <select name="priority" id="" class="form-control">
                                <option value="">{{ __('titles.please_choose') }}</option>
                                <option value="low">Low</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                       <div class="form-group">
                         <label for="">{{ __('titles.upload_photo')}}</label>
                        <input type="file" name="file" id="" class="form-control" placeholder="{{ __('titles.upload_photo')}}">
                       </div>
                        
                        
                       <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ __('titles.add_now') }}</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('summernote/summernote-lite.min.js') }} "></script>
<script>
    $(document).ready(function(){
        $('#summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 300, // Set editor height
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    })
</script>
@endsection