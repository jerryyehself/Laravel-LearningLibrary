<?php

namespace Database\Factories\Problemmodels;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Problemmodels\Environment;

class EnvironmentFactory extends Factory
{
    protected $model = Environment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'environment_name' => $this->faker->name(),
            'version' => $this->faker->randomFloat()
        ];
    }
}
