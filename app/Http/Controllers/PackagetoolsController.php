<?php

namespace App\Http\Controllers;

use App\Models\Problemmodels\Packagetool;
use Illuminate\Http\Request;

class PackagetoolsController extends Controller
{
    public $packagetool;
    public function __construct()
    {
        $this->packagetool = new Packagetool;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = [
            'page' => 'languages',
            'title' => [
                '框架名稱',
                '官方網站',
                '',
                // '版本'
            ],
            'content' => $this->packagetool->paginate(10),
            // [
            //     'target' => $this->language->all(),
            //     'projectCount' => $project->count(),
            //     'projectUsage' => $this->language->withCount('hasInstanceProjects')->get(),
            //     'resourceCounter' => $this->language->withCount('resources')->get()
            // ],
            'edit_type' => 'modal',
            'counter' => $this->packagetool->count()
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
