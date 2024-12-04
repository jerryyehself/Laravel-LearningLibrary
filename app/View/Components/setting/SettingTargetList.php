<?php

namespace App\View\Components\setting;

use App\Models\Backgroundmodels\Project;
use App\Models\Backgroundmodels\Sourcedomain;
use App\Models\Officialdocument;
use App\Models\Problemmodels\Environment;
use App\Models\Problemmodels\Framework;
use App\Models\Problemmodels\Language;
use App\Models\Problemmodels\Packagetool;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class SettingTargetList extends Component
{
    public $settingList;
    private $settingListInfo =
    [
        'sourcesites' => [
            'label' => '資源網域',
            'model' => Sourcedomain::class
        ],
        'works' => [
            'label' => '作品',
            'model' => Project::class
        ],
        'documents' => [
            'label' => '官方文件',
            'model' => Officialdocument::class
        ],
        'practiceType' => [
            'label' => '實作類型',
            'sub' => [
                'languages' => [
                    'label' => '程式語言',
                    'model' => Language::class
                ],
                'packagetools' => [
                    'label' => '工具套件',
                    'model' => Packagetool::class
                ],
                'environments' => [
                    'label' => '環境',
                    'model' => Environment::class
                ],
                'frameworks' => [
                    'label' => '框架',
                    'model' => Framework::class
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
        $this->settingList = $this->setSettingListLabel();
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

    private function setSettingListLabel()
    {
        return $this->keyMapper(
            $this->settingListInfo,
            ['target' => 'label'],
            true
        );
    }

    private function keyMapper($arr = [], $target = [], $holdStructrue = false)
    {
        return collect($arr)
            ->mapWithKeys(function ($item, $key) use ($target, $holdStructrue) {
                if (isset($item['sub'])) {
                    if ($holdStructrue)
                        return [
                            $key =>
                            [
                                $target['target'] => $item[$target['target']],
                                'sub' => $this->keyMapper($item['sub'], $target,  true)
                            ],

                        ];
                    else
                        return $this->keyMapper($item['sub'], $target);
                } else {
                    if ($holdStructrue)
                        return [
                            $key => [
                                $target['target'] => $item[$target['target']]
                            ]
                        ];
                    else
                        return [$key => $item[$target['target']]];
                }
            })
            ->toArray();
    }

    public static function getSettingListModel()
    {
        $list = new self;
        return $list->keyMapper(
            $list->settingListInfo,
            ['target' => 'model']
        );
    }
}
