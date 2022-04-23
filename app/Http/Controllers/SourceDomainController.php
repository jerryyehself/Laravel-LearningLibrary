<?php

namespace App\Http\Controllers;

use App\Models\Backgroundmodels\Sourcedomain;
use App\Models\Resourcemodels\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SourceDomainController extends Controller
{
    public function __construct()
    {
        $this->domain = new Sourcedomain;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $view = [
            'page' => 'sourcesites',
            'title' => [
                'id',
                '網站名稱',
                '網站Logo',
                '資源數量'
            ],
            'content' => [
                'domains' => $this->domain->all(),
                'sourceCounter' => $this->domain->withCount('resources')->get()
            ],
            'counter' => $this->domain->count()
        ];
        // dd($view);
        return redirect()->route('setting', ['collection' => $view]);
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
