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

        //dd($request->getContent());
        $response = $next($request);

        $view['domain'] = $response->original['resource_domain'];

        switch ($view['domain']) {

            case 'stackoverflow.com':

                $resource_id = $response->original['resource_location_paramets'][0];

                $api_data = Http::get('https://api.stackexchange.com/2.3/questions/' . $resource_id . '?order=desc&sort=activity&site=stackoverflow')->json();

                $json_data = $api_data['items'][0];

                $view = [
                    'resourcetitle' => $json_data['title'],
                    'bestanswer' => isset($json_data['accepted_answer_id']) === true ? true : false,
                    'tags' => $json_data['tags'],
                    'domainlogo' => 'https://stackoverflow.design/assets/img/logos/so/logo-stackoverflow.svg'
                ];

                break;

            case 'ithelp.ithome.com.tw':
                $ithone_article_data = file_get_contents($response->original['resource_url']);

                preg_match('/\<title\>(.*?)\<\/title\>/', $ithone_article_data, $ithone_article_title);

                preg_match_all('/class\=\"tag qa-header__tagList\"\>(.*?)\<\/a\>/', $ithone_article_data, $ithone_article_tags);

                $view = [
                    'resourcetitle' => str_replace(' - iT 邦幫忙::一起幫忙解決難題，拯救 IT 人的一天', "", $ithone_article_title[1]),
                    'tags' => array_slice($ithone_article_tags[1], 1),
                    'bestanswer' => false,
                    'domainlogo' => 'https://ithelp.ithome.com.tw/storage/image/fbpic.jpg'
                ];

                break;
        }

        $view = response()->json($view);

        return $view;
    }
}
