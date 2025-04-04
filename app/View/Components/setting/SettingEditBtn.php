<?php

namespace App\View\Components\setting;

use Illuminate\View\Component;

class SettingEditBtn extends Component
{
    public $id, $editType;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $editType = '')
    {
        $this->id = $id;
        $this->editType = $editType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.setting.setting-edit-btn');
    }
}
