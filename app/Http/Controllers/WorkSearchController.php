<?php

namespace App\Http\Controllers;

use App\Models\Backgroundmodels\Project;
use App\View\Components\AutocompleteItem;
use App\View\Components\ElementTags;
use App\View\Components\SearchHistoryItem;
use Illuminate\Http\Request;

class WorkSearchController extends Controller
{
    public function search(Request $request)
    {
        $data =
            self::transformWorksElements(
                $this->searchByElement($request)
                    ->merge($this->searchByName($request))
            );

        // $data['row'] = view('components.search-history-item', [$data]);
        // dd($data);
        return response(
            $data
        );
    }

    private function searchByElement(Request $request)
    {

        return Project::whereHas('latestElements', function ($query) use ($request) {
            $query->where('element_name', 'LIKE', "%{$request->input('searchTerm')}%");
        })
            ->where('display_status', 1)
            ->withElementSearch()
            ->get();
    }

    private function searchByName(Request $request)
    {

        return Project::where('project_name', 'LIKE', "%{$request->input('searchTerm')}%")
            ->where('display_status', 1)
            ->withElementSearch()
            ->get();
    }

    private static function transformWorksElements($works)
    {



        return  $works->transform(function ($work) {

            // $work->searchLabel = $work->project_name . " [" . $work->latestElements->pluck('element_name')->implode(', ') . "]";
            $work->searchLabel = $work->project_name;
            $work->searchLink = 'https://github.com/jerryyehself/' . $work->project_name;
            $autoCompleteItem = new AutocompleteItem($work);
            $work->autoCompleteItem = $autoCompleteItem->render()->with($autoCompleteItem->data())->render();

            $searchHistoryItem = new SearchHistoryItem($work);
            $work->row = $searchHistoryItem->render()->with($searchHistoryItem->data())->render();
            return $work;
        });
    }
}
