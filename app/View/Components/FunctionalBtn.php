<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FunctionalBtn extends Component
{
    public $color, $label, $type, $form, $name, $class = ['btn'], $id, $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($btnAttr = [])
    {
        $this->class[] = "btn-{$btnAttr['color']}";

        collect($btnAttr)->map(function ($val, $attr) {
            if ($attr == 'class')
                $this->class = array_merge($this->class, $val);
            else
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
