<?php

namespace Database\Factories\Problemmodels;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Problemmodels\Packagetool;

class PackagetoolFactory extends Factory
{
    protected $model = Packagetool::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'packagetool_name'=> $this->faker->name(),
            'version'=>$this->faker->randomFloat()
        ];
    }
}
