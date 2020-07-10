<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffSalary extends Model
{

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function getViewBtnAttribute($value)
    {
        $route = route('salary-sheets.staff-list', ['staff_id' => $this->user_id]);

        echo '<a href='.$route.' class="btn-sm-s btn btn-warning">View Salary Sheet</a>';
        
    }
    // public function getCreatedAtAttribute($value){
    //     return $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    // }
}
