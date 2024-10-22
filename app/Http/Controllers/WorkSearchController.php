<?php

namespace App\Http\Controllers;

use App\Models\Backgroundmodels\Project;
use Illuminate\Http\Request;

class WorkSearchController extends Controller
{
    public function search(Request $request)
    {
        return response(
            self::transformWorksElements(
                $this->searchByElement($request)
                    ->merge($this->searchByName($request))
            )
        );
    }

    private function searchByElement(Request $request)
    {

        return Project::whereHas('latestElements', function ($query) use ($request) {
            $query->where('element_name', 'LIKE', "%{$request->input('searchTerm')}%");
        })
            ->withElementSearch()
            ->get();
    }

    private function searchByName(Request $request)
    {
        return Project::where('project_name', 'LIKE', "%{$request->input('searchTerm')}%")
            ->withElementSearch()
            ->get();
    }

    private static function transformWorksElements($works)
    {

        return  $works->transform(function ($work) {
            $work->searchLabel = $work->project_name . " [" . $work->latestElements->pluck('element_name')->implode(', ') . "]";
            $work->searchLink = 'https://github.com/jerryyehself/' . $work->git_repository_name;
            $work->elementTags = $work->latestElements->pluck('element_name')->implode(', ');
            return $work;
        });
    }
}
