<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Backgroundmodels\Sourcedomain;

class DomainController extends Controller
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
    public function index($domain)
    {


        return view('collectionlist', ['resourcedomains' => $this->domain->all()]);
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
        $this->domain->domain_url = $request->domainUrl;
        $this->domain->domain_name = $request->domainName;
        $this->domain->domain_api = $request->domainApi;
        $this->domain->domain_logo = $request->domainLogo;
        $this->domain->save();

        return redirect('setting');
    }

    /**
     * Display the specified resource.
     *
     * param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // dd('aa');
        $domain = $request->domain;
        // $tt = ;
        return response()->json([
            'status' => 200,
            'data' => [
                'meta' => $this->domain->find($domain)
            ]
        ]);
        // return dd(new DomainResource(Sourcedomain::select('domain_url')->first()));
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
