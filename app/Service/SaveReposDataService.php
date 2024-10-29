<?php

namespace App\Service;

use App\Models\Backgroundmodels\Project;
use App\Models\Problemmodels\Language;

/**
 * save git data
 */
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

            collect($repo['languages'])->map(function ($lang) use ($project) {

                $language = Language::updateOrCreate([
                    'language_name' => $lang
                ]);

                $language->touch();

                $language->hasInstanceProjects()
                    ->attach($project->id, [
                        'object_type' => Language::class,
                        'subject_type' => Project::class,
                    ]);
            });

            collect($repo['tags'])->map(function ($tag) use ($project) {

                $project->projectElements()->create([
                    'element_name' => $tag
                ]);
            });
        });

        return response()->json(['status' => 'success'], 201);
    }

    public function saveReposContent($repo)
    {
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
}
