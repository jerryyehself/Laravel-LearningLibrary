<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResourceAccessed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $resource =  Http::get($request->resource);

        $status = $resource->ok();
        if ($status != true) {
            $resource = Http::retry(5, 100)->throwIf($status >= 400, 'cant get targert');
            return  redirect('/', ['error' => $resource]);
        }
        return $next($request);
    }
}
