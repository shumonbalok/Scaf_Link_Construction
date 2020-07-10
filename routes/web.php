<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/weather', function () {
    return view('weather');
});

Route::get('/', 'Frontend\LandingPage@index');


Route::group(['prefix' => 'admin'], function () {

    Route::middleware('admin.user')->group(function () {
        Route::get('/orders/productByDepartment', 'OrderController@productByDepartment');
        Route::post('/orders/changeOrderStatus', 'OrderController@changeOrderStatus');
        Route::post('/returns/getAndSaveReturn', 'ReturnController@getAndSaveReturn')->name('returns.getAndSaveReturn');
        Route::post('/returns/changeReturnStatus', 'ReturnController@changeReturnStatus')->name('returns.changeReturnStatus');
        Route::post('/returns', 'ReturnController@save')->name('returns.save');
        Route::post('/worker-timecards/changeStatus', 'WorkerTimecardController@changeStatus')->name('worker-timecards.changeStatus');
        Route::get('/worker-timecards/all-records', 'WorkerTimecardController@allRecords')->name('worker-timecards.all-records');
        Route::get('/worker-timecards/records-by-month', 'WorkerTimecardController@recordByMonth')->name('worker-timecards.records-by-month');
        Route::get('/salary-sheets/workers', 'SalaryController@workersSalary')->name('salary-sheets.workers');
        Route::get('/salary-sheets/staff', 'SalaryController@staffSalary')->name('salary-sheets.staff');
        Route::match(['get', 'put'], '/salary-sheets/staff-list', 'SalaryController@staffSalaryList')->name('salary-sheets.staff-list');
        Route::get('/workers/expired', 'WorkerController@index')->name('workers.expired');
        Route::match(['get', 'post'], '/attendance/workers', 'AttendanceController@workers')->name('attendance.workers');
        Route::post('/attendance/addAttendance', 'AttendanceController@addAttendance')->name('attendance.addAttendance');
        Route::get('/attendance/list', 'AttendanceController@attendanceList')->name('attendance.list');
        Route::match(['get', 'post'], '/attendance/time-entry', 'AttendanceController@attendanceTimeEntry')->name('attendance.time-entry');
        Route::post('/attendance/save-work-time', 'AttendanceController@saveWorkTime')->name('attendance.save-work-time');
    });

    Voyager::routes();
});
