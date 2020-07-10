<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class WorkerRating extends Model
{
    public function getCreatedAtAttribute($value){
        return $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->diffForHumans();
    }
}
