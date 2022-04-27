<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionPageController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function menu()
    {
        $view = [];
        return view('collections');
    }
    public function work()
    {
        $view = [];
        return view('collections');
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
