<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DepartmentProjectForm extends Component
{

    public $action;

    public $btnText;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $btnText)
    {
        $this->action = $action;
        $this->btnText = $btnText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.department-project-form');
    }
}
