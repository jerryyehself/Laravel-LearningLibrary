<?php

namespace App\Http\Controllers;

use App\Models\Backgroundmodels\Project;
use App\Service\GitService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CollectionPageController extends Controller
{

    public function menu()
    {
        return view(
            'collections',
            [
                'works' => $this->works()
            ]
        );
    }

    public function works()
    {
        return Project::all()->map(function ($work) {
            $work['repo_created_at'] = Carbon::parse($work['repo_created_at'])->format('Y-m-d');
            $work['repo_updated_at'] = Carbon::parse($work['repo_updated_at'])->format('Y-m-d');
            return $work;
        });
    }

    public function language()
    {
        $view = [];
        return view('collections');
    }

    public function environment()
    {
        $view = [];
        return view('collections');
    }

    public function packagetool()
    {
        $view = [];
        return view('collections');
    }

    public function framework()
    {
        $view = [];
        return view('collections');
    }
    public function document()
    {
        $view = [];
        return view('collections');
    }
}
