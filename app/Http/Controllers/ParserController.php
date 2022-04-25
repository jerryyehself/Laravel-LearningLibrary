<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resourcemodels\Resource;
use App\Models\Backgroundmodels\Sourcedomain;
// use App\Http\Requests\ApiRequest;
use Exception;

class ParserController extends Controller
{
    public function __construct()
    {
        $this->resource = new Resource;
    }
    /**
     * Display a listing of the resource.
     * @param  \App\Http\RequestsApiRequest $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        if (isset($request)) {
            // dd($request);
            return view('home', ['resource' => $request])
                ->with('done', 'done');
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
            $this->resource->content_language = $request->content_language;
            $this->resource->title = $request->title;
            $this->resource->location = $request->location;
            // $this->resource->creation_date = $request->creation_date;
            $this->resource->creation_date = now();
            // $this->resource->last_answer_date = $request->last_answer_date;
            $this->resource->last_answer_date = now();
            $this->resource->sourcedomain_id = Sourcedomain::find(1)->resources->first()->id;
            // dd($this->resource->title);
            try {
                $this->resource->save();
                return redirect('/')->with('status', '新增成功');
            } catch (Exception $e) {
                return 'wrong because' . $e;
            }
        }
    }
}
