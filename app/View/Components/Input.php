<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{

    public $col;
    public $type;
    public $name;
    public $class;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($col, $type, $name, $class, $value)
    {
        $this->col = $col;
        $this->type = $type;
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
