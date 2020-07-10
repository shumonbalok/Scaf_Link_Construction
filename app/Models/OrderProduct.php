<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['order_id', 'department_id', 'project_id', 'product_id', 'numbers'];

    public function product()   
    {
       return $this->belongsTo('\App\Models\Product', 'product_id');
    }

    public function getCreatedAtAttribute($value){
        return $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->diffForHumans();
    }
}