<?php

namespace App\Service;

use App\Models\Backgroundmodels\Project;
use App\Models\Problemmodels\Language;
use App\Models\ProjectElement;
use Illuminate\Support\Arr;

class SaveReposDataService
{

    public $gitService;

    public function __construct()
    {
        $gitService = new GitService;
        $this->gitService = $gitService->getRepos();
    }

    public function saveReposData()
    {

        $this->gitService->map(function ($repo) {

            $project = $this->saveReposContent($repo);

            $this->saveLanguage($repo['languages']);
            $this->saveElements($repo['tags'], $project->id);
        });

        return response()->json(['status' => 'success'], 201);
    }

    public function saveLanguage($reposLang)
    {
        collect($reposLang)->map(function ($lang) {
            Language::firstOrCreate([
                'language_name' => $lang
            ]);
        });
    }

    public function saveCentralPviot() {}

    public function saveReposContent($repo)
    {
        // dd($repo);
        return Project::updateOrCreate(
            [
                'project_name' => $repo['name']
            ],
            [
                'repo_created_at' => $repo['repo_created_at'],
                'repo_updated_at' => $repo['repo_updated_at'],
                'git_repository_name' => $repo['repo_name'],
            ]
        );
    }

    public function saveElements($tags, $project_id = '')
    {
        foreach ($tags as $tag) {
            ProjectElement::create([
                'element_name' => $tag,
                'project_id' => $project_id
            ])->save();
        }
    }
}
