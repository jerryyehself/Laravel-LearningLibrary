<?php

namespace App\Http\Controllers;

class BladeListsController extends Controller
{

    public static function getListItem($item = '')
    {
        return self::{$item}();
    }

    public static function navBar()
    {
        return [
            '' => [
                'label' => '查詢資源',
                'url' => '/',
                'route' => 'home'
            ],
            'collections' => [
                'label' => '瀏覽資源',
                'url' => 'collections/',
                'route' => 'collections'
            ],
            'statics' => [
                'label' => '統計資料',
                'url' => 'statics/',
                'route' => 'statics'
            ],
            'setting' => [
                'label' => '相關設定',
                'url' => 'setting/sourcesites/',
                'route' => 'sourcesites.*'
            ]
        ];
    }

    public static function settingList()
    {
        return
            [
                'sourcesites' => [
                    'label' => '資源網域',
                    'type' => 'btn'
                ],
                'works' => [
                    'label' => '作品',
                    'type' => 'btn'
                ],
                'documents' => [
                    'label' => '官方文件',
                    'type' => 'btn'
                ],
                'practiceType' => [
                    'label' => '實作類型',
                    'type' => 'btnList',
                    'sub' => [
                        'languages' => [
                            'label' => '程式語言',
                            'type' => 'btn'
                        ],
                        'packagetools' => [
                            'label' => '工具套件',
                            'type' => 'btn'
                        ],
                        'environments' => [
                            'label' => '環境',
                            'type' => 'btn'
                        ],
                        'frameworks' => [
                            'label' => '框架',
                            'type' => 'btn'
                        ],
                    ]
                ]
            ];
    }

    public static function footerLinks()
    {
        return [
            'github' => [
                'icon' => 'github',
                'url' => 'https://github.com/jerryyehself'
            ],
            'instagram' => [
                'icon' => 'instagram',
                'url' => 'https://www.instagram.com/jerry29_new_life/'
            ],
            'gmail' => [
                'icon' => 'envelope',
                'url' => 'mailto:jerry40522@gmail.com'
            ],
        ];
    }
}
