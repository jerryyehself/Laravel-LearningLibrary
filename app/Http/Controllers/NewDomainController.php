<?php

namespace App\Http\Controllers;

use App\Http\Resources\DomainResource;
use App\Models\Backgroundmodels\Sourcedomain;
use Illuminate\Http\Request;

class NewDomainController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($this->domain_name);
        $domains = Sourcedomain::all();
        return view('collectionlist', ['contentlist' => $domains]);
        // return new DomainResource(Sourcedomain::find(1));
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
     * @param  \App\Models\Backgroundmodels\Sourcedomain  $sourcedomain
     * @return \Illuminate\Http\Response
     */
    public function show(Sourcedomain $sourcedomain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backgroundmodels\Sourcedomain  $sourcedomain
     * @return \Illuminate\Http\Response
     */
    public function edit(Sourcedomain $sourcedomain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backgroundmodels\Sourcedomain  $sourcedomain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sourcedomain $sourcedomain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backgroundmodels\Sourcedomain  $sourcedomain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sourcedomain $sourcedomain)
    {
        //
    }
}
