<?php

namespace App\Widgets;

use App\Models\Order;
use Arrilot\Widgets\AbstractWidget;

class OrderDimmer extends AbstractWidget
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
        $orders = Order::where('status', 0)->get();
        $count = $orders->count();

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-paper-plane',
            'title'   => $count . ' Order/s',
            'text'  => '',
            //'text'   => \Carbon\Carbon::now()->addMonth(2)->format('m d'),
            'button' => [
                'text' => 'Details',
                'link' => route('voyager.orders.index')
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
        $orders = Order::where('status', 0)->get();
        $count = $orders->count();
        return $count > 0;
    }
}
