@extends('landlord.layout.landlord') 
@section('title')
 @if(isset($property))
   {{ __('Update Property')}}
 @else 
 {{ __('Add New Property') }}
 @endif
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


        input:focus, select:focus {
            border: 2px solid #1547d6; /* Green border */
            background-color: #1547d6; /* Light green background */
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5); /* Subtle glow effect */
        }
    </style>
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
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="user-profile-box mrb">
                    <!--header -->
                  @include('landlord.layout.landlord.sidebar')
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">
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
               <form action="{{ isset($property) ? route('landlord.properties.update',$property->id) : route('landlord.properties.store') }}" method="post" enctype="multipart/form-data" autocomplete="off" id="horizontalForm">
                        @csrf
                        <div class="my-address contact-2">
                     <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="form-control-label">{{ __('Property Title[EN]') }} <sup><span class="text-danger">*</span></sup></label>
                            <input type="text" name="title_en" id="title_en" class="form-control" value="{{ isset($property) ? $property->title_en : old('title_en') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">{{ __('Property Title[NL]') }} <sup><span class="text-danger">*</span></sup></label>
                            <input type="text" name="title_nl" id="title_nl" class="form-control" value="{{ isset($property) ? $property->title_nl : old('title_nl') }}" required>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col col-md-6">
                            <!-- First Column Start -->
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Price (in mons.)') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ isset($property) ? $property->price : old('price') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label"><sup class="text-danger">*</sup>{{ __('Province') }}</label>
                                <select name="province_id" id="province_id" class="form-control" required>
                                     <option value="">{{ __('Please Choose') }}</option>
                                     @foreach(\App\Models\Provinces::all() as $province)
                                       <option value="{{ $province->id }}" @if(isset($property) && $property->province_id == $province->id || ( !empty(old('province_id')) && old('province_id') == $province->id ) ) selected @endif>{{ $province->name}}</option>
                                     @endforeach
                                </select>
                             </div>
                              <div class="form-group" required>
                                <label for="" class="form-control-label">{{ __('City') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="text" name="city" id="" class="form-control" value="{{ isset($property) ? $property->city : old('city') }}" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Available From') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="date" name="available_from" id="" class="form-control" value="{{ isset($property) ? $property->available_from : old('available_from') }}" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Area') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="text" name="area" id="" class="form-control" value="{{ isset($property) ? $property->area : old('area') }}" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Bathrooms') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="bathrooms" id="" class="form-control" value="{{ isset($property) ? $property->bathrooms : old('bathrooms') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Garages') }} <sup><span class="text-danger">*</span></sup> </label>
                                <input type="number" name="garages" id="" class="form-control" value="{{ isset($property) ? $property->bathrooms : old('bathrooms') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Toilets') }}<sup><span class="text-danger">*</span></sup> </label>
                                <input type="number" name="toilets" id="" class="form-control" value="{{ isset($property) ? $property->toilets : old('toilets') }}" min="0" required>
                             </div>
                             <!-- First Column End -->
                        </div>
                        <div class="col col-md-6">
                            <!-- Second Column Start -->
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Property Type') }}<sup><span class="text-danger">*</span></sup> <sup><span class="text-danger">*</span></sup></label>
                                <select name="property_type_id" id="property_type_id" class="form-control" required>
                                     <option value="">{{ __('Please Choose') }}</option>
                                    @foreach(\App\Models\PropertyTypes::where('status',1)->get() as $type)
                                    <option value="{{ $type->id }}" @if(isset($property) && $type->id == $property->property_type_id || (!empty(old('property_type_id')) && old('property_type_id') == $type->id) ) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Address') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="text" name="street_address" id="" class="form-control" value="{{ isset($property) ? $property->street_address : old('street_address') }}"  required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Postal Code') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="text" name="postcode" id="" class="form-control" value="{{ isset($property) ? $property->postcode : old('postcode') }}" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Contract Period (in mons)') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="contract_period" id="" class="form-control" value="{{ isset($property) ? $property->contract_period : old('contract_period') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Bedrooms') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="bedrooms" id="" class="form-control" value="{{ isset($property) ? $property->bedrooms : old('bedrooms') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Kitchens') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="kitchens" id="" class="form-control" value="{{ isset($property) ? $property->kitchens : old('kitchens') }}" min="0" required>
                             </div>
                               <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Parkings') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="parkings" id="" class="form-control" value="{{ isset($property) ? $property->parkings : old('parkings') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('Youtube Video Link') }}</label>
                                <input type="text" name="youtube_url" id="" class="form-control" value="{{ isset($property) ? $property->youtube_url : old('youtube_url') }}">
                             </div>
                             <!-- Second Column End -->
                        </div>
                     </div>
                     </div>
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
                      <div class="col-lg-12">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-4">@if(isset($property)) {{__('Update Property')}} @else {{ __('Add new Property') }} @endif</button>
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
<script src="{{ asset('summernote/summernote.js')}}"></script>
<script>
$(document).ready(function(){
    $('.summernote').summernote({
      height: 200, // Set editor height
         toolbar: [
            ['style', ['bold', 'italic', 'underline']], // Style options
            ['para', ['ul', 'ol', 'paragraph']],       // Paragraph options
            ['insert', ['link', 'picture']],          // Insert options
         ]
    });
});
</script>

 <!-- <script>
   $(document).ready(function () {
      const fields = $("#horizontalForm input,select"); // Select all input fields in the form

      fields.on("keydown", function (e) {
            if (e.key === "Tab") {
               e.preventDefault(); // Prevent the default tab behavior

               const currentIndex = fields.index(this); // Get the index of the current input
               const nextIndex = e.shiftKey 
                  ? (currentIndex - 1 + fields.length) % fields.length // Navigate backward with Shift+Tab
                  : (currentIndex + 1) % fields.length; // Navigate forward

               fields.eq(nextIndex).focus(); // Focus the next input field
            }
      });
   });
   </script> -->

@endsection