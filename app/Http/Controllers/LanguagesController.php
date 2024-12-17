<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguagePostRequest;
use App\Http\Resources\InstanceResource;
use App\Models\Backgroundmodels\Project;
use App\Models\Backgroundmodels\Sourcedomain;
use App\Models\Problemmodels\Language as Languages;
use App\Models\ResourceAuthorize;
use App\Models\Resourcemodels\Resource;
use App\Models\ResourcesInfo;
use App\View\Components\setting\SettingTargetList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        'official_document' => [
            'title' => '官方網站',
            'type' => 'inputGroup',
            'display' => [
                'setting_list' => false,
                'edit' => true,
                'collect' => false
            ],
            'dropDown' => ['content_language'],
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
            'dropDown' => ['source_type', 'content_language'],
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
        ],
        'content_language' => [
            'title' => '資源類型',
            'name' => 'source_type',
            'editable' => true,
            'type' => 'dropDown',
            'display' => [
                'setting_list' => false,
                'edit' => false,
                'collect' => false
            ],
            'list' => [
                'eng' => [
                    'label' => 'eng'
                ],
                'chi' => [
                    'label' => 'chi'
                ]
            ]
        ]
    ];

    public function __construct()
    {
        // dd(Route::current());
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
    public function create() {}

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
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $settingRoute = SettingTargetList::getSettingList();

        $instance = new InstanceResource($this->languages::with('resources')->find($id));
        // dd(collect($instance)->toArray());
        $sections = [];

        collect($this->fieldSetting)->where(
            'display.edit',
            true
        )->map(function ($settings, $field) use (&$sections) {
            if (isset($settings['dropDown'])) {
                foreach ($settings['dropDown'] as &$drowpDown)
                    $drowpDown = $this->fieldSetting[$drowpDown];
            }
            switch ($settings['type']) {
                case 'url':
                    $sections['attr']['title'] = '屬性';
                    $sections['attr']['fields'][$field] = $settings;
                    break;
                default:
                    $sections[$settings['type']][] = [
                        'title' => $settings['title'],
                        'fields' => [$field => $settings]
                    ];

                    break;
            }
        });
        return view('setting.crud.modify', compact('instance', 'sections', 'settingRoute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguagePostRequest $request, $id)
    {
        $modify = $request->validated();

        if ($modify['official_document']) {

            $urlParas = $this->explodeURL($modify['official_document']);

            $domain = ResourceAuthorize::updateOrCreate(
                ['resource_domain_url' => $urlParas['host']]
            );

            $language = $this->languages::find($id);

            $resource = Resource::updateOrCreate(
                [
                    'resource_location' => $urlParas['path'],
                    'resource_domain_id' => $domain->id
                ],
                [
                    'resource_content_language' => 'eng',
                ]
            );

            if (!$language->resources()->where('resources.id', $resource->id)->exists()) {
                $language->resources()
                    ->syncWithoutDetaching(
                        [
                            $resource->id =>
                            [
                                'instantiated_type' => $this->languages::class,
                                'instance_type' => 'official_document',
                                'instance_id' => $resource->id
                            ]
                        ]
                    );
            }
        }

        return redirect('setting/languages')
            ->with('actionmessage', [
                'main' => '修改成功',
                'status' => 'success',
                'data' => $language
            ]);
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

    private function explodeURL($url = '')
    {
        $urlParas = parse_url($url);
        return ['host' => $urlParas['host'], 'path' => $urlParas['path']];
    }

    private function resourcesFormatter($resources = [])
    {
        // $resources
    }
}
