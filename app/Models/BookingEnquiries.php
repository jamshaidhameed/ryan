<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingEnquiries extends Model
{
    //
    protected $fillable = ['tenant_id','property_id','enquiry_no','message','status'];

    public function tenant(){

        return $this->belongsTo(User::class,'tenant_id','id');
    }
    public function property(){
        return $this->belongsTo(Properties::class,'property_id','id');
    }

     
}
