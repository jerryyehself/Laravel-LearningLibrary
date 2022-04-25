<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResourceContentIdentify
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
        $resource_url_components = explode('/', $request->resource);

        $data = Http::get('https://api.stackexchange.com/2.3/questions/' . $resource_url_components[4] . '?order=desc&sort=activity&site=stackoverflow')->json();

        $view = [
            'domain' => $resource_url_components[2],
            'content_language' => 'eng',
            'title' => $data['items'][0]['title'],
            // 'bestanswer' => isset($data['items'][0]['accepted_answer_id']) === true ? true : false,
            'tags' => $data['items'][0]['tags'],
            'location' => $resource_url_components[4],
            'creation_date' => $data['items'][0]['creation_date'],
            'last_answer_date' => $data['items'][0]['last_activity_date'],
        ];

        $request->merge($view);

        return $next($request);
    }
}
