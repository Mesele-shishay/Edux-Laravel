<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $label;
    public $type;
    public $icon;
    public $prepend;
    public $append;
    public $size;
    public $help;
    public $model;
    public $debounce;
    public $lazy;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label=null,$type='text',$icon=null,$prepend=null,$append=null,$size=null,$help=null,$model=null,$debounce=null,$lazy=null,$required=null)
    {

        $this->label = $label;
        $this->type = $type;
        $this->icon = $icon;
        $this->prepend = $prepend;
        $this->append = $append;
        $this->size = $size;
        $this->help = $help;
        $this->model = $model;
        $this->debounce = $debounce;
        $this->lazy = $lazy;
        $this->required = $required;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input');
    }
}
