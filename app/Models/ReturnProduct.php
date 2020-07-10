<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnProduct extends Model
{
    protected $dates = ['deleted_at'];

    public function product()   
    {
       return $this->belongsTo('\App\Models\Product', 'product_id');
    }

    public function getCreatedAtAttribute($value){
        return $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->diffForHumans();
    }
}