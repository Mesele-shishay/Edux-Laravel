<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RadioButton extends Component
{
    public $check;
    public $value;
    public $id;
    public $name;
    public $label;




    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($check=null,$value=nulll,$id=null,$name=null,$label=null)
    {
        $this->check = $check;
        $this->value = $value;
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;



    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.radio-button');
    }
}
