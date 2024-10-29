<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function index()
    {
        return view(
            '/statics',
            [
                'staticCards' => $this->staticCards()
            ]
        );
    }

    public function staticCards()
    {

        return [
            'defaultSelected' => 'type',
            'cards' => [
                'type' => [
                    'tab' => [
                        'label' => '作品實作類型',
                        'display' => true,
                    ],
                    'content' => [
                        'display' => 'show',
                        'staticCharts'
                    ]
                ],
                'language' => [
                    'tab' => [
                        'label' => '程式語言',
                        'display' => true,
                    ],
                    'content' => [
                        'display' => '',
                        'staticCharts'
                    ]
                ],
                'referenece' => [
                    'tab' => [
                        'label' => '來源網站',
                        'display' => false,
                    ],
                    'content' => [
                        'display' => false,
                        'staticCharts'
                    ]
                ]
            ]
        ];
    }
}
