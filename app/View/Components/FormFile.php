<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormFile extends Component
{
    public $id;
    public $label;
    public $required;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id=null,$label=null,$required=null,$name='',)
    {
        $this->id = $id;
        $this->label = $label;
        $this->required = $required;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-file');
    }
}
