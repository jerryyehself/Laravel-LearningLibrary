<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FunctionalBtn extends Component
{
    public $color, $label, $type, $form, $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($btnAttr = [])
    {
        collect($btnAttr)->map(function ($val, $attr) {
            $this->{$attr} = $val;
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.functional-btn');
    }
}
