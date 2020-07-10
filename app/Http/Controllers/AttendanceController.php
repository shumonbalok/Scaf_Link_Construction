<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\WorkerTimecard;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function workers(Request $request)
    {
        if ($request->isMethod('post')) {
            $workers = Worker::all();
            if (WorkerTimecard::whereDate('created_at', today())->first() == null) {

                foreach ($workers as $worker) {
                    WorkerTimecard::create([
                        'worker_id' => $worker->id,
                        'department_id' => $worker->department_id
                    ]);
                }
            }
            $errors = validator($request->all(), [
                'department_id' => 'required',
                'project_id' => 'required',
            ]);
            if ($errors->fails()) {
                return response()->json([
                    'errors' => 'Select all the fields.'
                ]);
            }

            $workers = WorkerTimecard::where('department_id', $request->department_id)->whereDate('created_at', today())->get();
            $project_id = $request->project_id;
            return view('ajaxRequestData.workerAttendanceTable', compact('workers', 'project_id'));
        }

        return view('customViews.attendance.worker');
    }

    public function addAttendance(Request $request)
    {
        $workerTimecard = WorkerTimecard::where([
            ['worker_id', $request->worker_id],
            ['department_id', $request->department_id]
        ])
            ->whereDate('created_at', today())->first();
        if ($request->filled('attend') || ($request->filled('attend') && $request->filled('remark'))) {
            $workerTimecard->update(['attendance' => 1, 'project_id' => $request->project_id, 'remark' => $request->remark]);
            return response()->json([
                'message' => 'Attendance added.'
            ]);
        } else {
            $workerTimecard->update(['attendance' => 0, 'project_id' => $request->project_id, 'remark' => $request->remark]);
            return response()->json([
                'message' => 'Attendance removed.'
            ]);
        }
    }


    public function attendanceList()
    {
        if (request()->ajax()) {
            $workers = WorkerTimecard::whereDate('created_at', request()->date)->get();
            $workers = $workers->groupBy('attendance');
            return view('customViews.attendance.listTable', compact('workers'));
        }
        $workers = WorkerTimecard::whereDate('created_at', today())->get();
        $workers = $workers->groupBy('attendance');
        return view('customViews.attendance.list', compact('workers'));
    }

    public function attendanceTimeEntry(Request $request)
    {

        if ($request->isMethod('post')) {
            $timecard = WorkerTimecard::where([['department_id', $request->department_id], ['project_id', $request->project_id], ['attendance', 1]]);

            if ($request->filled('date')) {
                $workers = $timecard->whereDate('created_at', $request->date)->get();
            } else {
                $workers = $timecard->whereDate('created_at', today())->get();
            }
            return view('ajaxRequestData.workertimecardEntryTable', compact('workers'));
        }
        return view('customViews.attendance.timeEntry');
    }

    public function saveWorkTime(Request $request)
    {
        $normal_hrs = $request->normal_hrs;
        $ot_hrs = $request->ot_hrs;
        $remark = $request->remark;
        $model = WorkerTimecard::where([
            ['worker_id', $request->worker_id],
            ['department_id', $request->department_id],
            ['project_id', $request->project_id]
        ])->whereDate('created_at', $request->created_at);
        $model->when($request->filled('normal_hrs'), function ($query) use ($normal_hrs) {
            $query->update(['normal_hrs' => $normal_hrs, 'supervisor_status' => auth()->user()->id]);
        });
        $model->when($request->filled('ot_hrs'), function ($query) use ($ot_hrs) {
            $query->update(['ot_hrs' => $ot_hrs, 'supervisor_status' => auth()->user()->id]);
        });
        $model->when($request->filled('remark'), function ($query) use ($remark) {
            $query->update(['remark' => $remark, 'supervisor_status' => auth()->user()->id]);
        });
        return response()->json([
            'message' => 'Record Successfully Added'
        ]);
    }
}
