<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resourcemodels\Resource;
use App\Http\Requests\ApiRequest;

class ParserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Http\RequestsApiRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (isset($request)) {
            return view('home', ['resource' => $request])->with('done', 'done');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (isset($_POST['resource'])) {

            return view('/home', ['resource' => $_POST['resource']]);
        } else {
            return view('/home', ['resource' => '']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request)) {


            $resource_url_components = explode('/', $request->resource);

            $resource_location_paramets = array_slice($resource_url_components, 4);
            $resource_location = implode('/', $resource_location_paramets);

            $url_paramets = [
                'resource_url' => $request->resource,
                'resource_domain' => $resource_url_components[2],
                'resource_location' => $resource_location,
                'resource_location_paramets' => $resource_location_paramets
            ];



            $view = [
                'result' => $request,
                'domain' => $url_paramets['resource_domain']
            ];


            return view('home', $view);
        } else {
            return view('home');
        }
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
