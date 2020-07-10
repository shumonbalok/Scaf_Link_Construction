<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use Arrilot\Widgets\AbstractWidget;
use App\Models\WorkerTimecard;

class WorkerAttendanceDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $wrker = WorkerTimecard::where('attendance', false)->whereDate('created_at', today())->get();
        $count = $wrker->count();

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-bookmark',
            'title'   => "Attendance of the day",
            'text'  => $count . ' Worker/s Absent Today',
            //'text'   => \Carbon\Carbon::now()->addMonth(2)->format('m d'),
            'button' => [
                'text' => 'Details',
                'link' => route('attendance.list')
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        //return Auth::user()->can('browse', Voyager::model('Page'));
        return true;
    }
}
