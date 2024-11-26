<?php

namespace App\View\Components\setting;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class SettingTargetList extends Component
{
    public $settingList =
    [
        'sourcesites' => [
            'label' => '資源網域'
        ],
        'works' => [
            'label' => '作品'
        ],
        'documents' => [
            'label' => '官方文件'
        ],
        'practiceType' => [
            'label' => '實作類型',
            'sub' => [
                'languages' => [
                    'label' => '程式語言'
                ],
                'packagetools' => [
                    'label' => '工具套件'
                ],
                'environments' => [
                    'label' => '環境'
                ],
                'frameworks' => [
                    'label' => '框架'
                ],
            ]
        ]
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.setting.setting-target-list');
    }

    public static function getSettingList()
    {
        $list = new self;
        $targets = explode('_', Request::segment(2));
        $targetPage = (count($targets) > 1) ? $list->settingList[$targets[0]]['sub'][$targets[1]] : $list->settingList[$targets[0]];
        return $targetPage['label'];
    }

    public static function getProblemModels()
    {
        $list = new self;
        $problemModels = $list->settingList['practiceType']['sub'];

        return $problemModels;
    }
}
