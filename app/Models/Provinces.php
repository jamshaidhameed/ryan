<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    //
    protected $fillable = ['country_id','name','short_name','status'];

    public function country(){
         return $this->belongsTo(Countries::class,'country_id','id');
    }
}
