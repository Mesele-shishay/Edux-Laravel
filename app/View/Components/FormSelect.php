<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSelect extends Component
{
    public $label;
    public $placeholder;
    public $options;
    public $icon;
    public $prepend;
    public $append;
    public $size;
    public $help;
    public $model;
    public $lazy;
    public $required;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder=null,$label=null,$options=null,$icon=null,$prepend=null,$append=null,$size=null,$help=null,$model=null,$lazy=null,$required=null)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->options = $options;
        $this->icon = $icon;
        $this->prepend = $prepend;
        $this->append = $append;
        $this->size = $size;
        $this->help = $help;
        $this->model = $model;
        $this->required = $required;
        $this->lazy = $lazy;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-select');
    }
}
