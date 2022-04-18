<?php

namespace Database\Seeders;

use App\Models\Backgroundmodels\Project;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $target = new Project;
        $target->project_name = '短網址練習';
        $target->project_description = '測試';
        $target->release_url = 'https://dbtes.herokuapp.com/';
        $target->git_repository_url = 'https://github.com/jerryyehself/Laravel-shorturl';
        $target->save();
    }
}
