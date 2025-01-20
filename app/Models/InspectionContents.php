<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionContents extends Model
{
    //
    protected $fillable = ['inspection_id','title','name','value','completed','comment','inspected_date','united_homes'];

    public function inspection(){
        return $this->belongsTo(Inspections::class,'inspection_id','id');
    }
}
