<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function inspected_properties(){

        return DB::select("SELECT DISTINCT i.inspectionable_id,p.title_en FROM `inspections` i JOIN tenant_contracts t ON i.inspectionable_id = t.id JOIN properties p ON t.property_id = p.id ORDER BY i.inspection_code DESC");
    }
}
