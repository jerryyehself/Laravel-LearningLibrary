<?php

namespace App\Http\Controllers;

use App\Models\Backgroundmodels\Project;
use App\Models\Backgroundmodels\Sourcedomain;
use Illuminate\Http\Request;

class WorksController extends Controller
{

    public $works, $domain;
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

        $view = [
            'title' => [
                '作品',
                '實作類型',
                '詳細資料'
            ],
            'content' => [
                'target' => $this->works->all(),
                'components' => $this->works->with('projectElements')->get(),
                'domainlist' => $this->domain->all()
            ],
            'counter' => $this->works->count()
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
    public function store(Request $request)
    {
        //
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
        // $editor =  $this->works->find($id);
        // $view = [
        //     'page' => 'works/' . $id,
        //     'edittarget' => '修改作品介紹與設定',
        //     'titles' => [
        //         '作品名稱',
        //         '所屬網域',
        //         '作品連結',
        //         'Git儲存庫',
        //         '維護狀態',
        //         '作品說明'
        //     ],
        //     'content' => [
        //         'name' => $editor->project_name,
        //         'release_domain' => '',
        //         'url' => $editor->release_url,
        //         'git' => $editor->git_repository_url,
        //         'maintain_status' => $editor->still_maintain,
        //         'description' => $editor->project_description
        //     ]
        // ];

        // return view('models.collectionmodify', $view);
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
        $work =  $this->works->find($id);

        if ($work->project_name != $request->projectTitleModify) {
            $work->project_name = $request->projectTitleModify;
            $work->save();
            return redirect('setting/works')->with('actionmessage', [
                'main' => '修改成功',
                'status' => 'success'
            ]);
        }


        return redirect('setting/works')->with('actionmessage', [
            'main' => '未修改任何資料',
            'status' => ''
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
}
