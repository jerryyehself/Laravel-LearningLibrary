<?php

namespace App\View\Components;

use App\Models\Backgroundmodels\Project;
use Illuminate\View\Component;

class AutocompleteItem extends Component
{
    public $workName, $workTags;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Project $work)
    {
        $this->workName = $work->project_name;
        $this->workTags = $work->latestElements;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.autocomplete-item');
    }
}
