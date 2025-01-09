<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    //
    protected $fillable = ['title_en',
                            'description_en',
                            'slug',
                            'property_code',
                            'price',
                            'contract_period',
                            'property_type_id',
                            'user_id',
                            'province_id',
                            'postcode',
                            'city',
                            'street_address',
                            'status',
                            'featured',
                            'available_from',
                            'area',
                            'bedrooms',
                            'bathrooms',
                            'kitchens',
                            'garages',
                            'parkings',
                            'toilets',
                            'youtube_url',
                            'latitude',
                            'longitude',
                            'landlord_price',
                            'title_nl',
                            'description_nl',
                            'feature_image',
                            'property_image',
                            'banner',
                            'features'
                        ];
    public function landlord(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function type(){

         return $this->belongsTo(PropertyTypes::class,'property_type_id','id');
    }
}
