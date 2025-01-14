<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTypes extends Model
{
    //
    protected $fillable = ['name','slug','status'];

    public function properties(){

        return $this->hasMany(Properties::class,'property_type_id','id')->where('status',1);
    }
}
