<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ElementTags extends Component
{
    public $tag, $delete;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tag, $delete = false)
    {
        $this->tag = $tag;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element-tags');
    }
}
