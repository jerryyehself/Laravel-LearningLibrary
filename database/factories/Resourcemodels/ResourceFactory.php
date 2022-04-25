<?php

namespace Database\Factories\Resourcemodels;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resourcemodels\Resource;

class ResourceFactory extends Factory
{
    protected $model = Resource::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'location' => $this->faker->url(),
            'sourcedomain_id' => $this->faker->randomNumber(),
            'content_language' => $this->faker->languageCode(),
            'creation_date' => $this->faker->dateTime(),
            'last_answer_date' => $this->faker->dateTime(),
            // 'note' => $this->faker->text()
            // 'language_id' => $this->faker->randomNumber(),
            // 'framework_id' => $this->faker->randomNumber(),
            // 'environment_id' => $this->faker->randomNumber(),
            // 'packagetool_id' => $this->faker->randomNumber(),
            // 'usage'=>$this->faker->boolean(),
            // 'useful'=>$this->faker->
        ];
    }
}
