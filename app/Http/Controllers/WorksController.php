<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectPostRequest;
use App\Http\Resources\InstanceResource;
use App\Models\Backgroundmodels\Project;
use App\Models\Backgroundmodels\Sourcedomain;
use App\Models\CentralPivot;
use App\Models\Images;
use App\View\Components\setting\SettingTargetList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorksController extends Controller
{

    public $works, $domain;

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
            'required' => true
        ],
        'project_name' => [
            'title' => '作品',
            'editable' => false,
            'type' => 'label',
            'display' => [
                'setting_list' => true,
                'edit' => false,
                'collect' => true
            ],
            'required' => true
        ],
        'project_name_cn' => [
            'title' => '中文名稱',
            'editable' => true,
            'type' => 'text',
            'display' => [
                'setting_list' => true,
                'edit' => true,
                'collect' => false
            ],
            'required' => true
        ],
        'release_url' => [
            'title' => '實作頁面',
            'editable' => true,
            'type' => 'url',
            'display' => [
                'setting_list' => false,
                'edit' => true,
                'collect' => false
            ],
            'required' => false
        ],
        // 'git_repository_name' => [
        //     'title' => 'git儲存庫名稱',
        //     'editable' => false,
        //     'type' => 'text',
        //     'display' => [
        //         'setting_list' => true,
        //         'edit' => false,
        //         'collect' => false
        //     ]
        // ],
        'still_maintain' => [
            'title' => '維護',
            'editable' => false,
            'type' => 'switch',
            'display' => [
                'setting_list' => true,
                'edit' => true,
                'collect' => false
            ],
            'required' => false
        ],
        'display_status' => [
            'title' => '顯示',
            'editable' => true,
            'type' => 'switch',
            'display' => [
                'setting_list' => true,
                'edit' => true,
                'collect' => false
            ],
            'required' => false
        ],
        'project_description' => [
            'title' => '作品說明',
            'editable' => true,
            'type' => 'textarea',
            'display' => [
                'setting_list' => false,
                'edit' => true,
                'collect' => false
            ],
            'required' => false
        ],
        'imgs' => [
            'title' => '示意圖',
            'editable' => true,
            'type' => 'img',
            'display' => [
                'setting_list' => false,
                'edit' => true,
                'collect' => false
            ]
        ],
        'UsingLanguages' => [
            'title' => '標籤',
            'editable' => true,
            'type' => 'tag',
            'display' => [
                'setting_list' => false,
                'edit' => true,
                'collect' => true
            ],
            'required' => false
        ],
        'git_repository_id' => [
            'editable' => true,
            'type' => 'hidden',
            'display' => [
                'setting_list' => false,
                'edit' => true,
                'collect' => true
            ],
            'required' => false
        ]
    ];

    public function __construct()
    {
        $this->works = new Project;
        $this->domain = new Sourcedomain;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view(
            'setting',
            [
                'collection' =>
                [
                    'title' => [
                        '作品',
                        '中文名稱',
                        '實作類型',
                        '詳細資料',
                        '對外顯示'
                    ],
                    'content' => $this->works->paginate(10),
                    'edit_type' => 'page'
                    // [
                    //     'target' => $this->works->all(),
                    //     // 'components' => $this->works->all(),
                    //     // 'domainlist' => $this->domain->all()
                    // ],
                    // 'counter' => $this->works->count()
                ]
            ]
        );
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
    public function store(Request $request)
    {
        $actionMessage = session(
            'actionMessage',
            match ($request->get('commandBtn')) {
                'updateNow' => $this->updateReposInfo(),
                default => back()
            }
        );

        return back()->with('actionMessage', $actionMessage);
    }

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
        $problemModels = SettingTargetList::getProblemModels();

        $instance = new InstanceResource($this->works::find($id));

        foreach ($problemModels as $prob => $attr) {
            $modelLabel = Str::singular($prob) . '_name';
            $problemModels[$prob]['list'] = DB::table($prob)
                ->whereNotIn(
                    $modelLabel,
                    $instance->UsingLanguages->pluck('language_name')->all()
                )->get();
            $problemModels[$prob]['model_label'] = $modelLabel;
        }
        // dd(SettingTargetList::getSettingListModel());
        $sections = $this->setInputs();

        return view('setting.crud.modify', compact('instance', 'sections', 'settingRoute', 'problemModels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(ProjectPostRequest $request, $id)
    {
        if (isset($request->display))
            return $this->updateDisplayStatus($request, $id);

        $request->validated();

        $modify = $request->all();
        $this->saveImgs($id, array_filter($modify['hasImg']));
        // $this->saveTags($id, array_filter($modify['hasImg']));

        $modify['still_maintain'] = $request->has('still_maintain');
        $modify['display_status'] = $request->has('display_status');

        $work = $this->works->find($id)
            ->fill($modify)
            ->save();

        return redirect('setting/works')
            ->with('actionmessage', [
                'main' => '修改成功',
                'status' => 'success',
                'data' => $work
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
        $this->works->destroy($id);

        return redirect('collections/works')->with('actionmessage', [
            'main' => '刪除成功',
            'status' => 'deleted'
        ]);
    }

    public function updateDisplayStatus($request, $id)
    {
        Project::find($id)
            ->update(['display_status' => ($request->display) ? 1 : 0]);

        return response()->json([
            'status' => 'update display success',
            'data' => Project::find($id)
        ]);
    }

    private function updateReposInfo()
    {
        Artisan::call('update:reposData');
        return [
            'main' => Artisan::output(),
            'status' => 'success'
        ];
    }

    private function saveImgs($id, $hasImg = [])
    {
        //先把所有圖片紀錄軟刪除
        Project::find($id)->hasImg()->each(function ($pivot) {
            $pivot->pivot->deleteRelations();
        });

        if (!$hasImg) return true;

        foreach ($hasImg as $sort => $img) {

            if (!is_object($img)) {
                $img = CentralPivot::withTrashed()->find($img);
                $img->restore();
                $img->id = $img->object_id;
            } else {
                $fileName = $img->hashName();

                $img->storeAs(
                    "uploads/images",
                    $fileName,
                    'public'
                );

                $img = Images::updateOrCreate([
                    'img_name' => $fileName,
                    'img_route' => "uploads/images",
                    'img_descript' => ''
                ]);
            }

            $this->works->find($id)
                ->hasImg()
                ->syncWithoutDetaching([
                    $img->id => [
                        'object_type' => Images::class,
                        'subject_type' => Project::class,
                        'sort_info' => $sort
                    ],
                ]);
        }
    }

    private function setInputs()
    {
        $sections = [];

        collect($this->fieldSetting)
            ->where('display.edit', true)
            ->each(function ($settings, $field) use (&$sections) {
                $type = $settings['type'];

                // 設定標題，如果需要
                $titleMap = [
                    'switch' => '狀態',
                    'img' => '示意圖',
                    'tag' => '標籤',
                    'textarea' => '',
                    'hidden' => '',
                    'attr' => '屬性'
                ];

                $sectionKey = in_array($type, ['text', 'url']) ? 'attr' : $type;

                if (isset($titleMap[$sectionKey]))
                    $sections[$sectionKey]['title'] = $titleMap[$sectionKey];

                $sections[$sectionKey]['fields'][$field] = $settings;
            });
        return $sections;
    }

    private function saveTags($id, $tags = [])
    {
        //先把所有圖片紀錄軟刪除
        Project::find($id)->hasImg()->each(function ($pivot) {
            $pivot->pivot->deleteRelations();
        });

        if (!$hasImg) return true;

        foreach ($hasImg as $sort => $img) {

            if (!is_object($img)) {
                $img = CentralPivot::withTrashed()->find($img);
                $img->restore();
                $img->id = $img->object_id;
            } else {
                $fileName = $img->hashName();

                $img->storeAs(
                    "uploads/images",
                    $fileName,
                    'public'
                );

                $img = Images::updateOrCreate([
                    'img_name' => $fileName,
                    'img_route' => "uploads/images",
                    'img_descript' => ''
                ]);
            }

            $this->works->find($id)
                ->hasImg()
                ->syncWithoutDetaching([
                    $img->id => [
                        'object_type' => Images::class,
                        'subject_type' => Project::class,
                        'sort_info' => $sort
                    ],
                ]);
        }
    }

    // private function setInputs()
    // {
    //     $sections = [];

    //     collect($this->fieldSetting)->where(
    //         'display.edit',
    //         true
    //     )->map(function ($settings, $field) use (&$sections) {


    //         switch ($settings['type']) {
    //             case 'switch':
    //                 $sections[$settings['type']]['title'] = '狀態';
    //                 $sections[$settings['type']]['fields'][$field] = $settings;
    //                 break;
    //             case 'textarea':
    //                 $sections['attr']['title'] = '屬性';
    //                 $sections[$settings['type']]['fields'][$field] = $settings;
    //                 break;
    //             case 'img':
    //                 $sections[$settings['type']]['title'] = '示意圖';
    //                 $sections[$settings['type']]['fields'][$field] = $settings;
    //                 break;
    //             case 'tag':
    //                 $sections[$settings['type']]['title'] = '標籤';
    //                 $sections[$settings['type']]['fields'][$field] = $settings;
    //                 break;
    //             case 'hidden':
    //                 $sections[$settings['type']]['fields'][$field] = $settings;
    //                 break;
    //             default:
    //                 $sections['attr']['title'] = '屬性';
    //                 $sections['attr']['fields'][$field] = $settings;
    //                 break;
    //         }

    //         return $sections;
    //     });

    //     return $sections;
    // }
}
