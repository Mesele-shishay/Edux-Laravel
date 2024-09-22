<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    public $label;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label=null,$required=null)
    {
        $this->label = $label;
        $this->required = filter_var($required, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.label');
    }
}
