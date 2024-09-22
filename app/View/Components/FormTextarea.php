<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTextarea extends Component
{
    public $name;
    public $id;
    public $label;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id=null,$name=null,$label=null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-textarea');
    }
}
