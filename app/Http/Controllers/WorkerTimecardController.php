<?php

namespace App\Http\Controllers;

use App\Models\WorkerTimecard;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Worker;

class WorkerTimecardController extends Controller
{
    public function index()
    {
        $workers = Worker::orderBy('created_at', 'desc')->get()->chunk(10);
        return view('customViews.salarySheet.worker', compact('workers'));
    }
    public function changeStatus(Request $request)
    {
        $timecard = WorkerTimecard::findOrFail($request->id);

        $value = '';
        $role = auth()->user()->role->name;
        if ($role) {
            if ($role == 'supervisor' && $timecard->supervisor_status_value == 0) {
                $timecard->update(['supervisor_status' => 1]);
                return $timecard->supervisor_status;
            } else if ($role == 'general_manager' && $timecard->manager_status_value == 0) {
                $timecard->update(['manager_status' => 1]);
                return $timecard->manager_status;
            } else {
                return response()->json([
                    'error' => 'Status can not be changed'
                ]);
            }
        }
    }

    public function allRecords(Request $request)
    {
        $worker_id = $request->worker_id;

        $data = WorkerTimecard::where('worker_id', $worker_id)->latest()->get();
        $uniqueDate = $data->unique(function ($val) {
            return Carbon::parse($val->created_at)->format('m');
        })->sortByDesc(function ($item, $key) {
            return Carbon::parse($item->created_at)->format('m');
        });
        $period = $uniqueDate->pluck('created_at');


        return view('customViews.timecards.all_record', compact('worker_id', 'period'));
    }

    public function recordByMonth(Request $request)
    {
        $records = WorkerTimecard::where('worker_id', $request->worker_id)
            ->whereYear('created_at', '=', $request->year)
            ->whereMonth('created_at', '=', $request->month)
            ->orderBy('created_at')
            ->get();

        $daySalary = \App\Models\Worker::findOrFail($request->worker_id)->perday_salary;
        return view('ajaxRequestData.timecardTable', compact('records', 'daySalary'));
    }

    // public function show(Request $request)
    // {
    //     $worker_id = $request->worker_id;

    //     $data = WorkerTimecard::where('worker_id', $worker_id)->latest()->get();
    //     $uniqueDate = $data->unique(function ($val) {
    //         return Carbon::parse($val->created_at)->format('m');
    //     })->sortByDesc(function ($item, $key) {
    //         return Carbon::parse($item->created_at)->format('m');
    //     });
    //     $period = $uniqueDate->pluck('created_at');


    //     return view('customViews.timecards.all_record', compact('worker_id', 'period'));
    // }
}
