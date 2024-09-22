<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSwitch extends Component
{
    public $name;
    public $id;
    public $check;
    public $label;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name=null,$id=null,$check=null,$label=null,)
    {
        $this->name = $name;
        $this->id = $id;
        $this->check = $check;
        $this->label = $label;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-switch');
    }
}
