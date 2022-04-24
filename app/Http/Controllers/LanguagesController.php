<?php

namespace App\Http\Controllers;

use App\Models\Backgroundmodels\Project;
use App\Models\Problemmodels\Language as Languages;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function __construct()
    {
        $this->language = new Languages;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {

        $view = [
            'page' => 'languages',
            'title' => [
                '程式語言',
                '版本',
                '作品使用率',
                '管理選項'
            ],
            'content' => [
                'language' => $this->language->all(),
                'projectCount' => $project->count(),
                'projectUsage' => $this->language->withCount('projects')->get(),
                'resourceCounter' => $this->language->withCount('resources')->get()
            ],
            'counter' => $this->language->count()
        ];
        return view('setting', ['collection' => $view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
