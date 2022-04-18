<?php

namespace Database\Factories\Problemmodels;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Problemmodels\Framework;

class FrameworkFactory extends Factory
{
    protected $model = Framework::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'framework_name'=> $this->faker->name(),
            'version'=>$this->faker->randomFloat()
        ];
    }
}
