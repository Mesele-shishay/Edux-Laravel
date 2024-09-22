<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;
    public $body;
    public $id;
    public $footer;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title='',$body='',$id='',$footer='')
    {
        $this->title = $title;
        $this->body = $body;
        $this->id = $id;
        $this->footer = $footer;



        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
