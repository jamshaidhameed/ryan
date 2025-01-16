@extends('layouts.admin')
@section('title')
  Edit Property
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('summernote/summernote.css')}}">
<style>
        /* Customize Summernote Toolbar Font */
        .note-toolbar {
            font-family: 'Arial', sans-serif; /* Change font family */
            font-size: 14px;                 /* Adjust font size */
        }

        /* Optionally customize button font */
        .note-btn {
            font-family: 'Courier New', monospace;
            font-size: 12px;
        }
    </style>
@endsection
@section('content')
 
<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title'))}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin Dashboard</li>
          <li class="breadcrumb-item"><a href="#">Edit  </a></li>
          <li class="breadcrumb-item active">Property</li>
        </ol>
        
      </div>

  <div class="page-content container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Property</h3>
        </div>
        <div class="panel-body mt-5">
              
        <!--  -->
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
        
          
         <!-- Start -->
          <form action="{{ route('admin.property.update',$property->id) }}" method="post" class="form-horizontal" id="exampleConstraintsForm" autocomplete="off" enctype="multipart/form-data">
            @csrf
             <div class="form-group">
                <label for="" class="form-control-label">{{ __('Property Title[EN]') }} <sup><span class="text-danger">*</span></sup></label>
                <input type="text" name="title_en" id="title_en" class="form-control" value="{{ isset($property) ? $property->title_en : old('title_en') }}" data-fv-notempty="true">
            </div>
            <div class="form-group">
                <label for="" class="form-control-label">{{ __('Property Title[NL]') }} <sup><span class="text-danger">*</span></sup></label>
                <input type="text" name="title_nl" id="title_nl" class="form-control" value="{{ isset($property) ? $property->title_nl : old('title_nl') }}" data-fv-notempty="true">
            </div>

            <!-- Row Start -->
             <div class="row">
                <!-- First Column Start -->
                 <div class="col col-md-6">
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Price (in mons.)') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ isset($property) ? $property->price : old('price') }}" min="0" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label"><sup class="text-danger">*</sup>{{ __('Province') }}</label>
                    <select name="province_id" id="province_id" class="form-control" data-fv-notempty="true">
                            <option value="">{{ __('Please Choose') }}</option>
                            @foreach(\App\Models\Provinces::all() as $province)
                            <option value="{{ $province->id }}" @if(isset($property) && $property->province_id == $province->id || ( !empty(old('province_id')) && old('province_id') == $province->id ) ) selected @endif>{{ $province->name}}</option>
                            @endforeach
                    </select>
                    </div>
                    <div class="form-group" data-fv-notempty="true">
                    <label for="" class="form-control-label">{{ __('City') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="text" name="city" id="" class="form-control" value="{{ isset($property) ? $property->city : old('city') }}" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Available From') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="date" name="available_from" id="" class="form-control" value="{{ isset($property) ? $property->available_from : old('available_from') }}" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Area') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="text" name="area" id="" class="form-control" value="{{ isset($property) ? $property->area : old('area') }}" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Bathrooms') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="number" name="bathrooms" id="" class="form-control" value="{{ isset($property) ? $property->bathrooms : old('bathrooms') }}" min="0" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Garages') }} <sup><span class="text-danger">*</span></sup> </label>
                    <input type="number" name="garages" id="" class="form-control" value="{{ isset($property) ? $property->bathrooms : old('bathrooms') }}" min="0" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Toilets') }}<sup><span class="text-danger">*</span></sup> </label>
                    <input type="number" name="toilets" id="" class="form-control" value="{{ isset($property) ? $property->toilets : old('toilets') }}" min="0" data-fv-notempty="true">
                    </div>
                 </div>
                <!-- End First Column -->
                <!-- Second Column Start -->
                 <div class="col col-md-6">
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Property Type') }}<sup><span class="text-danger">*</span></sup> <sup><span class="text-danger">*</span></sup></label>
                    <select name="property_type_id" id="property_type_id" class="form-control" data-fv-notempty="true">
                            <option value="">{{ __('Please Choose') }}</option>
                        @foreach(\App\Models\PropertyTypes::where('status',1)->get() as $type)
                        <option value="{{ $type->id }}" @if(isset($property) && $type->id == $property->property_type_id || (!empty(old('property_type_id')) && old('property_type_id') == $type->id) ) selected @endif>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Address') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="text" name="street_address" id="" class="form-control" value="{{ isset($property) ? $property->street_address : old('street_address') }}"  data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Postal Code') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="text" name="postcode" id="" class="form-control" value="{{ isset($property) ? $property->postcode : old('postcode') }}" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Contract Period (in mons)') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="number" name="contract_period" id="" class="form-control" value="{{ isset($property) ? $property->contract_period : old('contract_period') }}" min="0" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Bedrooms') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="number" name="bedrooms" id="" class="form-control" value="{{ isset($property) ? $property->bedrooms : old('bedrooms') }}" min="0" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Kitchens') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="number" name="kitchens" id="" class="form-control" value="{{ isset($property) ? $property->kitchens : old('kitchens') }}" min="0" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Parkings') }} <sup><span class="text-danger">*</span></sup></label>
                    <input type="number" name="parkings" id="" class="form-control" value="{{ isset($property) ? $property->parkings : old('parkings') }}" min="0" data-fv-notempty="true">
                    </div>
                    <div class="form-group">
                    <label for="" class="form-control-label">{{ __('Youtube Video Link') }}</label>
                    <input type="text" name="youtube_url" id="" class="form-control" value="{{ isset($property) ? $property->youtube_url : old('youtube_url') }}">
                    </div>
                 </div>
                <!-- End Second Column -->
             </div>
             <!-- End Row -->
              <div class="form-group">
            <label for="" class="form-control-label">{{ __('Description [EN]') }}</label>
            <textarea class="summernote" id="" name="description_en">
                @if(isset($property))
                    {{ $property->description_en }}
                @elseif(!empty(old('description_en')))
                    {{ old('description_en')}}
                @endif
            </textarea>
            </div>
            <div class="form-group">
            <label for="" class="form-control-label">{{ __('Description [NL]') }}</label>
            <textarea class="summernote" id="" name="description_nl">
                @if(isset($property))
                    {{ $property->description_nl }}
                @elseif(!empty(old('description_nl')))
                    {{ old('description_nl')}}
                @endif
            </textarea>
            </div>
            <div class="form-group">
                @php $prop_features = array(); @endphp
                @if(!empty($property->features))
                @php $prop_features = explode(",", $property->features);@endphp
                @endif
                <label for="" class="form-control-label">{{ __('Property Features') }}</label> <br>
                @foreach(\App\Models\PropertyFeatures::where('status',1)->get() as $feature)
                    <input type="checkbox" name="features[]" id="" value="{{ $feature->id}}" 
                    @foreach($prop_features as $f)
                    @if($feature->id == $f)
                        checked
                    @endif
                    @endforeach
                    > <label for="">{{ $feature->title}}</label> <br>
                @endforeach
            </div>
            <div class="form-group">
                <label for="" class="form-control-label">{{ __('Feature Image') }} <sup><span class="text-danger">*</span></sup> </label>
                <input type="file" name="feature_images[]" id="" accept="image|jpg|png|jpeg|gif" multiple="true" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-control-label">{{ __('Property Images') }}</label>
                <input type="file" name="property_images[]" id="" accept="image|jpg|png|jpeg|gif" multiple="true" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-outline">Update</button>
            </div>
          </form>
          <!-- End -->
      
         
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page -->
@endsection
@section('script')
<script src="{{ asset('summernote/summernote.js')}}"></script>
<script>
$(document).ready(function(){
    $('.summernote').summernote({
      height: 200,
    });
});
</script>
@endsection