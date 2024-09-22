<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormCheck extends Component
{
    public $id;
    public $name;
    public $label;
    public $checked;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id=null,$name=null,$label=null,$checked=false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->checked = boolval($checked);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-check');
    }
}
