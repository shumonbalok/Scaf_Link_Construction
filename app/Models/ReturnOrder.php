<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnOrder extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'department_id', 'project_id', 'status', 'remark'];

    public function returnProducts()
    {
        return $this->hasMany('\App\Models\ReturnProduct', 'return_order_id');
    }

    public function orderUser()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }



    public function getStatusValueAttribute()
    {
        return $this->attributes['status'];
    }





    public function getStatusAttribute($value)
    {
        $route = route('returns.changeReturnStatus');

        if ($value == 0) {
            echo '<button data-href='.$route.' data-id='.$this->id.' class="change_status btn btn-danger btn-sm-s">Waiting for store keeper approved</button>';
        }else if($value == 1) {
            echo '<button data-href='.$route.' data-id='.$this->id.' class="change_status btn btn-info btn-sm-s">Recieved by store keeper</button>';
        }else if($value == 2) {
            echo '<button data-href='.$route.' data-id='.$this->id.' class="change_status btn btn-info btn-sm-s">Approved</button>';
        }
           
    }


    public function getCreatedAtAttribute($value){
        return $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->diffForHumans();
    }
}
