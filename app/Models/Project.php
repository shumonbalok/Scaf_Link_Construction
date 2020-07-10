<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->diffForHumans();
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ProjectType');
    }
}
