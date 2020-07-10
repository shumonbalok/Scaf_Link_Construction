<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\StaffSalary;
use App\User;
use DB;


class SalaryController extends Controller
{


  
    public function workersSalary()
    {
        $workers = Worker::orderBy('created_at', 'desc')->get()->chunk(10);
        return view('customViews.salarySheet.worker', compact('workers'));
    }
    
    
    public function staffSalary(Request $request)
    {
        if ($request->expectsJson()) {
            $users = User::all();
            $salary = [];
            foreach ($users as $user) {
                $staffSalary = StaffSalary::where('user_id', $user->id)
                                ->whereMonth('created_at', \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('m'))->first();
                if ($staffSalary && $staffSalary->user_id === $user->id) {
                    return response()->json([
                        'error' => 'Opps! Selary sheet allready exists.'
                    ]);
                }else{
                    $salary[] = [
                        'user_id' => $user->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ];
                }
                
                
            }
            DB::table('staff_salaries')->insert($salary);
            return response()->json([
                'success' => 'Success! Selary sheet for all staff has been created.'
                ]);
        }
        $staffs = User::orderBy('created_at', 'desc')->get()->chunk(10);
        return view('customViews.salarySheet.staff', compact('staffs'));
    }


    public function staffSalaryList(Request $request)
    {
        if ($request->isMethod('put') || $request->expectsJson()) {
            if ($request->isMethod('put')) {
                StaffSalary::where([['user_id', $request->user_id], ['created_at', $request->created_at]])
                                    ->update([
                                        'incentive' => $request->incentive,
                                        'deduction' => $request->deduction,
                                        'deduction_for' => $request->deduction_for,
                                        'cheque_no' => $request->cheque_no,
                                    ]);
                
            }
            $salary = StaffSalary::where([['user_id', $request->user_id], ['created_at', $request->created_at]])->first();
            if ($request->expectsJson()) {
                return view('ajaxRequestData.staffSalaryTable', ['firstrow' => $salary]);
            }
            return  (int)$salary->user->salary + (int)$salary->incentive - (int)$salary->deduction;
        }

        $salaries = StaffSalary::where('user_id', $request->staff_id)->orderBy('created_at', 'desc')->get()->chunk(5);
        return view('customViews.salarySheet.staff_salary_list', compact('salaries'));
    }

    // public function staffSalaryCreate(Request $request)
    // {
    //     return $request->all();
    // }

}