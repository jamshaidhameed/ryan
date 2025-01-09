<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantContracts extends Model
{
   protected $fillable = ['property_id','contract_code','user_id','price','start_from','contract_period','link','signed_at','expired_at','verified_at','commission_amount','commission_paid_at','commission_verified_by','created_by','contract_verified_by','persons','terminated_by','terminated_on','termination_reason','status'];

    public function tenant(){

        return $this->belongsTo(User::class,'user_id','id');
    }
    public function property(){
        return $this->belongsTo(Properties::class,'property_id','id');
    }
}
