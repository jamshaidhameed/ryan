<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    //
    protected $fillable = ['tenant_contract_id','invoice_number','invoice_type','property_id','amount','from_date','till_date','status','paid_at','remarks'];

    public function property(){
        return $this->belongsTo(Properties::class,'property_id','id');
    }
}
