<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstanceResource;
use App\Models\Backgroundmodels\Project;
use App\Models\Problemmodels\Language as Languages;
use App\View\Components\setting\SettingTargetList;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public $languages;
    private $fieldSetting = [
        'id' => [
            'title' => 'id',
            'editable' => false,
            'type' => null,
            'display' => [
                'setting_list' => true,
                'edit' => false,
                'collect' => false
            ],
            'required' => false
        ],
        'offical_document' => [
            'title' => '官方網站',
            'type' => 'url',
            'display' => [
                'setting_list' => false,
                'edit' => true,
                'collect' => false
            ],
            'required' => true
        ],
        'document_list' => [
            'title' => '資源清單',
            'editable' => true,
            'type' => 'inputGroup',
            'display' => [
                'setting_list' => false,
                'edit' => true,
                'collect' => false
            ],
            'dropDown' => 'source_type',
            'required' => false
        ],
        'logo' => [
            'title' => 'Logo',
            'editable' => false,
            'type' => 'img_url',
            'display' => [
                'setting_list' => true,
                'edit' => true,
                'collect' => false
            ],
            'required' => false
        ],
        'source_type' => [
            'title' => '資源類型',
            'name' => 'source_type',
            'editable' => true,
            'type' => 'dropDown',
            'for' => 'document_list',
            'display' => [
                'setting_list' => false,
                'edit' => false,
                'collect' => false
            ],
            'list' => [
                'personal_site' => [
                    'label' => '個人網站'
                ],
                'forum' => [
                    'label' => '論壇'
                ],
                'file' => [
                    'label' => '檔案'
                ]
            ]
        ]
    ];

    public function __construct()
    {
        $this->languages = new Languages;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {

        $view = [
            'page' => 'languages',
            'title' => [
                '程式語言名稱',
                // '版本'
            ],
            'content' => $this->languages->paginate(10),
            // [
            //     'target' => $this->language->all(),
            //     'projectCount' => $project->count(),
            //     'projectUsage' => $this->language->withCount('hasInstanceProjects')->get(),
            //     'resourceCounter' => $this->language->withCount('resources')->get()
            // ],
            'edit_type' => 'modal',
            'counter' => $this->languages->count()
        ];
        return view('setting', ['collection' => $view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $settingRoute = SettingTargetList::getSettingList();

        $instance = new InstanceResource($this->languages::find($id));
        // dd($instance->toArray(request()));
        $sections = [];

        collect($this->fieldSetting)->where(
            'display.edit',
            true
        )->map(function ($settings, $field) use (&$sections) {
            if (isset($settings['dropDown']))
                $settings['dropDown'] = $this->fieldSetting[$settings['dropDown']];
            switch ($settings['type']) {
                case 'url':
                    $sections['attr']['title'] = '屬性';
                    $sections['attr']['fields'][$field] = $settings;
                    break;
                default:
                    $sections[$settings['type']]['title'] = $settings['title'];
                    $sections[$settings['type']]['fields'][$field] = $settings;
                    break;
            }
        });
        return view('setting.crud.modify', compact('instance', 'sections', 'settingRoute'));
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
    public function update(Request $request, $id) {}

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
