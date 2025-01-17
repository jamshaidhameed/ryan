<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LandlordContracts extends Model
{
    protected $fillable = ['property_id','contract_code','link','price','start_from','contract_period','signed_at','expired_at','verified_at','created_by','verified_by','terminated_by','terminated_on','termination_reason'];

    public function property(){
        return $this->belongsTo(Properties::class,'property_id','id');
    }
    public static function contracts_by_property($id){

        return DB::select("SELECT lc.* FROM `landlord_contracts` lc JOIN properties prop ON lc.property_id = prop.id WHERE prop.id = ".$id." Order By lc.id DESC");
    }

    public static function landlord_contract_list ($id ){

        return DB::select("SELECT lc.* FROM `landlord_contracts` lc JOIN properties prop ON lc.property_id = prop.id WHERE prop.user_id = ".$id);
    }
    public static function active_contract($id){

         $data = DB::select("SELECT * FROM `landlord_contracts` WHERE expired_at >= '".date('Y-m-d')."' AND terminated_on IS NULL AND property_id = ".$id);

         if (count($data) > 0) {
            
            return $data[0];
         }else{

            return null;
         } 
    }
}
