<?php

namespace App\View\Components;

use App\Models\Backgroundmodels\Project;
use Illuminate\View\Component;

class SearchHistoryItem extends Component
{
    public $workId, $workName, $workTags, $workLink, $searchTime;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Project $work)
    {
        $this->workId = $work->id;
        $this->workName = $work->project_name;
        $this->workTags = $work->latestElements;
        $this->workLink = $work->searchLink;
        $this->searchTime = now();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-history-item');
    }
}
