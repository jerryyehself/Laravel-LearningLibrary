<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LanguageResourceInputGroup extends Component
{
    public $inputGroup, $instance;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputGroup = [], $instance = [])
    {
        $this->inputGroup = $inputGroup;
        $this->instance = $instance;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.language-resource-input-group');
    }
}
