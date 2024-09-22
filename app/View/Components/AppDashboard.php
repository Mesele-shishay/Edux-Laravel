<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class AppDashboard extends Component
{
    public $name ;
    public $icon ;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name='Dashboard',$icon='grip-horizontal')
    {
        $this->name = STR::ucfirst($name);
        $this->icon = $icon;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app-dashboard');
    }
}
