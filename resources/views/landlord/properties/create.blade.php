@extends('landlord.layout.landlord') 
@section('title')
 @if(isset($property))
   {{ __('titles.update_property')}}
 @else 
 {{ __('titles.add_new_property') }}
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

        .image-container {
            position: relative;
            display: inline-block;
        }

        .close-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
        }
    </style>

    
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ __('titles.my_properties') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('titles.home') }}</a></li>
                <li class="{{ Route::currentRouteName() == 'landlord.properties' ? 'active' : ''}}">{{ __('titles.my_properties') }} </li>
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
                            <label for="" class="form-control-label">{{ __('titles.title_en') }} <sup><span class="text-danger">*</span></sup></label>
                            <input type="text" name="title_en" id="title_en" class="form-control" value="{{ isset($property) ? $property->title_en : old('title_en') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">{{ __('titles.title_nl') }} <sup><span class="text-danger">*</span></sup></label>
                            <input type="text" name="title_nl" id="title_nl" class="form-control" value="{{ isset($property) ? $property->title_nl : old('title_nl') }}" required>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col col-md-6">
                            <!-- First Column Start -->
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.price_in_mons') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ isset($property) ? $property->price : old('price') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label"><sup class="text-danger">*</sup>{{ __('titles.province') }}</label>
                                <select name="province_id" id="province_id" class="form-control" required>
                                     <option value="">{{ __('titles.please_choose') }}</option>
                                     @foreach(\App\Models\Provinces::all() as $province)
                                       <option value="{{ $province->id }}" @if(isset($property) && $property->province_id == $province->id || ( !empty(old('province_id')) && old('province_id') == $province->id ) ) selected @endif>{{ $province->name}}</option>
                                     @endforeach
                                </select>
                             </div>
                              <div class="form-group" required>
                                <label for="" class="form-control-label">{{ __('titles.city') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="text" name="city" id="" class="form-control" value="{{ isset($property) ? $property->city : old('city') }}" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.available_from') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="date" name="available_from" id="" class="form-control" value="{{ isset($property) ? $property->available_from : old('available_from') }}" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.area') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="text" name="area" id="" class="form-control" value="{{ isset($property) ? $property->area : old('area') }}" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.bathrooms') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="bathrooms" id="" class="form-control" value="{{ isset($property) ? $property->bathrooms : old('bathrooms') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.garage') }} <sup><span class="text-danger">*</span></sup> </label>
                                <input type="number" name="garages" id="" class="form-control" value="{{ isset($property) ? $property->bathrooms : old('bathrooms') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.toilet') }}<sup><span class="text-danger">*</span></sup> </label>
                                <input type="number" name="toilets" id="" class="form-control" value="{{ isset($property) ? $property->toilets : old('toilets') }}" min="0" required>
                             </div>
                             <!-- First Column End -->
                        </div>
                        <div class="col col-md-6">
                            <!-- Second Column Start -->
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.property_type') }}<span class="text-danger">*</span></sup></label>
                                <select name="property_type_id" id="property_type_id" class="form-control" required>
                                     <option value="">{{ __('titles.please_choose') }}</option>
                                    @foreach(\App\Models\PropertyTypes::where('status',1)->get() as $type)
                                    <option value="{{ $type->id }}" @if(isset($property) && $type->id == $property->property_type_id || (!empty(old('property_type_id')) && old('property_type_id') == $type->id) ) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.address') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="text" name="street_address" id="" class="form-control" value="{{ isset($property) ? $property->street_address : old('street_address') }}"  required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.postal_code') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="text" name="postcode" id="" class="form-control" value="{{ isset($property) ? $property->postcode : old('postcode') }}" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.contract_period') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="contract_period" id="" class="form-control" value="{{ isset($property) ? $property->contract_period : old('contract_period') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.bedrooms') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="bedrooms" id="" class="form-control" value="{{ isset($property) ? $property->bedrooms : old('bedrooms') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.kitchen') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="kitchens" id="" class="form-control" value="{{ isset($property) ? $property->kitchens : old('kitchens') }}" min="0" required>
                             </div>
                               <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.parking') }} <sup><span class="text-danger">*</span></sup></label>
                                <input type="number" name="parkings" id="" class="form-control" value="{{ isset($property) ? $property->parkings : old('parkings') }}" min="0" required>
                             </div>
                             <div class="form-group">
                                <label for="" class="form-control-label">{{ __('titles.youtube_link') }}</label>
                                <input type="text" name="youtube_url" id="" class="form-control" value="{{ isset($property) ? $property->youtube_url : old('youtube_url') }}">
                             </div>
                             <!-- Second Column End -->
                        </div>
                     </div>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-control-label">{{ __('titles.descript_en') }}</label>
                        <textarea class="summernote" id="" name="description_en">
                            @if(isset($property))
                              {{ $property->description_en }}
                            @elseif(!empty(old('description_en')))
                               {{ old('description_en')}}
                            @endif
                        </textarea>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-control-label">{{ __('titles.description_nl') }}</label>
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
                        <label for="" class="form-control-label">{{ __('titles.property_feature') }}</label> <br>
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
                         @php $feature_images = isset($property) && !empty($property->feature_image) ? explode(",",$property->feature_image) : array();
                             $property_images = isset($property) && !empty($property->property_image) ? explode(",",$property->property_image) : array(); 
                        @endphp
                        @if(count($feature_images) > 0)
                         <label for="" class="form-control-label">{{ __('titles.existing_feature') }}</label>
                         <div class="row gallery">

                          @for($i = 0;  $i < count($feature_images); $i++)
                            <div class="col-md-3 col-sm-6 mb-3">
                                 <img src="{{ asset('upload/property/feature/'.$feature_images[$i]) }}" class="img-fluid rounded">
                           </div>
                          @endfor
                         </div>
                        @endif
                        <label for="" class="form-control-label">{{ count($feature_images) > 0 ? __('titles.upload_new_feature')  : 'Feature Image'}}
                         @if(!isset($property))
                         <sup><span class="text-danger">*</span></sup>
                         @endif   
                        </label>
                        <input type="file" name="feature_images[]" id="" accept="image/*" class="form-control">
                       
                     </div>
                     <div class="form-group">
                        @if(count($property_images) > 0)
                         <label for="" class="form-control-label">{{ __('titles.existing_property_image') }}</label>
                         <div class="row gallery">

                          @for($i = 0;  $i < count($property_images); $i++)
                            <div class="col-md-3 col-sm-6 mb-3">
                               <div class=" image-container">
                                  <button class="close-btn btn-r-img" data-removelink="{{ url('landlord/remov/image/') }}" data-id="{{ $property_images[$i] }}" data-propid="{{ $property->id }}">&times;</button>
                                 <img src="{{ asset('upload/property/'.$property_images[$i]) }}" class="img-fluid rounded">
                               </div>
                                
                           </div>
                          @endfor
                         </div>
                        @endif
                        <label for="" class="form-control-label">{{ __('titles.property_images') }}</label>
                        <input type="file" name="property_images[]" id="" accept="image|jpg|png|jpeg|gif" multiple="true" class="form-control">
                     </div>
                      <div class="col-lg-12">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-4">@if(isset($property)) {{__('titles.update_property')}} @else {{ __('titles.add_new_property') }} @endif</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="csrf" value="{{ csrf_token() }}">
@endsection
@section('script')
<script src="{{ asset('backend/custom/script.js')}}"></script>
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