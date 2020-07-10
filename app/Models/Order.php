<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'department_id', 'project_id', 'status', 'remark'];

    public function orderProducts()
    {
        return $this->hasMany('\App\Models\OrderProduct', 'order_id');
    }

    public function orderUser()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function department()
    {
        return $this->belongsTo('\App\Models\Department');
    }

    public function project()
    {
        return $this->belongsTo('\App\Models\Project');
    }

    public function getStatusValueAttribute()
    {
        return $this->attributes['status'];
    }





    public function getStatusAttribute($value)
    {
        $route = url('/admin/orders/changeOrderStatus');

        if ($value == 0) {
            echo '<button data-href=' . $route . ' data-id=' . $this->id . ' class="change_status btn btn-danger">Wait for admin Approve</button>';
        } else if ($value == 1) {
            echo '<button data-href=' . $route . ' data-id=' . $this->id . ' class="change_status btn btn-warning">Packing in store</button>';
        } else if ($value == 2) {
            echo '<button data-href=' . $route . ' data-id=' . $this->id . ' class="change_status btn btn-primary">On the way to site</button>';
        } else if ($value == 3) {
            echo '<button data-href=' . $route . ' data-id=' . $this->id . ' class="change_status btn btn-info">Recieved</button>';
        } else if ($value == 4) {
            echo '<button data-href=' . $route . ' data-id=' . $this->id . ' class="change_status btn btn-success">Site Closed</button>';
        }
    }


    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->diffForHumans();
    }
}
