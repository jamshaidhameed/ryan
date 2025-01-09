<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandlordContracts extends Model
{
    protected $fillable = ['property_id','contract_code','link','price','start_from','contract_period','signed_at','expired_at','verified_at','created_by','verified_by','terminated_by','terminated_on','termination_reason'];
}
