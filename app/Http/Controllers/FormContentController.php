<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormContentController extends Controller
{
    public function contentList()
    {

        $input_type = [
            'text',
            'url'
        ];

        $label_id = [
            'doaminName',
            'domainUrl',
            'domainApi',
            'domainLogo'
        ];

        $valid_list = [
            'existed' => '未重複',
            'accessible' => '存在(可連線)'
        ];

        $view = [

            [
                'label' => '域名',
                'type' => $input_type[0],
                'id' => 'domainName',
                'valid' => [
                    'existed' => $valid_list['existed']
                ]
            ],
            [
                'label' => '網址',
                'type' => $input_type[1],
                'id' => 'domainUrl',
                'valid' => [
                    'existed' => $valid_list['existed'],
                    'accessible' => '網域' . $valid_list['accessible']
                ]
            ],
            [
                'label' => 'Logo',
                'type' => $input_type[1],
                'id' => 'domainLogo',
                'valid' => [
                    'existed' => $valid_list['existed'],
                    'accessible' => 'Logo網址' . $valid_list['accessible']
                ]
            ],
            [
                'label' => 'API',
                'type' => $input_type[1],
                'id' => 'domainApi',
                'valid' => [
                    'existed' => $valid_list['existed'],
                    'accessible' => 'API' . $valid_list['accessible']
                ]
            ]

        ];
        // return response()->json(
        //     $view,
        //     200,
        //     ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        //     JSON_UNESCAPED_UNICODE
        // )->getContent();
        return view('setting', ['formcontents' => response()->json(
            $view,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        )->getData()]);
    }
}
