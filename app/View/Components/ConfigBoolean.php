<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfigBoolean extends Component
{

   public $name;
   public $description;
   public $value;

   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct($name='',$description='',$value='')
   {
       $this->name = $name;
       $this->description = $description;
       $this->value = $value;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.config-boolean');
    }
}
