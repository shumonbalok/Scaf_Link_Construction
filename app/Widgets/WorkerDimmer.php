<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use Arrilot\Widgets\AbstractWidget;
use App\Models\Worker;

class WorkerDimmer extends AbstractWidget
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
        $wrker = Worker::whereBetween('permit_end', [\Carbon\Carbon::now()->format('Y-m-d'), \Carbon\Carbon::now()->addMonth(2)->format('Y-m-d')])->get();
        $count = $wrker->count();
        $string = trans_choice('voyager::dimmer.page', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-campfire',
            'title'   => 'Permit Expired',
            'text'  => "within " . \Carbon\Carbon::now()->addMonth(2)->format('F') . ', ' . $count . " Persons",
            //'text'   => \Carbon\Carbon::now()->addMonth(2)->format('m d'),
            'button' => [
                'text' => 'Details',
                'link' => route('workers.expired'),
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
        return Auth::user()->can('browse', Voyager::model('Page'));
    }
}
