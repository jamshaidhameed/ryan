<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspections extends Model
{
    //
    protected $fillable = ['inspectionable_id','inspectionable_type','inspection_code','inspection_type','inspection_date','inspection_notes','is_ready','inspected_by','parent_id','total_persons'];

    public function inspector(){
         return $this->belongsTo(User::class,'inspected_by','id');
    }
}
 