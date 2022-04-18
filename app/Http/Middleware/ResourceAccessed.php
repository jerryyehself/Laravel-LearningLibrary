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

        $resource_status = Http::timeout(5)->get($request->resource)->status();
        dd($resource_status);
        switch ($resource_status) {
            case 200:
                return $next($request);
                break;
            case 404:
                // dd($resource_status);
                return response('aa');
                break;
        }
    }
}
