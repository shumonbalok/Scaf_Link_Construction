<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{

    public $col;
    public $name;
    public $model;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($col, $name, $model)
    {
        $this->col = $col;
        $this->name = $name;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select');
    }
}
