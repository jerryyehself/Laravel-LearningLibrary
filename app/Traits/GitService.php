<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 * change entity display
 */
trait EntityStatusUpdate
{

    public function display(Request $request)
    {

        return $this->model::find($request->id)->save(
            ['display' => $request->display]
        );
    }
}
