<?php

namespace Database\Factories\Backgroundmodels;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Backgroundmodels\Project;

class ProjectFactory extends Factory
{
    protected $model = Project::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_name' => $this->faker->name(),
            // 'project_version' => $this->faker->randomFloat(),
            'project_description' => $this->faker->text(),
            // 'used_language_id' => $this->faker->randomNumber(),
            // 'used_packagetool_id' => $this->faker->randomNumber(),
            // 'used_framework_id' => $this->faker->randomNumber(),
            // 'used_environment_id' => $this->faker->randomNumber(),
            'git_repository_id' => $this->faker->randomNumber(),
            'maintained' => $this->faker->boolean(),
            'still_maintain' => $this->faker->boolean(),
            'release_url' => $this->faker->url(),
            'release_domain_id' => $this->faker->randomNumber(),
        ];
    }
}
