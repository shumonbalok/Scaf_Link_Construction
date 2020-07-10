<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerTimecard extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'worker_id', 'mormal_hrs', 'ot_hrs', 'project_id', 'department_id',
        'supervisor_status', 'manager_status', 'remark', 'attendance'
    ];


    public function department()
    {
        return $this->belongsTo('\App\Models\Department', 'department_id');
    }

    public function project()
    {
        return $this->belongsTo('\App\Models\Project', 'project_id');
    }

    public function worker()
    {
        return $this->belongsTo('\App\Models\worker', 'worker_id');
    }

    public function getAttendanceStatusAttribute()
    {
        return $this->attributes['attendance'] == 0 ? 'Absent' : 'Present';
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }


    public function getSupervisorStatusValueAttribute()
    {
        return $this->attributes['supervisor_status'];
    }

    public function getManagerStatusValueAttribute()
    {
        return $this->attributes['manager_status'];
    }



    public function getSupervisorStatusAttribute($value)
    {
        $this->__statusValues($value);
    }

    public function getManagerStatusAttribute($value)
    {
        $this->__statusValues($value);
    }

    private function __statusValues($value)
    {
        $route = route('worker-timecards.changeStatus');

        if ($value == 0) {
            echo '<button data-href=' . $route . ' data-id=' . $this->id . ' class="change_status btn-sm-s btn btn-danger">Not Approved</button>';
        } else if ($value == 1) {
            echo '<button data-href=' . $route . ' data-id=' . $this->id . ' class="change_status btn-sm-s btn btn-info">Approved</button>';
        }
    }

    public function workerTimeCardThisMonth()
    {
        $timecard = WorkerTimecard::where('worker_id', $this->worker_id)
            ->whereMonth('created_at', '>=', \Carbon\Carbon::now()->subMonth()->month)
            ->latest()
            ->get()
            ->take(30);
        return $timecard;
        //\Carbon\Carbon::now()->startOfMonth()->toDateTimeString();
        //\Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
        // \Carbon\Carbon::now()->subMonth()->month
    }
}
