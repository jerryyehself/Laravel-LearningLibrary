<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;

class ParserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "aa";
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

        function resource_url_processor($request)
        {
            $resource_url_components = explode('/', $request->resource);

            $resource_location_paramets = array_slice($resource_url_components, 4);
            $resource_location = implode('/', $resource_location_paramets);

            $url_paramets = [
                'resource_url' => $request->resource,
                'resource_domain' => $resource_url_components[2],
                'resource_location' => $resource_location,
                'resource_location_paramets' => $resource_location_paramets
            ];

            return $url_paramets;
        }

        if (isset($request)) {

            $areasource = resource_url_processor($request);

            $view = [
                'result' => $request,
                'domain' => $areasource['resource_domain']
            ];

            switch ($areasource['resource_domain']) {
                case 'stackoverflow.com':
                    $json_data_id = $areasource['resource_location_paramets'][0];

                    $origin_json_data = json_decode(file_get_contents('compress.zlib://https://api.stackexchange.com/2.3/questions/' . $json_data_id . '?order=desc&sort=activity&site=stackoverflow'), true);
                    
                    $view['resourcetitle'] = $origin_json_data['items'][0]['title'];
                    $view['bestanswer'] = isset($origin_json_data['items'][0]['accepted_answer_id']) === true ? true : false;
                    $view['tags'] = $origin_json_data['items'][0]['tags'];
                    $view['domainlogo'] = 'https://stackoverflow.design/assets/img/logos/so/logo-stackoverflow.svg';

                    break;

                case 'ithelp.ithome.com.tw':
                    $ithone_article_data = file_get_contents($areasource['resource_url']);
                    
                    preg_match('/\<title\>(.*?)\<\/title\>/', $ithone_article_data, $ithone_article_title);

                    preg_match_all('/class\=\"tag qa-header__tagList\"\>(.*?)\<\/a\>/', $ithone_article_data, $ithone_article_tags);

                    $view['resourcetitle'] = str_replace(' - iT 邦幫忙::一起幫忙解決難題，拯救 IT 人的一天', "", $ithone_article_title[1]);
                    $view['tags'] = array_slice($ithone_article_tags[1], 1);
                    $view['bestanswer'] = false;
                    $view['domainlogo'] = 'https://ithelp.ithome.com.tw/storage/image/fbpic.jpg';

                    break;
            }
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
