<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cms extends Model
{
    //
    protected $fillable = ['title','slug','content_en','content_nl','show_on','status'];
}
