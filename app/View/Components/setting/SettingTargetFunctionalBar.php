<?php

namespace App\View\Components\setting;

use Illuminate\View\Component;

class SettingTargetFunctionalBar extends Component
{
    public $action, $name, $method;
    public $targetBtnGroups = [
        'sourcesites' => [
            'btns' => [
                'create' => [
                    'label' => '新增',
                    'color' => 'primary'
                ],
            ],
            'search' => [
                'label' => '查詢',
                'btn' => [
                    'label' => '查詢',
                    'color' => 'secondary',
                    'name' => 'searchSubmit',
                    'type' => 'submut'
                ]
            ]
        ],
        'works' => [
            'btns' => [
                'create' => [
                    'label' => '批次關閉',
                    'color' => '',
                    'class' => [
                        'btn-outline-primary'
                    ]
                ],
                'update_now' => [
                    'label' => '更新資料',
                    'type' => 'submit',
                    'color' => '',
                    'value' => 'updateNow',
                    'name' => 'command',
                    'id' => 'updateNow',
                    'class' => [
                        'btn-outline-danger'
                    ]
                ]
            ],
            'search' => [
                'label' => '查詢',
                'btn' => [
                    'label' => '查詢',
                    'color' => 'secondary',
                    'name' => 'searchSubmit',
                    'type' => 'submut'
                ]
            ]
        ],
        'documents' => [
            'btns' => [
                'create' => [
                    'label' => '新增',
                    'color' => 'primary'
                ],
            ],
            'search' => [
                'btn' => [
                    'label' => '查詢',
                    'color' => 'secondary',
                    'name' => 'searchSubmit',
                    'type' => 'submut'
                ],
                'placeholder' => ''
            ]
        ],
        'practiceType' => [
            'languages' => [
                'btns' => [
                    'create' => [
                        'label' => '新增',
                        'color' => 'primary'
                    ],
                ],
                'search' => [
                    'btn' => [
                        'label' => '查詢',
                        'color' => 'secondary',
                        'name' => 'searchSubmit',
                        'type' => 'submut'
                    ],
                    'placeholder' => ''
                ]
            ],
            'packagetools' => [
                'btns' => [
                    'create' => [
                        'label' => '新增',
                        'color' => 'primary'
                    ],
                ],
                'search' => [
                    'btn' => [
                        'label' => '查詢',
                        'color' => 'secondary',
                        'name' => 'searchSubmit',
                        'type' => 'submut'
                    ],
                    'placeholder' => ''
                ]
            ],
            'enviroments' => [
                'btns' => [
                    'create' => [
                        'label' => '新增',
                        'color' => 'primary'
                    ],
                ],
                'search' => [
                    'btn' => [
                        'label' => '查詢',
                        'color' => 'secondary',
                        'name' => 'searchSubmit',
                        'type' => 'submut'
                    ],
                    'placeholder' => ''
                ]
            ],
            'framworks' => [
                'btns' => [
                    'create' => [
                        'label' => '新增',
                        'color' => 'primary'
                    ],
                ],
                'search' => [
                    'btn' => [
                        'label' => '查詢',
                        'color' => 'secondary',
                        'name' => 'searchSubmit',
                        'type' => 'submut'
                    ],
                    'placeholder' => ''
                ]
            ],
        ]
    ];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($method = 'POST', $name = 'form1', $action = '')
    {
        $this->method = $method;
        $this->name = $name;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.setting.setting-target-functional-bar');
    }
}
